<template>
    <div class="col-2">
        <div class="checkbox-group">
            <div
                v-for="(category, index) in categories"
                :key="index"
                class="form-check"
                aria-label="Basic checkbox toggle button"
            >
                <!-- INVIO LE CATEGORIE ALL'APP TRAMITE L'EMIT -->
                <!-- PUSHO NELL'ARRAY selectedCategories TRAMITE IL V-MODEL -->
                <input
                    @change="filterCategories()"
                    v-model="selectedCategories"
                    class="form-check-input btn-check"
                    type="checkbox"
                    :name="category.name"
                    :value="category.name"
                    :id="category.name"
                />
                <label
                    class="btn btn-outline-primary btn-sm rounded-pill m-1"
                    :for="category.name"
                >
                    {{ category.name }}
                </label>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    name: "Sidebar",
    data() {
        return {
            restaurants: [],
            categories: [],
            selectedCategories: [],
            // CHIAVE INSERITA ANCHE NEL FILE ENV
            apiKey: "deliveboo26313334",
        };
    },
    created() {
        axios
            // CHIAMATA AXION PER PRENDERE I DATI DALLA ROTTA IN API.PHP
            .get("http://127.0.0.1:8000/api/categories/data", {
                headers: {
                    // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
                    Authorization: "Bearer " + this.apiKey,
                },
            })
            .then((res) => {
                this.categories = res.data.results;
            })
            .catch((err) => {
                console.log(err);
            });

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
                // console.log(this.categories);
                // console.log(this.restaurants);
                this.$emit("sendRestaurants", this.restaurants);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {
        filterCategories() {
            // this.restaurants.forEach((el) => {});
            axios
                .get("http://127.0.0.1:8000/api/restaurants/filtered", {
                    headers: {
                        // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
                        Authorization: "Bearer " + this.apiKey,
                    },
                    params: { categoriesArray: this.selectedCategories },
                })
                .then((res) => {
                    this.restaurants = res.data.results;
                    console.log(this.restaurants);
                    this.$emit("sendRestaurants", this.restaurants);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "bootstrap";

.form-check {
    padding-left: 0;
}

.btn:active,
.btn:hover,
.btn:focus {
    // background-color: #ff9999 !important;
    box-shadow: 0 0 5px black;
}

.btn-outline-primary {
    color: #7f282f;
    border-color: #7f282f;
    @include button-outline-variant(
        #7f282f,
        #222222,
        lighten(#ff9999, 5%),
        #7f282f
    );
}
</style>
