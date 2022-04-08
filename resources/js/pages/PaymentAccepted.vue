<template>
    <div>
        <svg id="visual" viewBox="0 0 900 100" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><rect x="0" y="0" width="900" height="100" fill="#FFECEC"></rect><path d="M0 24L37.5 30.3C75 36.7 150 49.3 225 56C300 62.7 375 63.3 450 59.7C525 56 600 48 675 43.2C750 38.3 825 36.7 862.5 35.8L900 35L900 0L862.5 0C825 0 750 0 675 0C600 0 525 0 450 0C375 0 300 0 225 0C150 0 75 0 37.5 0L0 0Z" fill="#FF9999" stroke-linecap="round" stroke-linejoin="miter"></path></svg>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <i class="bollino-maledetto fa-solid fa-check"></i>
                </div>
            </div>
            <div class="col">
                <h1>Ordine Inserito con Successo!</h1>
            </div>
            <div class="col">
                A breve riceverai una mail con i dettagli del tuo ordine
            </div>
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

<style lang="scss" scoped>
    .bollino-maledetto {
        display: inline-block;
        padding: 1em;
        border-radius: 50%;
        font-size: 2em;
        background-color: #ff9999;
        color: white;
    }
</style>
