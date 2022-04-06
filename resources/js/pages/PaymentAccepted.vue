<template>
    <div class="container d-flex justify-content-center align-items-center">
        <div>PAGAMENTO AVVENUTO CON SUCCESSO</div>
    </div>
</template>

<script>
export default {
    name: "PaymentAccepted",
    created() {
        setTimeout(() => {
            this.$router.push("/");
        }, 5000);
    },
};
</script>

<style></style>
