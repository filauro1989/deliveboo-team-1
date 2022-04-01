<template>
  <div class="card" style="width: 18rem;">
      <h1>{{singleRestaurant.restaurant_name}}</h1>
    <div class="card-header">
        Menù
    </div>
    <ul v-for="(dish, index) in menu" :key="index" class="list-group list-group-flush">
        <li v-if="dish.img" class="list-group-item">{{dish.img}}</li>
        <li class="list-group-item">{{dish.dishName}}</li>
        <li class="list-group-item">{{dish.description}}</li>
        <li class="list-group-item">{{dish.price}}€</li>
        
    </ul>
</div>

</template>

<script>
export default {
    name: "Restaurant",
    data() {
        return {
            apiKey: "deliveboo26313334",
            menu: [],
        }
    },
    props: {
        singleRestaurant: Object,
    },
    created() {
        axios.get("http://127.0.0.1:8000/api/restaurants/restaurantfilter", {
                    headers: {
                        // UTILIZZIAMO UN BEARER TOKEN INVIANDOLO COME STRINGA E CI AGGIUNGIAMO LA CHIAVE API
                        Authorization: "Bearer " + this.apiKey,
                    },
                    params: { id: this.singleRestaurant.id },
                })
                .then((res) => {
                    let response = res.data.result;
                    response.forEach(dishResponse => {

                        this.menu.push( {
                            img: dishResponse.image,
                            dishName: dishResponse.name,
                            price: dishResponse.price,
                            description: dishResponse.description
                        });
                    });
                    console.log(this.menu);
                   
                })
                .catch((err) => {
                    console.log(err);
                });
    }
}   
</script>

<style>

</style>