<template>
    <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#FF9999" fill-opacity="1" d="M0,96L120,112C240,128,480,160,720,154.7C960,149,1200,107,1320,85.3L1440,64L1440,0L1320,0C1200,0,960,0,720,0C480,0,240,0,120,0L0,0Z"></path>
        </svg>
        <div class="container d-flex justify-content-center align-items-center">
            <div>PAGAMENTO AVVENUTO CON SUCCESSO</div>
        </div>
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
