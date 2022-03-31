<template>
    <div class="row">
        <div
            v-for="(restaurant, index) in restaurants"
            :key="index"
            class="col-12 col-md-6 col-lg-3 card mb-3 mx-2"
            style="max-width: 400px"
        >
            <div class="h-100"></div>
            <div class="card-body">
                <h5 class="card-title">{{ restaurant.restaurant_name }}</h5>
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";

export default {
    name: "Home",
    data() {
        return {
            restaurants: [],
            apiKey: "deliveboo26313334",
        };
    },
    created() {
        axios
            .get("http://127.0.0.1:8000/api/restaurants/data", {
                headers: {
                    Authorization: "Bearer " + this.apiKey,
                },
            })
            .then((res) => {
                this.restaurants = res.data.results;
                console.log(this.restaurants);
            })
            .catch((err) => {
                console.log(err);
            });
    },
};
</script>

<style lang="scss"></style>
