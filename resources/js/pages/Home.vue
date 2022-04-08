<template>
    <div>
        <Jumbotron />

        <svg
            id="visual"
            viewBox="0 0 900 100"
            width="100%"
            height="100%"
            xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink"
            version="1.1"
        >
            <rect x="0" y="0" width="900" height="100" fill="#FFECEC"></rect>
            <path
                d="M0 24L37.5 30.3C75 36.7 150 49.3 225 56C300 62.7 375 63.3 450 59.7C525 56 600 48 675 43.2C750 38.3 825 36.7 862.5 35.8L900 35L900 0L862.5 0C825 0 750 0 675 0C600 0 525 0 450 0C375 0 300 0 225 0C150 0 75 0 37.5 0L0 0Z"
                fill="#FF9999"
                stroke-linecap="round"
                stroke-linejoin="miter"
            ></path>
        </svg>

        <div class="container">
            <div class="row">
                <div class="mb-5 category-container p-5">
                    <h3 class="text-center">
                        Seleziona una o più categorie
                    </h3>
                    <Sidebar
                        @sendRestaurants="getRestaurant($event)"
                        class="col-12"
                    />
                </div>
                <h1 class="text-center">
                    Ecco i Ristoranti nella tua zona
                </h1>
                <div class="col-12">
                    <transition-group
                        name="fade"
                        class="row row-cols-1 row-cols-md-2 row-cols-xl-4"
                    >
                        <div
                            v-for="(restaurant, index) in restaurantLoaded"
                            :key="index + 1"
                            class="col d-flex justify-content-center p-0"
                            @click="clearLocalStorage(restaurant.slug)"
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
                        class="d-flex justify-content-center align-items-end mb-5"
                    >
                        <button
                            v-if="listLength < restaurantsApp.length"
                            class="btn my_btn rounded-pill text-white mt-3"
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
            listLength: 16,
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
                    // console.log(this.restaurants);
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
        clearLocalStorage(currentRestaurantSlug) {
            if (
                JSON.parse(localStorage.getItem("restaurantSlug")) !=
                currentRestaurantSlug || JSON.parse(localStorage.getItem("restaurantSlug")) == undefined
            ) {
                localStorage.clear();
            }
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
            // console.log("test");
            return this.restaurantsApp.slice(0, this.listLength);
        },
    },
};
</script>

<style lang="scss" scoped>
.home-container {
    width: 85%;
    margin: 0 auto;
}
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

.btn.my_btn {
    background-color: #0075a5 !important;
}

.category-container {
    background-color: #f8da9e;
    border-radius: 20px;
}
</style>
