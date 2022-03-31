<template>
<div class="">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3"
            v-for="(restaurant, index) in filteredRestaurants"
            :key="index">
            <a class="text-white card p-0 m-2" href="">
                <img class="card-img" :src=" require('../../../public/storage/uploads/BXo64grHE7Zei04qTUv32Y3W575UUpg0B95Ei11x.jpg')" alt="foto-esempio">
                <div class="card-img-overlay h-100 posision-relative">
                    <h5 class="card-title position-absolute top-50 start-50 translate-middle">{{ restaurant.restaurant_name }}</h5>
                </div>
            </a>
        </div>
    </div>
</div>
</template>

<script>
import Axios from "axios";

export default {
    name: "Home",
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
            // CHIAMATA AXION PER PRENDERE I DATI DALLA ROTTA IN API.PHP
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

<style lang="scss">
.card {
    min-height: 0;
    height: 150px;
    min-width: 260px !important;
    &:hover,
    &:focus,
    &:active {
        .card-img {
            transform: scale(1.1);
            transition: transform .3s;
        }
    }
    .card-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .card-title {
        font-weight: bold;
        font-size: 1.5em;
    }
}
</style>
