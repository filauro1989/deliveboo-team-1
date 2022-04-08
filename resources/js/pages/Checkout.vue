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
                <div class="col-xl-6">
                    <!-- <div>dati UTENTE</div>
                <div id="dropin-container"></div>
                <button
                    id="submit-button"
                    class="button button--small button--green"
                >
                    Purchase
                </button> -->
                    <form @submit.prevent>
                        <h2 class="big-title">
                            Inserisci i tuoi dati prima di procedere al
                            pagamento:
                        </h2>
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
                                >Indirizzo per la consegna</label
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
                            <label for="email">Indirizzo e-mail</label>
                            <input
                                v-model="orderInfo.mail"
                                type="email"
                                required
                                class="form-control"
                                id="email"
                                placeholder="Inserisci il tuo indirizzo e-mail"
                            />
                        </div>

                        <button
                            @click="checkIfChecked()"
                            type="submit"
                            class="btn btn-primary mt-2"
                        >
                            Conferma
                        </button>
                    </form>
                    <transition name="fade">
                        <div
                            v-if="
                                dataChecked &&
                                orderInfo.name.trim().length > 0 &&
                                orderInfo.surname.trim().length > 0 &&
                                orderInfo.address.trim().length > 0 &&
                                orderInfo.mail.trim().length > 0
                            "
                        >
                            <v-braintree
                                authorization="sandbox_8hskcmnn_tcmvbbfg3pvh5s7s"
                                @success="onSuccess"
                                @error="onError"
                            ></v-braintree>
                        </div>
                    </transition>
                </div>
                <div class="col-xl-6 my-5">
                    <Cart :slug="slug" />
                </div>
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
            dataChecked: false,
            slug: this.$route.params.slug,
        };
    },
    created() {
        if (
            this.orderInfo.cartStorage == undefined &&
            this.orderInfo.totalAmount == undefined
        ) {
            console.log(this.cartStorage);
            this.orderInfo.cartStorage = JSON.parse(
                localStorage.getItem("cart")
            );
            this.orderInfo.totalAmount = 0;
            this.orderInfo.cartStorage.forEach((el) => {
                this.orderInfo.totalAmount += el.quantity * el.price;
            });
        }
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
                    // setTimeout(() => {
                    //     }, 1200);

                    this.$router.push("checkout/paymentaccepted");

                    if (!res.data.success) {
                        alert(res.data.results);
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        },
        onError(error) {
            let message = error.message;
            console.log(message);
        },

        checkIfChecked() {
            if (
                this.orderInfo.name.trim().length > 0 &&
                this.orderInfo.surname.trim().length > 0 &&
                this.orderInfo.address.trim().length > 0 &&
                this.orderInfo.mail.trim().length > 0
            ) {
                this.dataChecked = true;
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import "./../../../node_modules/braintree-web-drop-in/dropin.css";

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

.fade-enter-active,
.fade-leave-active {
    transition: 1s all 1s;
    // transition-delay: 3s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
    transform: translateX(-100%);
}

.form-control {
    margin-bottom: 1em;
    background-color: white;
    &:focus {
        box-shadow: 0 0 0 0.25rem rgb(255 153 153 / 25%);
    }
}

.btn-primary {
    background-color: #ff9999;
    color: white;
    border: none;
    font-weight: bold;
    &:hover,
    &:active,
    &:focus {
        background-color: #00c7fa;
    }
}

.payment .btn.btn-primary {
    background-color: #ff9999 !important;
    color: white;
    border: none;
    font-weight: bold;
}
</style>
