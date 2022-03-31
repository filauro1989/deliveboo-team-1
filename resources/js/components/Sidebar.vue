<template>
    <div class="">
        <div class="checkbox-group">
            <div
                v-for="(category, index) in categories"
                :key="index"
                class="form-check"
            >
                <!-- INVIO LE CATEGORIE ALL'APP TRAMITE L'EMIT -->
                <!-- PUSHO NELL'ARRAY selectedCategories TRAMITE IL V-MODEL -->
                <input
                    @change="
                        $emit('sendCategories', selectedCategories);
                        filterCategories();
                    "
                    v-model="selectedCategories"
                    class="form-check-input"
                    type="checkbox"
                    :name="category.name"
                    :value="category.name"
                    id="flexCheckDefault"
                />
                <label class="form-check-label" :for="category.name">
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
                // console.log(this.categories);
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
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
    },
};
</script>

<style></style>
