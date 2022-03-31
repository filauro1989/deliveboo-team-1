<template>
    <div class="">
        <div class="checkbox-group">
            <div
                v-for="(category, index) in categories"
                :key="index"
                class="form-check"
            >
                <input
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
            apiKey: "deliveboo26313334",
        };
    },
    created() {
        axios
            .get("http://127.0.0.1:8000/api/categories/data", {
                headers: {
                    Authorization: "Bearer " + this.apiKey,
                },
            })
            .then((res) => {
                this.categories = res.data.results;
                console.log(this.categories);
            })
            .catch((err) => {
                console.log(err);
            });
    },
    methods: {},
};
</script>

<style></style>
