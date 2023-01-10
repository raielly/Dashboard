import { createRouter, createWebHistory } from "vue-router";
import DefaultLayout from "@/layouts/DefaultLayout.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    component: DefaultLayout,
    redirect: "/dashboard",
    children: [
      {
        path: "/dashboard",
        name: "Dashboard",
        component: () => import("@/views/Dashboard.vue"),
      },
      {
        path: "/writer",
        name: "Writer",
        component: () => import("@/views/Writer.vue"),
      },
      {
        path: "/editor",
        name: "Editor",
        component: () => import("@/views/Editor.vue"),
      },
      {
        path: "/company",
        name: "Company",
        component: () => import("@/views/Company.vue"),
      },
      {
        path: "/create-article",
        name: "CreateArticle",
        component: () => import("@/views/CreateArticle.vue"),
      },
      {
        path: "/media",
        name: "Media",
        component: () => import("@/views/Media.vue"),
      },
      {
        path: "/account-setting",
        name: "AccountSetting",
        component: () => import("@/views/AccountSetting.vue"),
      },
      {
        path: "/article/:id",
        name: "Article",
        component: () => import("@/views/Article.vue"),
      },
    ],
  },
  {
    path: "/login",
    name: "Login",
    component: () => import("@/views/Login.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes,
  linkExactActiveClass: "active",
});

router.beforeEach((to, from, next) => {
  window.document.title = "Archintel";
  next();
});

export default router;
