<template>
    <div class="col">
        <h1>{{ myRestaurant.restaurant_name }}</h1>
        <div class="row w-100">
            <div class="col-7">
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 gy-2">
                    <div v-for="(dish, index) in menu" :key="index" class="col">
                        <div class="card h-100">
                            <div class="card-header">Menù</div>
                            <ul class="list-group list-group-flush">
                                <li v-if="dish.img" class="list-group-item">
                                    {{ dish.img }}
                                </li>
                                <li class="list-group-item">{{ dish.name }}</li>
                                <li class="list-group-item">
                                    {{ dish.description }}
                                </li>
                                <li class="list-group-item">
                                    {{ dish.price }}€
                                </li>
                                <li>
                                    quantità:
                                    <input
                                        v-model="dish.quantity"
                                        type="number"
                                        min="1"
                                    />
                                </li>
                                <li>
                                    <button
                                        @click="addToCart(dish)"
                                        class="btn btn-primary"
                                    >
                                        aggiungi al carrello
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5">
                <Cart :elementfromCart="elementCart" />
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
        };
    },
    methods: {
        addToCart(products) {
            this.elementCart = {
                productName: products.name,
                price: products.price,
                quantity: products.quantity,
                id: products.id,
            };
        },
    },

    created() {
        axios
            // CHIAMATA AXIOS CON AGGIUNTO L'ID DEL RISTORANTE
            .get(
                "http://127.0.0.1:8000/api/restaurants/filter/" + this.restId,
                {
                    headers: {
                        // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
                        Authorization: "Bearer " + this.apiKey,
                    },
                    params: { id: this.restId },
                }
            )
            .then((res) => {
                let response = res.data.results;

                this.menu = response.menu;
                this.menu.forEach((dish) => {
                    dish.quantity = 1;
                });
                console.log(response, "response");
                this.myRestaurant = response.restaurant;
            })
            .catch((err) => {
                console.log(err);
            });
        // }
    },
};
</script>

<style></style>
