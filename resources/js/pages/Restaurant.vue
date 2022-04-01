<template>
    <div class="col-10 d-flex">
        <div class="row w-100">
            <div class="col-7">
                <div class="card" style="width: 18rem">
                    <h1>{{ myRestaurant.restaurant_name }}</h1>
                    <div class="card-header">Menù</div>
                    <ul
                        v-for="(dish, index) in menu"
                        :key="index"
                        class="list-group list-group-flush"
                    >
                        <li v-if="dish.img" class="list-group-item">
                            {{ dish.img }}
                        </li>
                        <li class="list-group-item">{{ dish.name }}</li>
                        <li class="list-group-item">{{ dish.description }}</li>
                        <li class="list-group-item">{{ dish.price }}€</li>
                        <li>quantità:</li>
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
            <div class="col-5">
                <Cart />
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
            restId: this.$route.params.id,
            cart: [
                // {
                //     productName: null,
                //     qty: 0,
                //     price: null
                // }
            ],
        };
    },
    methods: {
        addToCart(products) {
            this.cart.push({
                productName: products.name,
                price: products.price,
            });

            localStorage.setItem("cart", JSON.stringify(this.cart));
        },
    },
    // props: {
    //     singleRestaurant: Object,
    //     id: Number
    // },
    // props: ["singleRestaurant", "id"],
    created() {
        // console.log(this.restId);
        // recupero l'id da localstore
        // localStorage.setItem('restaurantId',JSON.stringify(this.singleRestaurant.id));

        // this.restaurantIdLocalStorage = JSON.parse(localStorage.getItem("restaurantId"));

        // console.log(this.restaurantIdLocalStorage);

        // if(this.singleRestaurant) {
        // setTimeout(chiamata => {}, 1000);
        axios
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
