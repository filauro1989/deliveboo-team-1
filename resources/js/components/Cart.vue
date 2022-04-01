<template>
<div>
    <button class="btn btn-primary" @click="show()">show</button>
    <button class="btn btn-primary" @click="refresh()">refresh</button>
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
    }
};
</script>

<style></style>
