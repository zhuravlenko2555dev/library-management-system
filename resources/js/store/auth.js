export default {
    state: {
        loading: false,
        access_token: localStorage.getItem('access_token') || '',
        refresh_token: localStorage.getItem('refresh_token') || '',
        user : {}
    },
    mutations: {
        auth_loading(state, loading) {
            state.loading = loading
        },
        auth_tokens(state, { access_token, refresh_token }) {
            state.access_token = access_token
            state.refresh_token = refresh_token

            localStorage.setItem('access_token', access_token)
            localStorage.setItem('refresh_token', refresh_token)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token
        },
        auth_user(state, user) {
            state.user = user
        },
        auth_logout(state) {
            state.loading = false
            state.access_token = ''
            state.refresh_token = ''
            state.user = {}

            localStorage.removeItem('access_token')
            localStorage.removeItem('refresh_token')
            delete axios.defaults.headers.common['Authorization']
        },
    },
    actions: {
        login({ commit, dispatch }, user) {
            return new Promise((resolve, reject) => {
                commit('auth_loading', true)
                axios({ url: '/api/auth/login', data: user, method: 'POST', skipAuthRefresh: true })
                    .then(resp => {
                        const access_token = resp.data.access_token
                        const refresh_token = resp.data.refresh_token

                        commit('auth_loading', false)
                        commit('auth_tokens', { access_token, refresh_token })
                        resolve()
                    })
                    .catch(err => {
                        commit('auth_loading', false)
                        reject(err)
                    })
            })
        },
        user({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/auth/user', method: 'POST' })
                    .then(resp => {
                        const user = resp.data

                        commit('auth_user', user)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                commit('auth_loading', true)
                axios({ url: '/api/auth/logout', method: 'POST', skipAuthRefresh: true })
                    .then(resp => {
                        commit('auth_logout')
                        resolve()
                    })
                    .catch(err => {
                        commit('auth_logout')
                        reject(err)
                    })
            })
        }
    },
    getters : {
        isLoggedIn: state => !!state.access_token,
        isLoading: state => state.loading,
        user: state => state.user
    }
}
