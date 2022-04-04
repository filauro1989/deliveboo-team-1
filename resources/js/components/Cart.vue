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
                                        <p class="mb-1">Shopping cart</p>
                                        <p class="mb-0">
                                            You have 4 items in your cart
                                        </p>
                                    </div>
                                    <div>
                                        <p class="mb-0">
                                            <span class="text-muted"
                                                >Sort by:</span
                                            >
                                            <a href="#!" class="text-body"
                                                >price
                                                <i
                                                    class="fas fa-angle-down mt-1"
                                                ></i
                                            ></a>
                                        </p>
                                    </div>
                                </div>

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <h5>Iphone 11 pro</h5>
                                                    <p class="small mb-0">
                                                        256GB, Navy Blue
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="px-2 me-3">
                                                    <h5 class="fw-normal mb-0">
                                                        2
                                                    </h5>
                                                </div>
                                                <div class="me-3">
                                                    <h5 class="mb-0">$900</h5>
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

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <h5>
                                                        Samsung galaxy Note 10
                                                    </h5>
                                                    <p class="small mb-0">
                                                        256GB, Navy Blue
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div style="width: 50px">
                                                    <h5 class="fw-normal mb-0">
                                                        2
                                                    </h5>
                                                </div>
                                                <div style="width: 80px">
                                                    <h5 class="mb-0">$900</h5>
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

                                <div class="card mb-3">
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <h5>Canon EOS M50</h5>
                                                    <p class="small mb-0">
                                                        Onyx Black
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div style="width: 50px">
                                                    <h5 class="fw-normal mb-0">
                                                        1
                                                    </h5>
                                                </div>
                                                <div style="width: 80px">
                                                    <h5 class="mb-0">$1199</h5>
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

                                <div class="card mb-3 mb-lg-0">
                                    <div class="card-body">
                                        <div
                                            class="d-flex justify-content-between"
                                        >
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div class="ms-3">
                                                    <h5>MacBook Pro</h5>
                                                    <p class="small mb-0">
                                                        1TB, Graphite
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex flex-row align-items-center"
                                            >
                                                <div style="width: 50px">
                                                    <h5 class="fw-normal mb-0">
                                                        1
                                                    </h5>
                                                </div>
                                                <div style="width: 80px">
                                                    <h5 class="mb-0">$1799</h5>
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
                                <button class="btn btn-danger" @click="show()">
                                    show
                                </button>
                                <button
                                    class="btn btn-danger"
                                    @click="refresh()"
                                >
                                    refresh
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
    props: {
        cart: Array,
    },
    methods: {
        refresh() {
            localStorage.clear();
        },
        show() {
            console.log(JSON.parse(localStorage.getItem("cart")));
        },
    },
};
</script>

<style lang="scss" scoped>
* {
    font-size: 0.9rem;
}
</style>
