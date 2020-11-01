<template>
  <v-app>
    <v-navigation-drawer
      app
      clipped
    >
      <v-list
        dense
        nav
      >
        <v-list-item to="/">
          <v-list-item-avatar>
            <v-icon>{{ icons.pizza }}</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>Make a new Pizza</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/presets">
          <v-list-item-avatar>
            <v-icon>{{ icons.about }}</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>View Presets</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-list-item to="/ingredients">
          <v-list-item-avatar>
            <v-icon>{{ icons.edit }}</v-icon>
          </v-list-item-avatar>
          <v-list-item-content>
            <v-list-item-title>Edit Ingredients</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar
      app
      clipped-left
    >
      <v-toolbar-title>Pizza App</v-toolbar-title>
    </v-app-bar>
    <v-content>
      <v-container fluid>
        <router-view></router-view>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
  import { mdiPizza, mdiInformation, mdiPencil } from '@mdi/js'
  export default {
    name: 'App',
    data: () => ({
      icons: {
        about: mdiInformation,
        pizza: mdiPizza,
        edit: mdiPencil
      }
    })
  }
</script>

<style>

</style>
