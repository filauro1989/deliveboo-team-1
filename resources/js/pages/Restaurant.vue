<template>
    <div>
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
                <div class="col">
                    <h1>{{ myRestaurant.restaurant_name }}</h1>
                    <div class="row m-0">
                        <div class="col-xl-7 pt-3">
                            <!-- row-cols-1 row-cols-md-2 row-cols-xl-4 -->
                            <div class="row gy-5 gx-4 mb-5">
                                <template v-for="(dish, index) in menu">
                                    <div
                                        v-if="dish.visible"
                                        :key="index"
                                        class="col-12 col-md-4 col-xl-4"
                                    >
                                        <div
                                            class="card card-product d-flex justify-content-between px-2"
                                        >
                                            <div
                                                class="image-price-container h-100"
                                            >
                                                <div class="card-image">
                                                    <div
                                                        class="card-image-container w-100 h-100"
                                                    >
                                                        <img
                                                            v-if="dish.image"
                                                            class="img"
                                                            :src="
                                                                '/storage/' +
                                                                dish.image
                                                            "
                                                        />
                                                        <img
                                                            v-else
                                                            class="img"
                                                            :src="'/storage/uploads/default_image.jpg'"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="price">
                                                    <h4 class="m-0">
                                                        {{
                                                            dish.price.toFixed(
                                                                2
                                                            )
                                                        }}€
                                                    </h4>
                                                </div>
                                                <h4 class="card-caption mt-3">
                                                    {{ dish.name }}
                                                </h4>
                                                <div class="card-description">
                                                    {{ dish.description }}
                                                </div>
                                            </div>
                                            <div
                                                class="ftr d-flex align-items-center justify-content-around pb-4 pb-md-2"
                                            >
                                                <div
                                                    class="d-flex align-items-end p-2"
                                                >
                                                    <button
                                                        class="quantity-btn"
                                                        @click="
                                                            changeQuantity(
                                                                dish,
                                                                -1
                                                            )
                                                        "
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                    >
                                                        -
                                                    </button>
                                                    <div
                                                        class="quantity-container w-50 d-flex flex-column align-items-center"
                                                    >
                                                        <label :for="dish.id"
                                                            >Q.tà</label
                                                        >
                                                        <input
                                                            :id="dish.id"
                                                            v-model="
                                                                dish.quantity
                                                            "
                                                            type="number"
                                                            min="1"
                                                            disabled
                                                            class="w-50 text-center m-0"
                                                            name="quantity"
                                                        />
                                                    </div>
                                                    <button
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                        class="quantity-btn"
                                                        @click="
                                                            changeQuantity(
                                                                dish,
                                                                +1
                                                            )
                                                        "
                                                    >
                                                        +
                                                    </button>
                                                </div>
                                                <div class="stats mt-4 me-3">
                                                    <button
                                                        type="button"
                                                        rel="tooltip"
                                                        title=""
                                                        class="btn btn-just-icon btn-simple btn-warning rounded-pill"
                                                        data-original-title="Saved to Wishlist"
                                                        @click="addToCart(dish)"
                                                    >
                                                        <i
                                                            class="btn-cart fa fa-shopping-cart"
                                                        ></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                        <div class="col-xl-5 my-5">
                            <Cart :elementfromCart="elementCart" :slug="slug" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Cart from "../components/Cart.vue";
export default {
    name: "Restaurant",
    components: {
        Cart,
    },
    data() {
        return {
            apiKey: "deliveboo26313334",
            menu: [],
            myRestaurant: [],
            restaurantIdLocalStorage: null,
            // PRENDO ID DEL RISTORANTE DAI PARAMS CHE CI MANDA home.vue
            restId: this.$route.params.id,
            elementCart: {},
            slug: this.$route.params.slug,
        };
    },
    methods: {
        addToCart(products) {
            this.elementCart = {
                productName: products.name,
                price: products.price,
                quantity: parseInt(products.quantity),
                id: products.id,
            };
        },
        changeQuantity(dish, num) {
            if (dish.quantity + num > 0) {
                dish.quantity = parseInt(dish.quantity) + parseInt(num);
            }
            // for (let index = 0; index < this.menu.length; index++) {
            //     const element = this.menu[index];
            //     // SE IL NOME DEL PIATTO è UGUALE AL NOME DELL'ELEMENTO SU CUI CICLO
            //     if (
            //         dish.name == element.name &&
            //         element.quantity + num > 0
            //     ) {
            //         // VARIO LA QUANTITà DELL'ELEMENTO DI += num
            //         element.quantity += num;
            //         // VARIO LA QUANTITà DELL'ARRAY DI APPOGGIO DI += num

            //     }
            // }
        },
    },

    created() {
        axios
            // CHIAMATA AXIOS CON AGGIUNTO LO SLUG DEL RISTORANTE
            .get("http://127.0.0.1:8000/api/restaurants/filter/" + this.slug, {
                headers: {
                    // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
                    Authorization: "Bearer " + this.apiKey,
                },
                params: { id: this.slug },
            })
            .then((res) => {
                let response = res.data.results;

                this.menu = response.menu;
                this.menu.forEach((dish) => {
                    dish.quantity = 1;
                });
                // console.log(response, "response");
                this.myRestaurant = response.restaurant;
                // console.log(this.menu, "menu");
            })
            .catch((err) => {
                console.log(err);
            });
    },

    beforeRouteLeave(to, from, next) {
        //se il carrello del localStorage è pieno entro nella condizione
        if (localStorage.getItem("cart")) {
            //se la destinazione è diversa dal checkout chiedo la conferma
            if (to.name != "checkout") {
                if (
                    confirm(
                        "Sei sicuro di voler uscire? Se cambi ristorante il tuo carrello verrà cestinato"
                    )
                ) {
                    next();
                } else {
                    next(false);
                }
            }
            //se la destinazione è checkout vado avanti senza chiedere
            else {
                next();
            }
            // se il localStorage è vuoto vado avanti senza chiedere
        } else {
            next();
        }
    },
};
</script>

<style lang="scss" scoped>
@import url("https://fonts.googleapis.com/css2?family=Indie+Flower&family=Pacifico&display=swap");
@import "bootstrap";

.section-cards {
    z-index: 3;
    position: relative;
}

.section-gray {
    background: #e5e5e5;
    padding: 60px 0 30px 0;
}

.quantity-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 20px;
    height: 20px;
    color: #00c7fa;
    border: 2px solid #00c7fa;
    border-radius: 50%;
    transition: all 0.3s;
}
.quantity-btn:hover {
    background-color: #00c7fa;
    color: white;
    border: 2px solid white;
    transform: scale(1.1);
}

@include media-breakpoint-down(md) {
    .quantity-btn {
        width: 50px;
        height: 50px;
        background-color: #00c7fa;
        color: white;
        border: 2px solid white;
        font-size: 1.8em;
    }
    .quantity-btn:hover {
        background-color: white;
        color: #00c7fa;
        border: 2px solid #00c7fa;
    }
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    background-color: white;
}

/*---------------------------------------------------------------------- /
CARDS
----------------------------------------------------------------------- */

.card {
    display: inline-block;
    position: relative;
    height: 100%;
    max-height: 375px;
    margin-bottom: 30px;
    border-radius: 6px;
    color: rgba(0, 0, 0, 0.87);
    background: #fff;
}

.image-price-container {
    position: relative;

    .price {
        position: absolute;
        top: -20px;
        right: 0;
        font-size: 1rem;
        background-color: #5cdeff;
        color: white;
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        font-family: "Pacifico", cursive;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
            0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
    }
}

.card .card-image {
    width: 6rem;
    height: 6rem;
    top: 0;
    left: 0;
    position: relative;
    overflow: hidden;
    margin-left: 15px;
    margin-right: 15px;
    margin-top: -30px;
    border-radius: 6px;
    transition: all 0.3s ease-out;
    cursor: pointer;
}

.card-image:active,
.card-image:focus {
    position: absolute;
    transform: scale(2.2);
    top: 50%;
    left: 20%;
    // transform: translate(44%, 100%) scale(2.2);
    // transform: scale(1.2);
    // z-index: 3;
}
// .card-image:active ~ .card-caption,
// .card-image:focus ~ .card-caption,
// .card-image:hover ~ .card-caption,
// .card-image:active ~ .card-description,
// .card-image:focus ~ .card-description,
.card-image:active ~ .card-caption,
.card-image:active ~ .card-description {
    opacity: 0;
}
@include media-breakpoint-down(xxl) {
    .card-image:active,
    .card-image:focus {
        position: absolute;
        transform: scale(1.8);
        top: 50%;
        left: 15%;
        z-index: 3;
    }
}
@include media-breakpoint-down(xl) {
    .card-image:active,
    .card-image:focus {
        position: absolute;
        transform: scale(2.8);
        top: 60%;
        left: 27%;
        z-index: 3;
    }
}
@include media-breakpoint-down(lg) {
    .card-image:active,
    .card-image:focus {
        position: absolute;
        transform: scale(2);
        top: 55%;
        left: 17%;
        z-index: 3;
    }
}
@include media-breakpoint-down(md) {
    .card-image:active,
    .card-image:focus {
        position: absolute;
        transform: scale(2.2);
        top: 60%;
        left: 37%;
        z-index: 3;
    }
}
@include media-breakpoint-down(sm) {
    .card-image:active,
    .card-image:focus {
        position: absolute;
        transform: scale(2.2);
        top: 60%;
        left: 28%;
        z-index: 3;
    }
}

.card .card-image img {
    width: 100%;
    height: auto;
    border-radius: 6px;
    pointer-events: none;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border: 1px solid rgba(0, 0, 0, 0.2);
}

.card .card-image .card-caption {
    position: absolute;
    bottom: 15px;
    left: 15px;
    color: #fff;
    font-size: 1em;
    text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5);
}

.card img {
    width: 100%;
    height: auto;
}

.img-raised {
    box-shadow: 0 16px 38px -12px rgba(0, 0, 0, 0.56),
        0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
}

.card .ftr {
    margin-top: 15px;
}

.card .ftr div {
    display: inline-block;
}

.card .ftr .author {
    color: #888;
}

.card .ftr .stats {
    float: right;
    line-height: 30px;
}

.card .ftr .stats {
    position: relative;
    top: 1px;
    font-size: 14px;
}

/* ============ Card Table ============ */

.table {
    margin-bottom: 0px;
}

.card .table {
    padding: 15px 30px;
}

.card .table-primary {
    background: linear-gradient(60deg, #ab47bc, #7b1fa2);
}

.card .table-info {
    background: linear-gradient(60deg, #26c6da, #0097a7);
}

.card .table-success {
    background: linear-gradient(60deg, #66bb6a, #388e3c);
}

.card .table-warning {
    background: linear-gradient(60deg, #ffa726, #f57c00);
}

.card .table-danger {
    background: linear-gradient(60deg, #ef5350, #d32f2f);
}

.card .table-rose {
    background: linear-gradient(60deg, #ec407a, #c2185b);
}

.card [class*="table-"] {
    color: #ffffff;
    border-radius: 6px;
}

.card [class*="table-"] .card-caption a,
.card [class*="table-"] .card-caption,
.card [class*="table-"] .icon i {
    color: #ffffff;
}

.card [class*="table-"] .icon i {
    border-color: rgba(255, 255, 255, 0.25);
}

.card [class*="table-"] .author a,
.card [class*="table-"] .ftr .stats,
.card [class*="table-"] .category,
.card [class*="table-"] .card-description {
    color: rgba(255, 255, 255, 0.8);
}

.card [class*="table-"] .author a:hover,
.card [class*="table-"] .author a:focus,
.card [class*="table-"] .author a:active {
    color: #ffffff;
}

.card [class*="table-"] h1 small,
.card [class*="table-"] h2 small,
.card [class*="table-"] h3 small {
    color: rgba(255, 255, 255, 0.8);
}

/* ============ Card Background ============ */

.card-background {
    background-position: center;
    background-size: cover;
    text-align: center;
}

.card-background .table {
    position: relative;
    z-index: 2;
    min-height: 280px;
    padding-top: 40px;
    padding-bottom: 40px;
    max-width: 440px;
    margin: 0 auto;
}

.card-background .category,
.card-background .card-description,
.card-background small {
    color: rgba(255, 255, 255, 0.8);
}

.card-background .card-caption {
    color: #ffffff;
    margin-top: 10px;
}

.card-background:after {
    position: absolute;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: block;
    left: 0;
    top: 0;
    table: "";
    background-color: rgba(0, 0, 0, 0.56);
    border-radius: 6px;
}

/* ============ Card Product ============ */

.card-product {
    margin-top: 30px;
}

.card-product .btn-simple.btn-just-icon {
    padding: 0;
}

.card-product .ftr {
    margin-top: 5px;
}

.card-product .ftr .stats {
    margin-top: 4px;
    top: 0;
}

.card-product .ftr h4 {
    margin-bottom: 0;
}

.card-product .card-caption,
.card-product .category,
.card-product .card-description {
    text-align: center;
}

.card-description {
    max-height: 130px;
    overflow-y: auto;
    font-size: 0.9em;
    p {
        color: #888;
    }
}

.card-caption,
.card-caption a {
    color: #333;
    text-decoration: none;
}

.card-caption {
    font-weight: 700;
    // font-family: "Roboto Slab", "Times New Roman", serif;
}

/* ============ Text Color ============ */

.text-warning {
    color: #ff9800;
}

.text-primary {
    color: #9c27b0;
}

.text-danger {
    color: #f44336;
}

.text-success {
    color: #4caf50;
}

.text-info {
    color: #00bcd4;
}

.text-rose {
    color: #e91e63;
}

.text-gray {
    color: #888;
}

/*---------------------------------------------------------------------- /
BUTTONS
----------------------------------------------------------------------- */

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}

.btn-cart:hover,
.btn-cart:active,
.btn-cart:focus {
    transform: scale(1.3);
    transition: transform 0.2s ease-in-out;
}
@include media-breakpoint-down(md) {
    .btn-cart {
        transform: scale(2);
    }
    .btn-cart:hover,
    .btn-cart:active,
    .btn-cart:focus {
        transform: scale(2.2);
        transition: transform 0.2s ease-in-out;
    }
}

.btn,
.navbar .navbar-nav > li > a.btn {
    border: none;
    border-radius: 3px;
    position: relative;
    padding: 12px 30px;
    margin: 10px 1px;
    font-size: 12px;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 0;
    will-change: box-shadow, transform;
    transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1),
        background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

.btn:focus,
.btn:active,
.btn:active:focus {
    outline: 0;
}

.btn.btn-round,
.navbar .navbar-nav > li > a.btn.btn-round {
    border-radius: 30px;
}

.btn.btn-just-icon,
.navbar .navbar-nav > li > a.btn.btn-just-icon {
    font-size: 20px;
    padding: 12px 12px;
    line-height: 1em;
}

.btn.btn-just-icon i,
.navbar .navbar-nav > li > a.btn.btn-just-icon i {
    width: 20px;
}

/* Button Info */

.btn.btn-info {
    background-color: #00bcd4;
    color: #ffffff;
}

.btn.btn-info:focus,
.btn.btn-info:active,
.btn.btn-info:hover {
    box-shadow: 0 14px 26px -12px rgba(0, 188, 212, 0.42),
        0 4px 23px 0px rgba(0, 0, 0, 0.12),
        0 8px 10px -5px rgba(0, 188, 212, 0.2);
}

/* Button Danger */

.btn.btn-danger {
    background-color: #f44336;
    color: #ffffff;
}

.btn.btn-danger:focus,
.btn.btn-danger:active,
.btn.btn-danger:hover {
    box-shadow: 0 14px 26px -12px rgba(244, 67, 54, 0.42),
        0 4px 23px 0px rgba(0, 0, 0, 0.12),
        0 8px 10px -5px rgba(244, 67, 54, 0.2);
}

/* Button Warning */

.btn.btn-warning.btn-simple:hover,
.btn.btn-warning.btn-simple:focus,
.btn.btn-warning.btn-simple:active {
    background-color: transparent;
    color: #ff9800;
}

.btn.btn-warning.btn-simple,
.navbar .navbar-nav > li > a.btn.btn-warning.btn-simple {
    background-color: transparent;
    color: #ff9800;
    box-shadow: none;
}

.btn.btn-warning,
.navbar .navbar-nav > li > a.btn.btn-warning {
    box-shadow: 0 2px 2px 0 rgba(255, 152, 0, 0.14),
        0 3px 1px -2px rgba(255, 152, 0, 0.2),
        0 1px 5px 0 rgba(255, 152, 0, 0.12);
}

/* Button Rose */

.btn.btn-rose.btn-simple:hover,
.btn.btn-rose.btn-simple:focus,
.btn.btn-rose.btn-simple:active {
    background-color: transparent;
    color: #e91e63;
}

.btn.btn-rose.btn-simple,
.navbar .navbar-nav > li > a.btn.btn-rose.btn-simple {
    background-color: transparent;
    color: #e91e63;
    box-shadow: none;
}

/* Button White */

.btn.btn-white,
.btn.btn-white:focus,
.btn.btn-white:hover {
    background-color: #ffffff;
    color: #888;
}

.btn.btn-white.btn-simple,
.navbar .navbar-nav > li > a.btn.btn-white.btn-simple {
    color: #ffffff;
    background: transparent;
    box-shadow: none;
}

/*---------------------------------------------------------------------- /
BOOTSTRAP COL-MD-12 CLASS
----------------------------------------------------------------------- */

.col-md-12 {
    padding-right: 0px;
    padding-left: 0px;
}

/*---------------------------------------------------------------------- /
FONT AWESOME FA CLASS
----------------------------------------------------------------------- */

.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

/***********Only4Demo*******************/
/**************************************/

/* ======= GENERAL  ======= */

body,
h1,
h2,
h3,
h4,
h5,
h6,
.h1,
.h2,
.h3,
.h4 {
    // font-family: "Roboto", "Helvetica", "Arial", sans-serif;
    font-weight: 300;
    line-height: 1.5em;
}

a {
    color: #9c27b0;
    text-decoration: none;
}

a:hover {
    color: #9c27b0;
    text-decoration: underline;
}

p {
    color: #3c4857;
}

header {
    border-bottom: 1px solid #dedede;
    text-align: center;
}

h1,
.h1 {
    font-size: 3.8em;
}

h2,
.h2 {
    font-size: 2em;
    line-height: 1.6em;
    margin: 15px 0 15px;
    font-weight: 700;
    // font-family: "Roboto Slab", "Times New Roman", serif;
    text-align: center;
}

h3,
.h3 {
    font-size: 1.825em;
    line-height: 1.4em;
    margin: 30px 0 30px;
    font-weight: 700;
    // font-family: "Roboto Slab", "Times New Roman", serif;
    text-align: center;
}

h4,
.h4 {
    font-size: 1.35em;
    line-height: 1.55em;
}

h5,
.h5 {
    font-size: 1.25em;
    line-height: 1.55em;
    margin-bottom: 15px;
}

h6,
.h6 {
    font-size: 0.9em;
    font-weight: 500;
}
</style>
