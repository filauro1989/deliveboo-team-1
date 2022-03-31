<template>
    <div>
        <Header></Header>
        <!-- RICHIAMO DALLA SIDEBAR LA FUNZIONE EMIT sendCategories E LA COLLEGO CON LA FUNZIONE getCategory nei METHODS  -->
        <Sidebar @sendCategories="getCategory($event)"> </Sidebar>
        <!-- MANDO LE PROPS A HOME.VUE INVIANDO L'ARRAY categories -->
        <router-view :categoriesArray="categories"></router-view>
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
    data() {
        return {
            categories: [],
        };
    },
    components: {
        Header,
        Sidebar,
        Main,
        Footer,
    },
    methods: {
        // CREO FUNZIONE PER PUSHARE L'EMIT DENTRO L'ARRAY categories
        getCategory(input) {
            this.categories = input;
            // console.log(this.categories);
        },
    },
};
</script>

<style lang="scss"></style>
