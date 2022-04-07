<template>
    <div class="container-fluid">
        <Header></Header>
        <div class="row mx-0 w-100">
            <!-- MANDO LE PROPS A HOME.VUE INVIANDO L'ARRAY categories -->
            <!-- :restaurantsArray="restaurants" -->
            <router-view></router-view>
        </div>
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
            restaurants: [],
            cartTotalAmount: 0,
        };
    },
    components: {
        Header,
        Sidebar,
        Main,
        Footer,
    },
    methods: {
        // CREO FUNZIONE PER PUSHARE L'EMIT DENTRO L'ARRAY restaurants
        // getRestaurant(input) {
        //     this.restaurants = input;
        //     // console.log(this.categories);
        // },
    },
};
</script>

<style lang="scss">
template {
    font-family: "Nunito", sans-serif !important;
}
</style>
