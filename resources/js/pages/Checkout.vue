<template>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <!-- <div>dati UTENTE</div>
                <div id="dropin-container"></div>
                <button
                    id="submit-button"
                    class="button button--small button--green"
                >
                    Purchase
                </button> -->
                <form>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input
                            min="3"
                            max="50"
                            required
                            v-model="orderInfo.name"
                            type="text"
                            class="form-control"
                            id="name"
                            placeholder="Inserisci il tuo nome"
                        />
                    </div>
                    <div class="form-group">
                        <label for="surname">Cognome</label>
                        <input
                            min="3"
                            max="50"
                            required
                            v-model="orderInfo.surname"
                            type="text"
                            class="form-control"
                            id="surname"
                            placeholder="Inserisci il tuo cognome"
                        />
                    </div>
                    <div class="form-group">
                        <label for="address"
                            >Inserisci l'indirizzo per la consegna</label
                        >
                        <input
                            min="3"
                            max="50"
                            required
                            v-model="orderInfo.address"
                            type="text"
                            class="form-control"
                            id="address"
                            placeholder="Inserisci l'indirizzo per la consegna"
                        />
                    </div>
                    <div class="form-group">
                        <label for="email"
                            >Inserisci il tuo indirizzo e-mail</label
                        >
                        <input
                            required
                            v-model="orderInfo.mail"
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Inserisci il tuo indirizzo e-mail"
                        />
                    </div>

                    <!-- <button type="submit" class="btn btn-primary">
                        Submit
                    </button> -->
                    <v-braintree
                        authorization="sandbox_8hskcmnn_tcmvbbfg3pvh5s7s"
                        @success="onSuccess"
                        @error="onError"
                    ></v-braintree>
                </form>
            </div>
            <div class="col-6">
                <Cart />
            </div>
        </div>
    </div>
</template>

<script>
import Axios from "axios";
import Cart from "../components/Cart.vue";
export default {
    name: "Checkout",
    data() {
        return {
            orderInfo: {
                name: "",
                surname: "",
                address: "",
                mail: "",
                // INTERCETTO I PARAMS DAL CARRELLO
                totalAmount: this.$route.params.totalAmount,
                cartStorage: this.$route.params.cartStorage,
            },
            apiKey: "deliveboo26313334",
        };
    },
    components: {
        Cart,
    },
    methods: {
        onSuccess(payload) {
            let nonce = payload.nonce;
            const headers = {
                "Content-Type": "application/json",
                Authorization: "Bearer " + this.apiKey,
            };
            axios
                // CHIAMATA IN POST VA SCRITTA CON PARAMS DOPO L'INDIRIZZO E DOBBIAMO SPECIFICARE L'HEADER FUORI DALLA FUNZIONE COME COSTANTE
                .post(
                    "http://127.0.0.1:8000/api/checkout/payment",
                    {
                        params: {
                            form: this.orderInfo,
                        },
                    },
                    {
                        headers: headers,
                    }
                )
                .then((res) => {
                    console.log(res);
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        onError(error) {
            let message = error.message;
            // Whoops, an error has occured while trying to get the nonce
        },
    },
    created() {
        // BRAINTREE JAVASCRIPT AL CREATED
        // var button = document.querySelector("#submit-button");
        // braintree.dropin.create(
        //     {
        //         authorization: "sandbox_g42y39zw_348pk9cgf3bgyw2b",
        //         selector: "#dropin-container",
        //     },
        //     function (err, instance) {
        //         button.addEventListener("click", function () {
        //             instance.requestPaymentMethod(function (err, payload) {
        //                 // Submit payload.nonce to your server
        //             });
        //         });
        //     }
        // );
    },
};
</script>

<style lang="scss" scoped>
.button {
    cursor: pointer;
    font-weight: 500;
    left: 3px;
    line-height: inherit;
    position: relative;
    text-decoration: none;
    text-align: center;
    border-style: solid;
    border-width: 1px;
    border-radius: 3px;
    -webkit-appearance: none;
    -moz-appearance: none;
    display: inline-block;
}

.button--small {
    padding: 10px 20px;
    font-size: 0.875rem;
}

.button--green {
    outline: none;
    background-color: #64d18a;
    border-color: #64d18a;
    color: white;
    transition: all 200ms ease;
}

.button--green:hover {
    background-color: #8bdda8;
    color: white;
}
</style>
