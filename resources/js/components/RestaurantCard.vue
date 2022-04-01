<template>
    <!-- <div class="col-sm-12 col-md-6 col-lg-3 p-0"> -->
    <a class="text-white text-center card m-2" href="#">
        <img
            v-if="restaurantImg"
            class="card-img h-100 w-100"
            :src="require(`../../../public/storage/${restaurantImg}`)"
            :alt="restaurantName"
        />
        <img
            v-else
            :src="
                require(`../../../public/storage/default_images/default-placeholder.png`)
            "
            alt="default-image"
        />
        <div class="card-img-overlay h-100 posision-relative">
            <h5
                class="card-title position-absolute top-50 start-50 translate-middle"
            >
                {{ restaurantName }}
            </h5>
        </div>
    </a>
    <!-- </div> -->
</template>

<script>
export default {
    name: "RestaurantCard",
    props: {
        restaurantName: {
            type: String,
        },
        restaurantImg: {
            type: String,
        },
    },
};
</script>

<style lang="scss" scoped>
// RESTAURANT CARD
.card {
    height: 150px;
    min-width: 250px;
    max-width: 350px;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: 0 0 12px 0 rgba(0, 0, 0, 0.2);
    &:hover,
    &:focus,
    &:active {
        .card-img {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }
        .card-img-overlay {
            background: none;
        }
    }
    .card-img {
        object-fit: cover;
    }
    .card-img-overlay {
        background: linear-gradient(
            0deg,
            rgba(0, 0, 0, 0.2) 0%,
            rgba(0, 0, 0, 0.3) 100%
        );
    }
    .card-title {
        font-weight: bold;
        font-size: 1.5em;
    }
}
</style>
