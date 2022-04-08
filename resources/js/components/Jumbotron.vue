<template>
    <div class="jumbotron jumbotron-fluid py-4">
        <div class="container">
            <div
                id="jumbotron-carousel"
                class="carousel slide"
                data-bs-ride="carousel"
            >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img
                            :src="
                                require(`../../../public/storage/uploads/deliveboo-jumbotron-img.jpg`)
                            "
                            class="d-block w-100"
                            alt="..."
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Jumbotron",
};
</script>

<style lang="scss" scoped>
.jumbotron {
    background-color: #ff9999;
    .carousel {
        overflow: hidden;
        max-height: 400px;
        border-radius: 20px;
        box-shadow: 0 0 10px 1px #7f282f;
        img {
            object-fit: cover;
            object-position: center;
        }
    }
}
</style>
