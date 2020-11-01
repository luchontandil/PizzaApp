<template>
  <div>
  <v-row>
    <v-col>
      <div>
        <h1>Make your own pizza</h1>
        <p>Add as many ingredients as you like</p>
      </div>
    </v-col>
  </v-row>
  <v-row>
    <v-col>
      <v-text-field
        label="Name for your Pizza"
        v-model="pizzaName"
      ></v-text-field>
    </v-col>
  </v-row>
  <v-row>
    <v-col>
      <v-card
        class="mx-auto"
        max-width="400"
        tile
      >
        <v-list-item two-line v-for="i in ingredients">
          <v-list-item-content>
            <v-list-item-title>{{ i.name }}</v-list-item-title>
            <v-list-item-subtitle>price {{ i.price }}</v-list-item-subtitle>
          </v-list-item-content>
          <v-btn
            text-right
            elevation="2"
            @click="removeIngredient(i._id.$oid)"
          >Remove</v-btn>
        </v-list-item>
      </v-card>
    </v-col>
    <v-divider
      vertical
    ></v-divider>
    <v-col>
      <v-card
        class="mx-auto"
        max-width="400"
        tile
      >
        <v-list-item two-line v-for="ingredient in ingredientList">
          <v-col>
            <v-btn
              id="add-btn"
              elevation="2"
              @click="addIngredient(ingredient._id.$oid)"
            >Add</v-btn>
          </v-col>
          <v-list-item-content>
            <v-list-item-title>{{ ingredient.name }}</v-list-item-title>
            <v-list-item-subtitle>price {{ ingredient.price }}</v-list-item-subtitle>
          </v-list-item-content>
        </v-list-item>
      </v-card>
    </v-col>
  </v-row>
  <v-row>
    <v-divider
      horizontal
    ></v-divider>
  </v-row>
  <v-row>
    <v-col>
      <p>Total Price: {{ price }} €</p>
    </v-col>
      <v-col>
        <v-btn
              text-right
              elevation="2"
              @click="createPizza()"
            >Done</v-btn>
        </v-col>
    <v-col></v-col>
  </v-row>
  
</div>
</template>

<script>
import axios from 'axios'

  export default {
    data: () => ({
      valid: false,
      pizzaName: '',
      ingredients: [],
      ingredientList: [],
    }),
    methods: {
      addIngredient(id){
        //remove from ingredientList and add it to the pizza toppings(ingredients)
        this.ingredients.push(this.ingredientList.filter(item => item._id.$oid === id)[0])
        this.ingredientList = this.ingredientList.filter(item => item._id.$oid != id)
      },
      removeIngredient(id){
        this.ingredientList.push(this.ingredients.filter(item => item._id.$oid === id)[0])
        this.ingredients = this.ingredients.filter(item => item._id.$oid != id)
      },

      createPizza(){
        axios.post('/api/newPizza', {name: this.pizzaName, price: this.price , ingredients: this.ingredients})
          .then(res => {
            this.reloadList();
            this.pizzaName = '';
            this.ingredients = [];
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
    computed: {
      price: function() { 
       return this.ingredients.reduce(((accumulator, currentValue) => accumulator + currentValue.price),0)*1.5;
      }
    },

    mounted () {
      this.reloadList();
   }
  }
</script>
