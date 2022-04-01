<template>
<div class="">
    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3 p-0"
            v-for="(restaurant, index) in filteredRestaurants"
            :key="index">
            <a class="text-white text-center card m-2" href="">
                <img class="card-img h-100 w-100" :src=" require('../../../public/storage/uploads/pD2otbMppEzcCrCmf2eGotDwJp2X3o9lVgXMa7xP.jpg')" alt="foto-esempio">
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

<style lang="scss" scoped>

    // RESTAURANT CARD
    .card {
        height: 150px;
        min-width: 250px;
        overflow: hidden;
        border-radius: 20px;
        box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.2);
        &:hover,
        &:focus,
        &:active {
            .card-img {
                transform: scale(1.1);
                transition: transform .3s ease-in-out;
            }
            .card-img-overlay {
                background: none;
        }
        }
        .card-img {
            object-fit: cover;
        }
        .card-img-overlay {
            background: linear-gradient(
                0deg,
                rgba(0, 0, 0, 0.2) 0%,
                rgba(0, 0, 0, 0.3) 100%
            );
        }
        .card-title {
            font-weight: bold;
            font-size: 1.5em;
        }
    }
</style>
