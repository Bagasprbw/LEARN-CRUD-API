import { createRouter, createWebHistory } from "vue-router";
import ProductList from "../views/ProductList.vue";
import ProductForm from "../views/ProductForm.vue";

const routes = [
  { path: "/", name: "ProductList", component: ProductList },
  { path: "/add", name: "AddProduct", component: ProductForm },
  { path: "/edit/:id", name: "EditProduct", component: ProductForm },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
