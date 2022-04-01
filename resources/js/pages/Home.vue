<template>
<div class="">
    <div class="row">
        <RestaurantCard
            v-for="(restaurant, index) in filteredRestaurants"
            :key="index"
            :restaurantName = "restaurant.restaurant_name"
            :restaurantImg = "restaurant.image"
        />
    </div>
</div>
</template>

<script>
import Axios from "axios";
import RestaurantCard from '../components/RestaurantCard.vue';

export default {
    name: "Home",
    components: {
        RestaurantCard,
    },
    // PRENDO TRAMITE LE PROPS L'ARRAY CATEGORIES DALLA PAGINA APP.VUE
    props: {
        categoriesArray: Array,
    },
    data() {
        return {
            restaurants: [],
            filteredRestaurants: [],
            apiKey: "deliveboo26313334",
        };
    },
    created() {
        axios
            // CHIAMATA AXIOS PER PRENDERE I DATI DALLA ROTTA IN API.PHP
            .get("http://127.0.0.1:8000/api/restaurants/data", {
                headers: {
                    // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
                    Authorization: "Bearer " + this.apiKey,
                },
            })
            .then((res) => {
                this.restaurants = res.data.results;
                // console.log(this.restaurants);
                // SE LA LUNGHEZZA DELL'ARRAY FILTRATO è 0 CI PUSHO TUTTI I RISTORANTI (ALTRIMENTI AVREI PAGINA VUOTA SEMPRE)
                if (this.filteredRestaurants.length == 0) {
                    this.filteredRestaurants.push(...this.restaurants);
                    console.log(this.restaurants);
                }
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        // filterCategories() {
        //     // this.restaurants.forEach((el) => {});
        //     axios
        //         .get("http://127.0.0.1:8000/api/restaurants/filtered", {
        //             headers: {
        //                 // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
        //                 Authorization: "Bearer " + this.apiKey,
        //             },
        //             params: {
        //                 categoriesArray,
        //             },
        //         })
        //         .then((res) => {
        //             console.log(res);
        //         })
        //         .catch((err) => {
        //             console.log(err);
        //         });
        // },
    },
};
</script>

<style lang="scss" scoped>

</style>
