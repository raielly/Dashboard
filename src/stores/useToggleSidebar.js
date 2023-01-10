import { defineStore } from "pinia";

export default defineStore("toggleSidebar", {
  state: () => ({
    isExpanded: true,
  }),
});
