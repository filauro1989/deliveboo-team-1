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
                <form @submit.prevent>
                    <p>
                        Inserisci tutti i tuoi dati per procedere al pagamento:
                    </p>
                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input
                            min="3"
                            max="50"
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
                            v-model="orderInfo.mail"
                            type="email"
                            class="form-control"
                            id="email"
                            placeholder="Inserisci il tuo indirizzo e-mail"
                        />
                    </div>

                    <!-- @click="checkIfChecked()" -->
                    <button type="submit" class="btn btn-primary mt-2">
                        Conferma
                    </button>
                </form>
                <transition name="fade">
                    <!-- v-if="
                            dataChecked &&
                            orderInfo.name.trim().length > 0 &&
                            orderInfo.surname.trim().length > 0 &&
                            orderInfo.address.trim().length > 0 &&
                            orderInfo.mail.trim().length > 0
                        " -->
                    <div>
                        <v-braintree
                            authorization="sandbox_8hskcmnn_tcmvbbfg3pvh5s7s"
                            @success="onSuccess"
                            @error="onError"
                        ></v-braintree>
                    </div>
                </transition>
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
            dataChecked: false,
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
</style>
