import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter);
const routes = [
  {
    name: "index",
    path: '/',
    component: require('@/components/Example.vue')
  },
];

export default new VueRouter({routes})