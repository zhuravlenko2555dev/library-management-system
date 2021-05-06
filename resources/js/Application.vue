<template>
    <component :is="layout">
        <router-view></router-view>
        <notifications group="auth" />
    </component>
</template>

<script>
export default {
    name: "Application",
    metaInfo: {
        titleTemplate: '%s | Library Management System'
    },
    computed: {
        layout() {
            return (this.$route.meta.layout || "panel") + "-layout"
        }
    },
    created() {
        if (this.$store.getters.isLoggedIn) {
            this.$store.dispatch('autoRefresh')
            this.$store.dispatch('user')
                .then(() => {})
                .catch(err => {
                    this.$store.dispatch('logout')
                        .then(() => this.$router.push({ name: 'login' }))
                        .catch(err => { this.$router.push({ name: 'login' }) })
                });
        }
    }
}
</script>

<style scoped>

</style>
