<template>
    <div>
        <Header></Header>
        <Sidebar></Sidebar>
        <router-view></router-view>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from "../components/partials/Header.vue";
import Sidebar from "../components/Sidebar.vue";
import Main from "../components/partials/Main.vue";
import Footer from "../components/partials/Footer.vue";

export default {
    name: "App",
    components: {
        Header,
        Sidebar,
        Main,
        Footer,
    },
};
</script>

<style lang="scss"></style>
