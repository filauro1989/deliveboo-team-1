<template>
    <div class="">
        <div class="row">
            <!-- <a href=""> -->
            <!-- <router-link
                :to="{ name: 'restaurant', params: { id: restaurant.id } }"
                v-for="(restaurant, index) in restaurantsArray"
                :key="index"
                class="col-12 col-md-6 col-lg-3 card mb-3 mx-2"
                style="max-width: 400px"
            >
                <div class="h-100"></div>
                <div class="card-body">
                    <h5 class="card-title">{{ restaurant.restaurant_name }}</h5>
                </div>
            </router-link> -->

            <router-link
                class="col-sm-12 col-md-6 col-lg-3 p-0"
                :to="{ name: 'restaurant', params: { id: restaurant.id } }"
                v-for="(restaurant, index) in restaurantsArray"
                :key="index"
            >
                <RestaurantCard
                    :restaurantName="restaurant.restaurant_name"
                    :restaurantImg="restaurant.image"
                />
            </router-link>
            <!-- </a> -->

            <!-- COMPONENTE CARD RISTORANTE -->
            <!-- <RestaurantCard
                v-for="(restaurant, index) in restaurantsArray"
                :key="index"
                :restaurantName="restaurant.restaurant_name"
                :restaurantImg="restaurant.image"
            /> -->
        </div>
    </div>
</template>

<script>
import Axios from "axios";
import RestaurantCard from "../components/RestaurantCard.vue";

export default {
    name: "Home",
    components: {
        RestaurantCard,
    },
    // PRENDO TRAMITE LE PROPS L'ARRAY CATEGORIES DALLA PAGINA APP.VUE
    props: {
        restaurantsArray: Array,
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
    methods: {},
};
</script>

<style lang="scss" scoped></style>
