<template>
    <div class="container-fluid">
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
                                                    <h5 class="fw-normal mb-0">
                                                        {{
                                                            cartElement.quantity
                                                        }}
                                                    </h5>
                                                </div>
                                                <div class="me-3">
                                                    <h5 class="mb-0">
                                                        {{
                                                            cartElement.price *
                                                            cartElement.quantity
                                                        }}
                                                    </h5>
                                                </div>
                                                <a
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
                            <div>
                                <button
                                    class="btn btn-danger"
                                    @click="refresh()"
                                >
                                    Svuota Carrello
                                </button>
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
            // found: false,
        };
    },

    props: {
        elementfromCart: Object,
    },
    methods: {
        refresh() {
            localStorage.clear();
            this.cartStorage = [];
        },
    },
    created() {
        // this.cartStorage = [];
        setTimeout(() => {
            if (JSON.parse(localStorage.getItem("cart"))) {
                this.cartStorage = JSON.parse(localStorage.getItem("cart"));
            }
        }, 100);
    },
    watch: {
        elementfromCart: function () {
            let found = false;

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
                        element.quantity += this.elementfromCart.quantity;
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
        },
    },
};
</script>

<style lang="scss" scoped>
* {
    font-size: 0.9rem;
}
</style>
