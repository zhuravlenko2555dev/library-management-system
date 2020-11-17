<template>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li v-if="user.id" class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img v-bind:src="avatarPath" class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ user.surname + " " + user.name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <li class="user-header bg-primary">
                        <img v-bind:src="avatarPath" class="img-circle elevation-2" alt="User Image">

                        <p>
                            {{ user.surname + " " + user.name }}
                        </p>
                    </li>
                    <li class="user-footer">
                        <a class="btn btn-default btn-flat">Profile</a>
                        <a @click="logout" class="btn btn-default btn-flat float-right">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "Navbar",
    computed: {
        ...mapGetters(['user']),
        avatarPath: function() {
            if (this.user.gender === 'm')
                return 'img/male.png'
            else
                return 'img/female.png'
        }
    },
    methods: {
        logout: function () {
            this.$store.dispatch('logout')
                .then(() => this.$router.push({ name: 'login' }))
                .catch(err => { this.$router.push({ name: 'login' }) })
        }
    }
}
</script>

<style scoped>

</style>
