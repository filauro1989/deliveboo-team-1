<template>
    <div class="jumbotron jumbotron-fluid my-4">
        <div class="container">
            <div
                id="jumbotron-carousel"
                class="carousel slide"
                data-bs-ride="carousel"
            >
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://www.foodaffairs.it/wp-content/uploads/2021/07/pizza-delivery-cartone-amici-televisione-tv.jpg" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="https://i0.wp.com/www.alphr.com/wp-content/uploads/2016/11/uber_of_food_sharing_culture-scaled.jpg?fit=2560%2C1440&ssl=1" class="d-block w-100" alt="..." />
                    </div>
                    <div class="carousel-item">
                        <img src="https://ychef.files.bbci.co.uk/976x549/p065jzb2.jpg" class="d-block w-100" alt="..." />
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
        .carousel {
            overflow: hidden;
            max-height: 400px;
            border-radius: 20px;
            img {
                object-fit: cover;
                object-position: center;
                border-radius: 20px;
            }
        }
    }
</style>
