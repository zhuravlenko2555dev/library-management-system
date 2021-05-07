export default {
    state: {
        loading: false,
        access_token: localStorage.getItem('access_token') || '',
        expires_at: localStorage.getItem('expires_at') || '',
        refreshTask: 0,
        user : {}
    },
    mutations: {
        auth_loading(state, loading) {
            state.loading = loading
        },
        auth_token(state, { access_token, expires_at }) {
            state.access_token = access_token
            state.expires_at = expires_at

            localStorage.setItem('access_token', access_token)
            localStorage.setItem('expires_at', expires_at)
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + access_token
        },
        refreshTask(state, refreshTask) {
            state.refreshTask = refreshTask
        },
        auth_user(state, user) {
            state.user = user
        },
        auth_logout(state) {
            state.loading = false
            state.access_token = ''
            state.expires_at = ''
            state.user = {}

            localStorage.removeItem('access_token')
            localStorage.removeItem('expires_at')
            delete axios.defaults.headers.common['Authorization']
        },
    },
    actions: {
        login({ state, commit, dispatch }, user) {
            return new Promise((resolve, reject) => {
                const { refreshTask } = state
                clearTimeout(refreshTask)
                commit('auth_loading', true)
                axios({ url: '/api/auth/login', data: user, method: 'POST' })
                    .then(resp => {
                        const access_token = resp.data.access_token
                        const expires_at = (Date.now() / 1000) + resp.data.expires_in

                        commit('auth_loading', false)
                        commit('auth_token', { access_token, expires_at })
                        dispatch('autoRefresh')
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
                axios({ url: '/api/auth/user', method: 'GET' })
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
        refreshToken({ commit, dispatch }) {
            return new Promise((resolve, reject) => {
                commit('auth_loading', true)
                axios({ url: '/api/auth/refreshToken', method: 'POST' })
                    .then(resp => {
                        const access_token = resp.data.access_token
                        const expires_at = (Date.now() / 1000) + resp.data.expires_in

                        commit('auth_loading', false)
                        commit('auth_token', { access_token, expires_at })
                        dispatch('autoRefresh')
                        resolve()
                    })
                    .catch(err => {
                        commit('auth_loading', false)
                        reject(err)
                    })
            })
        },
        autoRefresh({ state, commit, dispatch }) {
            const { expires_at } = state
            const now = Date.now() / 1000
            let timeUntilRefresh = expires_at - now
            timeUntilRefresh -= (1440 * 60)
            const refreshTask = setTimeout(() => dispatch('refreshToken'), timeUntilRefresh * 1000)
            commit('refreshTask', refreshTask)
        },
        logout({ state, commit }) {
            return new Promise((resolve, reject) => {
                const { refreshTask } = state
                clearTimeout(refreshTask)
                commit('auth_loading', true)
                axios({ url: '/api/auth/logout', method: 'POST' })
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
