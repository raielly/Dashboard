<template>
  <div>
    <aside id="sidebar" v-show="toggleSidebar.isExpanded">
      <div class="title-bar">Editor Chassis</div>
      <div class="user" @click="isOpen = !isOpen">
        <div class="user-img">
          <img src="../assets/icons/user-w.svg" alt="" width="30" />
        </div>
        <div class="user-info">
          <div class="user-name">
            {{ userStore.firstName }} {{ userStore.lastName }}
          </div>
          <span class="user-title">{{
            userStore.type == 0 ? "Writer" : "Editor"
          }}</span>
        </div>
        <img
          src="../assets/icons/caret-down.svg"
          alt="revision"
          width="30"
          class="caret-down"
          :class="{ rotate: isOpen }"
        />
        <div class="submenu" v-show="isOpen">
          <div>
            <span class="submenu-title">Chassis</span>
            <ul class="submenu-link">
              <li>
                <router-link to="#">
                  <img
                    src="../assets/icons/search.svg"
                    alt="pencil"
                    width="30"
                  />
                  <span> Research</span>
                </router-link>
              </li>
              <li>
                <router-link to="/writer">
                  <img
                    src="../assets/icons/pencil.svg"
                    alt="pencil"
                    width="30"
                  />
                  <span> Writer</span>
                </router-link>
              </li>
              <li>
                <router-link to="/editor">
                  <img
                    src="../assets/icons/editor.svg"
                    alt="pencil"
                    width="30"
                  />
                  <span> Editor</span>
                </router-link>
              </li>
            </ul>
          </div>
          <div>
            <span class="submenu-title">Other Option</span>
            <ul class="submenu-link">
              <li>
                <router-link to="#">Update Profile</router-link>
              </li>
              <li>
                <router-link to="#" @click.prevent="logout"
                  >Exit Chassis</router-link
                >
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="company">Walbro</div>
      <nav class="navigation">
        <ul>
          <li>
            <router-link to="/dashboard" class="nav-link">
              Dashboard
            </router-link>
          </li>
          <li>
            <router-link to="/media" class="nav-link">All Media</router-link>
          </li>
          <li>
            <router-link to="/account-setting" class="nav-link"
              >Account Settings</router-link
            >
          </li>
        </ul>
      </nav>
      <div class="copyright">
        <div>Salesforce Home</div>
        <span>v.4.4.0 | c 2021 Archintel Corp.</span>
      </div>
    </aside>
    <div
      class="overlay"
      v-show="toggleSidebar.isExpanded"
      @click="toggleSidebar.isExpanded = !toggleSidebar.isExpanded"
    ></div>
  </div>
</template>

<script>
import useToggleSidebarStore from "@/stores/useToggleSidebar";
export default {
  name: "AppSidebar",
  props: ["userStore"],
  data() {
    return {
      isOpen: false,
      toggleSidebar: useToggleSidebarStore(),
    };
  },
  watch: {
    $route() {
      // close the mobile menu on page change
      if (window.innerWidth < 992) {
        this.toggleSidebar.isExpanded = false;
      } else {
        this.toggleSidebar.isExpanded = true;
      }
    },
  },
  methods: {
    handleResize() {
      if (window.innerWidth < 992) {
        this.toggleSidebar.isExpanded = false;
      } else {
        this.toggleSidebar.isExpanded = true;
      }
    },

    logout() {
      localStorage.clear();
      this.$router.push({ name: "Login" });
    },
  },
  mounted() {
    this.handleResize();
    window.addEventListener("resize", this.handleResize);
  },
  destroyed() {
    window.removeEventListener("resize", this.handleResize);
  },
};
</script>

<style scoped>
.title-bar {
  padding: 1.5rem;
  border-bottom: 1px solid var(--tertiaryColor);
  border-right: 1px solid var(--tertiaryColor);
  color: white;
  font-size: 1.8rem;
  font-weight: 500;
}
.user {
  border-bottom: 1px solid var(--tertiaryColor);
  display: flex;
  gap: 2rem;
  padding: 1.5rem;
  color: #fff;
  position: relative;
  user-select: none;
  cursor: pointer;
}
.user:hover {
  background-color: #027465;
}
.user-img {
  width: 4.5rem;
  height: 4.5rem;
  border-radius: 50%;
  background: #5581b6;
  display: grid;
  place-content: center;
}
.user-name {
  font-weight: 600;
}
.user-title {
  font-weight: 300;
  font-size: 1.4rem;
}
.company {
  border-bottom: 1px solid var(--tertiaryColor);
  padding: 1.5rem;
  font-size: 2rem;
  font-weight: 800;
  text-align: center;
  color: #fff;
}
.navigation {
  background-color: var(--secondaryColor);
  padding: 1rem;
  height: calc(100% - 260px);
}
.navigation ul li a {
  display: block;
  color: #fff;
  padding: 1.5rem 1rem;
  border-radius: 0.4rem;
  font-weight: 600;
}
.navigation ul li a:hover {
  background-color: var(--tertiaryColor);
}
.copyright {
  padding: 1.5rem;
  color: #fff;
}
.copyright span {
  font-size: 1.2rem;
}
.caret-down {
  position: absolute;
  right: 0;
  top: 0;
  margin-top: 1rem;
  margin-right: 2rem;
}
.caret-down.rotate {
  transform: rotate(180deg);
}
.submenu {
  position: absolute;
  left: 0;
  top: 0;
  margin-top: 8rem;
  width: 300px;
  border-radius: 0.4rem;
  box-shadow: var(--boxShadow);
  background-color: #fff;
  padding: 1.5rem 0;
}
.submenu div:first-child {
  margin-bottom: 1rem;
}
.submenu-title {
  color: #b2b2b2;
  font-size: 1.3rem;
  font-weight: 500;
  padding: 1rem;
  display: block;
}

.submenu-link li a {
  display: flex;
  align-items: center;
  gap: 2rem;
  padding: 1.5rem;
  color: #222;
  font-weight: 600;
  font-size: 1.5rem;
}
.submenu-link li a:hover {
  background-color: #eee;
}
.submenu div:last-child .submenu-link li:last-child a {
  color: red;
}
.overlay {
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 9;
  background-color: rgba(0, 0, 0, 0.7);
}

@media (min-width: 62em) {
  /* 992px */
  .overlay {
    display: none;
  }
}
</style>
