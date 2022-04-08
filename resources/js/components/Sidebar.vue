<template>
    <div class="col-2">     
        <ul class="ks-cboxtags d-flex justify-content-center flex-wrap">
            <div
                v-for="(category, index) in categories"
                :key="index"
                class="btn-group px-1"
                aria-label="Basic checkbox toggle button"
            >
                <li>
                    <input type="checkbox" :id="category.name" :value="category.name" :name="category.name" v-model="selectedCategories" @change="filterCategories()">
                    <label :for="category.name">{{category.name}}</label>
                </li>
            </div>
        </ul>
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

// .form-check {
//     padding-left: 0;
// }

// .btn:active,
// .btn:hover,
// .btn:focus {
//     // background-color: #ff9999 !important;
//     box-shadow: 0 0 5px black;
// }

// .btn-outline-primary {
//     color: #7f282f;
//     border-color: #7f282f;
//     @include button-outline-variant(
//         #7f282f,
//         #222222,
//         lighten(#ff9999, 5%),
//         #7f282f
//     );
// }

body,
html {
    margin: 0;
    padding: 0;
}

body {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    background: #FFEFBA;
    /* fallback for old browsers */
    background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);
    /* Chrome 10-25, Safari 5.1-6 */
    background: linear-gradient(to right, #FFFFFF, #FFEFBA);
    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}

.container {
    max-width: 640px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-size: 13px;
}

ul.ks-cboxtags {
    list-style: none;
    padding: 20px;
}
ul.ks-cboxtags li{
  display: inline;
}
ul.ks-cboxtags li label{
    display: inline-block;
    background-color: rgba(255, 255, 255, .9);
    border: 2px solid rgba(139, 139, 139, .3);
    color: #adadad;
    border-radius: 25px;
    white-space: nowrap;
    margin: 3px 0px;
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    transition: all .2s;
}

ul.ks-cboxtags li label {
    padding: 8px 12px;
    cursor: pointer;
}

ul.ks-cboxtags li label::before {
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    font-size: 12px;
    padding: 2px 6px 2px 2px;
    content: "\f067";
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label::before {
    content: "\f00c";
    transform: rotate(-360deg);
    transition: transform .3s ease-in-out;
}

ul.ks-cboxtags li input[type="checkbox"]:checked + label {
    border: 2px solid #1bdbf8;
    background-color: #12bbd4;
    color: #fff;
    transition: all .2s;
}

ul.ks-cboxtags li input[type="checkbox"] {
  display: absolute;
}
ul.ks-cboxtags li input[type="checkbox"] {
  position: absolute;
  opacity: 0;
}
ul.ks-cboxtags li input[type="checkbox"]:focus + label {
  border: 2px solid #ff9999;
}

</style>
