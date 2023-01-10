import { defineStore } from "pinia";

export const useUserStore = defineStore("users", {
  state: () => {
    return {
      users: [],
    };
  },
  getters: {
    getUserInfo() {
      let userInfo = localStorage.getItem("userInfo");
      this.users = JSON.parse(userInfo);
      return this.users;
    },
  },
});
