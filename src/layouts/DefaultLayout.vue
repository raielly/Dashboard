<template>
  <div id="main-wrapper">
    <AppSidebar :user-store="userStore" />
    <main
      id="main-content"
      :class="[toggleSidebar.isExpanded ? 'spaceLeft' : '']"
    >
      <AppHeader />
      <div class="main-inner">
        <router-view></router-view>
      </div>
    </main>
  </div>
</template>

<script>
import useToggleSidebarStore from "@/stores/useToggleSidebar";
import { useUserStore } from "@/stores/useUser";
import { computed } from "@vue/runtime-core";
import AppSidebar from "@/components/AppSidebar.vue";
import AppHeader from "@/components/AppHeader.vue";
export default {
  name: "DefaultLayout",
  components: {
    AppSidebar,
    AppHeader,
  },
  data() {
    return {
      toggleSidebar: useToggleSidebarStore(),
      userStore: computed(() => useUserStore().getUserInfo),
    };
  },
  created() {
    this.userStore;
  },
  methods: {
    handleResize() {
      if (window.innerWidth < 992) {
        this.toggleSidebar.isExpanded = false;
      } else {
        this.toggleSidebar.isExpanded = true;
      }
    },
  },
  mounted() {
    console.log(this.userStore);
    this.handleResize();
    window.addEventListener("resize", this.handleResize);
  },
  destroyed() {
    window.removeEventListener("resize", this.handleResize);
  },
};
</script>

<style scoped>
@media (min-width: 62em) {
  /* 992px */
  .spaceLeft {
    margin-left: 30rem;
    width: calc(100% - 30rem);
  }
}
</style>
