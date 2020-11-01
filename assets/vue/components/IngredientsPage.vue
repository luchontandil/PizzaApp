<template>
  <v-row>
    <v-col>
      <h2>Ingredients</h2>
      <p>Add ingredients here</p>
      <v-form v-model="valid">
        <v-container>
          <v-row>
            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                v-model="name"
                :counter="15"
                label="Ingredient name"
                required
              ></v-text-field>
            </v-col>

            <v-col
              cols="12"
              md="4"
            >
              <v-text-field
                v-model="price"
                label="Price"
                required
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              md="4"
            >
              <v-btn
                text-right
                elevation="2"
                @click="addIngredient"
              >Add</v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-form>
    </v-col>
    <v-col>
      <v-card
        class="mx-auto"
        max-width="400"
        tile
      >
        <v-list-item two-line v-for="ingredient in ingredientList">
          <v-list-item-content>
            <v-list-item-title>{{ ingredient.name }}</v-list-item-title>
            <v-list-item-subtitle>price {{ ingredient.price }}</v-list-item-subtitle>
          </v-list-item-content>
          <v-btn
            text-right
            elevation="2"
            @click="deleteIngredient(ingredient._id.$oid)"
          >Delete</v-btn>
        </v-list-item>
      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import axios from 'axios'

  export default {
    data: () => ({
      valid: false,
      name: '',
      price: '',
      ingredient: '',
      ingredientList: [],
    }),
    methods: {
      addIngredient(){
        axios.post('/api/addIngredient', {name: this.name, price: this.price})
          .then(res => {
            this.reloadList()
            this.name = '';
            this.price = '';
          })
          .catch(err => {// catch error
          });
      },

      deleteIngredient(id){
        axios.post('/api/deleteIngredient', {id: id})
          .then(res => {
            this.reloadList()
          })
          .catch(err => {// catch error
          });
      },

      reloadList(){
        axios
      .get('/api/getIngredients')
      .then(response => (
        this.$set(this, 'ingredientList', response.data.reverse())
       ))
      }
    },
    mounted () {
      this.reloadList();
   }
  }
</script>
