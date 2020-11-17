<template>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="#" class="brand-link">
            <img src="img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <div class="sidebar">
            <div v-if="user.id" class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img v-bind:src="avatarPath" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ user.surname + " " + user.name }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                </ul>
            </nav>
        </div>
    </aside>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    name: "MainSidebarContainer",
    computed: {
        ...mapGetters(['user']),
        avatarPath: function() {
            if (this.user.gender === 'm')
                return 'img/male.png'
            else
                return 'img/female.png'
        }
    }
}
</script>

<style scoped>

</style>
