import Vue from 'vue'
import Router from 'vue-router'
import TheHomePage from './components/TheHomePage'

Vue.use(Router)

const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  routes: [
    {
      path: '/',
      name: 'home',
      component: TheHomePage
    },
    {
      path: '/presets',
      name: 'presets',
      component: () => import(/* webpackChunkName: "presets" */ './components/PresetsPage'),
    },
    {
      path: '/Ingredients',
      name: 'ingredients',
      component: () => import(/* webpackChunkName: "ingredients" */ './components/IngredientsPage'),
    },
  ]
})

export default router
