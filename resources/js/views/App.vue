<template>
    <div class="container-fluid">
        <Header></Header>
        <!-- RICHIAMO DALLA SIDEBAR LA FUNZIONE EMIT sendCategories E LA COLLEGO CON LA FUNZIONE getCategory nei METHODS  -->
        <div class="row w-100">
            <!-- <Sidebar @sendRestaurants="getRestaurant($event)"> </Sidebar> -->
            <!-- MANDO LE PROPS A HOME.VUE INVIANDO L'ARRAY categories -->
            <!-- MANDO LE PROPS totalAmountFromApp ad CHECKOUT.VUE -->
            <!-- @sendToApp="getCartTotalAmount($event)" -->
            <router-view
                :restaurantsArray="restaurants"
                :totalAmountFromApp="cartTotalAmount"
            ></router-view>
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
        getRestaurant(input) {
            this.restaurants = input;
            // console.log(this.categories);
        },
        // FUNZIONE CHE CATTURA EVENT E PUSHA DENTRO L'ARRAY cartTotalAmount
        // getCartTotalAmount(event) {
        //     this.cartTotalAmount = event;
        // },
    },
};
</script>

<style lang="scss"></style>
