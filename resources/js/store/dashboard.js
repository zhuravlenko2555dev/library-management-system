export default {
    state: {
        booksCount: 0,
        readersCount: 0,
        borrowedCount: 0,
        nonReturnCount: 0,
        borrowedGraphThisMonth: {},
        booksPopular: {},
        readersActive: {},
    },
    mutations: {
        booksCount(state, booksCount) {
            state.booksCount = booksCount
        },
        readersCount(state, readersCount) {
            state.readersCount = readersCount
        },
        borrowedCount(state, borrowedCount) {
            state.borrowedCount = borrowedCount
        },
        nonReturnCount(state, nonReturnCount) {
            state.nonReturnCount = nonReturnCount
        },
        borrowedGraphThisMonth(state, borrowedGraphThisMonth) {
            state.borrowedGraphThisMonth = borrowedGraphThisMonth
        },
        booksPopular(state, booksPopular) {
            state.booksPopular = booksPopular
        },
        readersActive(state, readersActive) {
            state.readersActive = readersActive
        },
    },
    actions: {
        booksCount({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/books/count', method: 'GET' })
                    .then(resp => {
                        const booksCount = resp.data

                        commit('booksCount', booksCount)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        readersCount({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/readers/count', method: 'GET' })
                    .then(resp => {
                        const readersCount = resp.data

                        commit('readersCount', readersCount)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        borrowedCount({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/books/borrowedCount', method: 'GET' })
                    .then(resp => {
                        const borrowedCount = resp.data

                        commit('borrowedCount', borrowedCount)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        nonReturnCount({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/books/nonReturnCount', method: 'GET' })
                    .then(resp => {
                        const nonReturnCount = resp.data

                        commit('nonReturnCount', nonReturnCount)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        borrowedGraphThisMonth({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/books/borrowedGraph', method: 'GET' })
                    .then(resp => {
                        const borrowedGraphThisMonth = resp.data

                        commit('borrowedGraphThisMonth', borrowedGraphThisMonth)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        booksPopular({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/books/popular', method: 'GET' })
                    .then(resp => {
                        const booksPopular = resp.data

                        commit('booksPopular', booksPopular)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
        readersActive({ commit }) {
            return new Promise((resolve, reject) => {
                axios({ url: '/api/readers/active', method: 'GET' })
                    .then(resp => {
                        const readersActive = resp.data

                        commit('readersActive', readersActive)
                        resolve(resp)
                    })
                    .catch(err => {
                        reject(err)
                    })
            })
        },
    },
    getters : {
        booksCount: state => state.booksCount,
        readersCount: state => state.readersCount,
        borrowedCount: state => state.borrowedCount,
        nonReturnCount: state => state.nonReturnCount,
        borrowedGraphThisMonth: state => state.borrowedGraphThisMonth,
        booksPopular: state => state.booksPopular,
        readersActive: state => state.readersActive,
    }
}
