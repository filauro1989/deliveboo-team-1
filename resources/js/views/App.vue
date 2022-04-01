<template>
    <div>
        <Header></Header>
        <!-- RICHIAMO DALLA SIDEBAR LA FUNZIONE EMIT sendCategories E LA COLLEGO CON LA FUNZIONE getCategory nei METHODS  -->
        <Sidebar @sendRestaurants="getRestaurant($event)"> </Sidebar>
        <!-- MANDO LE PROPS A HOME.VUE INVIANDO L'ARRAY categories -->
        <router-view :restaurantsArray="restaurants"></router-view>
        <Cart></Cart>
        <Footer></Footer>
    </div>
</template>

<script>
import Header from "../components/partials/Header.vue";
import Sidebar from "../components/Sidebar.vue";
import Cart from "../components/Cart.vue";
import Main from "../components/partials/Main.vue";
import Footer from "../components/partials/Footer.vue";

export default {
    name: "App",
    data() {
        return {
            restaurants: [],
        };
    },
    components: {
        Header,
        Sidebar,
        Cart,
        Main,
        Footer,
    },
    methods: {
        // CREO FUNZIONE PER PUSHARE L'EMIT DENTRO L'ARRAY restaurants
        getRestaurant(input) {
            this.restaurants = input;
            // console.log(this.categories);
        },
    },
};
</script>

<style lang="scss"></style>
