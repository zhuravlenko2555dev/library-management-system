<template>
    <div class="wrapper">
        <navbar></navbar>
        <main-sidebar-container></main-sidebar-container>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{headerTitle}}</h1>
                        </div>
                        <div class="col-sm-6">
                            <Breadcrumbs/>
<!--                            <ol class="breadcrumb float-sm-right">-->
<!--                                <li class="breadcrumb-item"><a href="#">Home</a></li>-->
<!--                                <li class="breadcrumb-item active">Dashboard v1</li>-->
<!--                            </ol>-->
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <slot/>
            </section>
        </div>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.5
            </div>
        </footer>
    </div>
</template>

<script>
import Navbar from "../components/Navbar";
import MainSidebarContainer from "../components/MainSidebarContainer";
export default {
    name: "Panel",
    components: {MainSidebarContainer, Navbar},
    data() {
        return {
            headerTitle: ''
        }
    },
    created() {
        this.headerTitle = this.$route.meta.headerTitle;
    },
    watch: {
        '$route' (to, from) {
            this.headerTitle = to.meta.headerTitle;
        }
    },
}
</script>

<style scoped>

</style>
