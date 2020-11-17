<template>
    <div class="wrapper">
        <navbar></navbar>
        <main-sidebar-container></main-sidebar-container>

        <div class="content-wrapper">
            <main>
                <slot/>
            </main>
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
    name: "Dashboard",
    components: {MainSidebarContainer, Navbar},
}
</script>

<style scoped>

</style>
