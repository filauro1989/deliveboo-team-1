<template>
<div>
    <Jumbotron/>
    <div class="container">
        <div class="row">
            <Sidebar @sendRestaurants="getRestaurant($event)" class="col-2" />
            <div class="col-10">
                <transition-group
                    name="fade"
                    class="row row-cols-1 row-cols-md-2 row-cols-xl-4"
                >
                    <div
                        v-for="(restaurant, index) in restaurantLoaded"
                        :key="index + 1"
                        class="col p-0"
                        @click="clearLocalStorage()"
                    >
                        <router-link
                            :to="{
                                name: 'restaurant',
                                params: {
                                    slug: restaurant.slug,
                                    id: restaurant.id,
                                },
                            }"
                        >
                            <RestaurantCard
                                :restaurantName="restaurant.restaurant_name"
                                :restaurantImg="restaurant.image"
                            />
                        </router-link>
                    </div>
                </transition-group>
                <div
                    class="d-flex justify-content-center align-items-end position-fixed fixed-bottom mb-5"
                >
                    <button
                        v-if="listLength < restaurantsApp.length"
                        class="btn btn-success rounded-pill text-white mt-3"
                        @click="loadMore"
                    >
                        Mostra altri
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Axios from "axios";
import Jumbotron from "../components/Jumbotron.vue";
import Sidebar from "../components/Sidebar.vue";
import RestaurantCard from "../components/RestaurantCard.vue";

export default {
    name: "Home",
    components: {
        Jumbotron,
        Sidebar,
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
            restaurantsApp: [],
            listLength: 4,
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
        // CREO FUNZIONE PER PUSHARE L'EMIT DENTRO L'ARRAY restaurants
        getRestaurant(input) {
            this.restaurantsApp = input;
            // console.log(this.categories);
        },
        clearLocalStorage() {
            localStorage.clear();
        },

        loadMore() {
            if (this.listLength > this.restaurantsApp.length) {
                return;
            }
            this.listLength = this.listLength + 4;
        },
    },
    computed: {
        restaurantLoaded() {
            console.log("test");
            return this.restaurantsApp.slice(0, this.listLength);
        },
    },
};
</script>

<style lang="scss" scoped>
.test {
    transition: all 1s;
}

.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s;
    // transition-delay: 3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
    transform: translateY(200%);
}
</style>
