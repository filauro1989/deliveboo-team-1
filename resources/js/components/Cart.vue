<template>
    <div>
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row d-block">
                            <div class="col mb-4">
                                <div
                                    class="d-flex justify-content-between align-items-center mb-4"
                                >
                                    <div>
                                        <p class="mb-1">Carrello</p>
                                        <p v-if="cartStorage" class="mb-0">
                                            Hai
                                            {{
                                                cartStorage.length == 0
                                                    ? "0"
                                                    : cartStorage.length
                                            }}
                                            elementi nel carrello
                                        </p>
                                    </div>
                                </div>

                                <div
                                    v-for="(cartElement, index) in cartStorage"
                                    :key="index"
                                    class="card mb-3"
                                >
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <h5></h5>
                                                    <p class="small mb-0">
                                                        {{
                                                            cartElement.productName
                                                        }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="px-2 me-3">
                                                    <!-- <h5 class="fw-normal mb-0">
                                                        {{
                                                            cartElement.quantity
                                                        }}
                                                    </h5> -->
                                                    <div
                                                        class="d-flex"
                                                        style="max-width: 300px"
                                                    >
                                                        <button
                                                            class="btn btn-primary px-3 me-2"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                            @click="
                                                                modifyQuantity(
                                                                    cartElement,
                                                                    -1
                                                                ),
                                                                    getTotalCart()
                                                            "
                                                        >
                                                            <i
                                                                class="fas fa-minus"
                                                            ></i>
                                                        </button>

                                                        <div
                                                            class="form-outline"
                                                        >
                                                            <input
                                                                id="form1"
                                                                min="0"
                                                                name="quantity"
                                                                :value="
                                                                    parseInt(
                                                                        cartElement.quantity
                                                                    )
                                                                "
                                                                type="number"
                                                                class="form-control quantity-input"
                                                            />
                                                        </div>

                                                        <button
                                                            @click="
                                                                modifyQuantity(
                                                                    cartElement,
                                                                    1
                                                                ),
                                                                    getTotalCart()
                                                            "
                                                            class="btn btn-primary px-3 ms-2"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                        >
                                                            <i
                                                                class="fas fa-plus"
                                                            ></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="me-3">
                                                    <h5 class="mb-0">
                                                        {{
                                                            (
                                                                cartElement.price *
                                                                cartElement.quantity
                                                            ).toFixed(2)
                                                        }}
                                                        &euro;
                                                    </h5>
                                                </div>
                                                <a
                                                    @click="
                                                        deleteItem(cartElement)
                                                    "
                                                    href="#!"
                                                    style="color: #cecece"
                                                    ><i
                                                        class="fas fa-trash-alt"
                                                    ></i
                                                ></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fw-bold total-amount">
                                Totale Carrello:
                                {{ totalAmount.toFixed(2) }} &euro;
                            </div>
                            <div>
                                <button
                                    v-if="cartStorage != 0"
                                    class="btn btn-outline-danger"
                                    type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#deleteConfirmation"
                                >
                                    Svuota Carrello
                                </button>

                                <!-- CART MODAL -->
                                <div
                                    class="modal fade"
                                    id="deleteConfirmation"
                                    data-bs-backdrop="static"
                                    tabindex="-1"
                                    aria-labelledby="deletePopup"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5
                                                    class="modal-title"
                                                    id="deletePopup"
                                                >
                                                    Attenzione
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"
                                                ></button>
                                            </div>
                                            <div class="modal-body">
                                                Sei sicuro di voler svuotare il
                                                carrello?
                                            </div>
                                            <div class="modal-footer">
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal"
                                                >
                                                    Annulla
                                                </button>
                                                <form>
                                                    <input
                                                        class="btn btn-danger"
                                                        type="submit"
                                                        value="Elimina"
                                                        @click="refresh()"
                                                    />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <router-link
                                    :to="{
                                        name: 'checkout',
                                        params: {
                                            totalAmount: totalAmount,
                                            cartStorage: cartStorage,
                                        },
                                    }"
                                >
                                    <!-- @click="setTotalAmount()" -->
                                    <button
                                        v-if="
                                            currentRoute != 'checkout' &&
                                            cartStorage.length > 0
                                        "
                                        class="btn btn-success"
                                    >
                                        Checkout
                                    </button>
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Cart",
    data() {
        return {
            cart: [],
            cartStorage: [],
            totalAmount: 0,
            currentRoute: this.$route.name,
        };
    },

    props: {
        elementfromCart: Object,
        slug: String,
    },
    methods: {
        refresh() {
            localStorage.clear();
            this.cartStorage = [];
            this.getTotalCart();
            localStorage.setItem("restaurantSlug", JSON.stringify(this.slug));
        },
        deleteItem(dish) {
            // CREO UN ARRAY DI APPOGGIO
            let parsedCart = [];
            // TRASFORMO LA STRINGA IN JSON E LA PUSHO NELL'ARRAY DI APPOGGIO
            parsedCart = JSON.parse(localStorage.getItem("cart"));
            // CICLO SULL'ARRAY cartStorage
            for (let index = 0; index < this.cartStorage.length; index++) {
                const element = this.cartStorage[index];
                // SE IL NOME DEL PIATTO è UGUALE AL NOME DELL'ELEMENTO SU CUI CICLO
                if (dish.productName == element.productName) {
                    // INDEX STA PER LA POSIZIONE NELL'ARRAY cartStorage DELL'Element
                    // ELIMINO UN OGGETTO DALL'ARRAY cartStorage
                    this.cartStorage.splice(index, 1);
                    // ELIMINO UN OGGETTO DALL'ARRAY parsedCart
                    parsedCart.splice(index, 1);
                }
            }
            // TRASFORMO L'ARRAY IN STRINGA PUSHO L'ARRAY DI APPOGGIO NEL localStorage
            localStorage.setItem("cart", JSON.stringify(parsedCart));
            this.getTotalCart();
        },
        modifyQuantity(dish, num) {
            // CREO UN ARRAY DI APPOGGIO
            let parsedCart = [];
            // TRASFORMO LA STRINGA IN JSON E LA PUSHO NELL'ARRAY DI APPOGGIO
            parsedCart = JSON.parse(localStorage.getItem("cart"));
            // CICLO SULL'ARRAY cartStorage
            for (let index = 0; index < this.cartStorage.length; index++) {
                const element = this.cartStorage[index];
                // SE IL NOME DEL PIATTO è UGUALE AL NOME DELL'ELEMENTO SU CUI CICLO
                if (
                    dish.productName == element.productName &&
                    element.quantity + num > 0
                ) {
                    // VARIO LA QUANTITà DELL'ELEMENTO DI += num
                    element.quantity += num;
                    // VARIO LA QUANTITà DELL'ARRAY DI APPOGGIO DI += num
                    parsedCart[index].quantity += num;
                }
            }
            // TRASFORMO L'ARRAY IN STRINGA PUSHO L'ARRAY DI APPOGGIO NEL localStorage
            localStorage.setItem("cart", JSON.stringify(parsedCart));
        },
        getTotalCart() {
            // RESETTO IL totalAmount
            this.totalAmount = 0;
            // console.log("test");
            // PER OGNI ELEMENTO DEL cartStorage AGGIUNGO AL totalAmount la quantità dell'elemento + il prezzo
            this.cartStorage.forEach((el) => {
                this.totalAmount += el.quantity * el.price;
            });
        },
        // setTotalAmount() {
        //     this.$emit("sendTotalAmount", this.totalAmount);
        // },
    },

    created() {
        // this.cartStorage = [];
        setTimeout(() => {
            // mi salvo lo slug del ristorante in una variabile del localstorage
            localStorage.setItem("restaurantSlug", JSON.stringify(this.slug));

            if (JSON.parse(localStorage.getItem("cart"))) {
                this.cartStorage = JSON.parse(localStorage.getItem("cart"));
                this.getTotalCart();
            }
        }, 100);
    },

    watch: {
        elementfromCart: function () {
            let found = false;

            // console.log(localStorage.key());

            // SE 'ARRAY esiste
            if (this.cartStorage) {
                // CICLO SULLA LUNGHEZZA DELL'ARRAY cartStorage
                for (let index = 0; index < this.cartStorage.length; index++) {
                    const element = this.cartStorage[index];
                    if (
                        // SE IL NOME DEL PRODOTTO CHE SELEZIONO è UGUALE AL NOME DI UN PRODOTTO GIà PRESENTE NEL CARRELLO
                        element.productName == this.elementfromCart.productName
                    ) {
                        // AUMENTO LA QUANTITà DEL PRODOTTO NEL CARRELLO, FERMO IL CICLO SETTANDO INDEX ALLA LUNGHEZZA DELL'ARRAY E CAMBIO VARIABILE IN TRUE
                        element.quantity += parseInt(
                            this.elementfromCart.quantity
                        );
                        index = this.cartStorage.length;
                        found = true;
                        localStorage.setItem(
                            "cart",
                            JSON.stringify(this.cartStorage)
                        );
                    }
                }
                // SE VARIABILE FOUND è FALSE ALLORA PUSHO L'ELEMENTO SELEZIONATO E LO PUSHO ANCHE NEL localStorage
                if (found == false) {
                    this.cartStorage.push(this.elementfromCart);
                    localStorage.setItem(
                        "cart",
                        JSON.stringify(this.cartStorage)
                    );
                }
                // PUSHO L'ELEMENTO NEL CARRELLO
            } else {
                this.cartStorage.push(this.elementfromCart);
            }

            this.getTotalCart();
        },
    },
};
</script>

<style lang="scss" scoped>
* {
    font-size: 0.9rem;
}
@import "bootstrap";

.quantity-input {
    width: 50px;
}

.form-check {
    padding-left: 0;
}

// .btn:active,
// .btn:hover,
// .btn:focus {
//     // background-color: #ff9999 !important;
//     box-shadow: 0 0 5px black;
// }

.btn-primary {
    @include button-variant(
        #ff9999,
        white,
        white,
        #00c7fa,
        white,
        white,
        #ff9999,
        white,
        white
    );
}
.btn-success {
    @include button-variant(
        #00c7fa,
        white,
        white,
        #ff9999,
        white,
        white,
        #00c7fa,
        white,
        white
    );
}
</style>
