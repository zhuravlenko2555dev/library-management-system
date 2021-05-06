<template>
    <div class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <router-link :to="{ name: 'root' }"><b>Library Management System</b></router-link>
            </div>
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Sign in to your account</p>

                    <form @submit.prevent="login">
                        <div class="input-group mb-3">
                            <input required v-model="username" type="text" class="form-control" placeholder="Username">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input required v-model="password" type="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
const { detect } = require('detect-browser');
const browser = detect();

const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}

export default {
    name: "Login",
    metaInfo: {
        title: 'Login'
    },
    data() {
        return {
            username : "",
            password : "",
            device_name : capitalize(browser.name) + ' (' + browser.version + '), ' + capitalize(browser.os)
        }
    },
    methods: {
        login: function () {
            let username = this.username
            let password = this.password
            let device_name = this.device_name
            this.$store.dispatch('login', { username, password, device_name })
                .then(() => {
                    this.$store.dispatch('user')
                        .then(() => {})
                        .catch(err => {})
                    this.$router.push({ name: 'root' })
                })
                .catch(err => {
                    this.$notify({
                        group: 'auth',
                        type: 'error ',
                        title: 'Authentication',
                        text: 'Unauthorised!'
                    })
                })
        }
    }
}
</script>

<style scoped>

</style>
