<template>
  <header>
    <div class="left">
      <img
        src="../assets/icons/hamburger.svg"
        alt="hamburger menu"
        width="30"
        @click.prevent="toggleSidebar"
        style="cursor: pointer"
      />
      <input type="text" placeholder="Search" class="form-control top-search" />
    </div>
    <ul class="right">
      <li id="monitor">
        <img src="../assets/icons/monitor.svg" alt="revision" width="20" />
        <div class="dash-monitor">Manager Dashboard</div>
      </li>
      <li id="bell">
        <img
          src="../assets/icons/bell.svg"
          alt="bell"
          width="20"
          class="noti-icon"
        />
        <div class="notification">
          <div class="head">Notification</div>
          <div class="content">
            <div class="inner-content">
              <img src="../assets/icons/comment.svg" alt="" />
              <div class="text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet,
                suscipit porro.
                <div class="date">a month ago.</div>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="inner-content">
              <img src="../assets/icons/file-edit.svg" alt="" />
              <div class="text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet,
                suscipit porro.
                <div class="date">a month ago.</div>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li id="settings">
        <img src="../assets/icons/setting.svg" alt="revision" width="20" />
        <div class="inner-settings">
          <div class="head">Settings</div>
          <div class="content">
            <small style="color: #888">General</small>
            <div class="inner-content">
              <div class="check-box">
                <input type="checkbox" />
              </div>
              <div class="text">
                <strong>Push Notification</strong>
                <div class="">Enable/disable web push notification</div>
              </div>
            </div>
          </div>
          <div class="content">
            <div class="inner-content">
              <div class="check-box">
                <input type="checkbox" checked />
              </div>
              <div class="text">
                <strong>Dark Mode</strong>
                <div class="">
                  Enable dark mode theme (only applicable to internal webpage)
                </div>
              </div>
            </div>
          </div>
        </div>
      </li>
      <li id="revise">
        <img src="../assets/icons/revision.svg" alt="revision" width="20" />
        <div class="revision">
          <div class="head">Version logs</div>
          <div class="content" style="padding: 0">
            <div class="inner-content-revision">
              <img src="../assets/icons/star.svg" alt="" width="30" />
              <div class="text">
                <strong>4.4.0</strong>
                <div>Aug 27, 2021</div>
              </div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                style="width: 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
            <div class="inner-content-revision">
              <div class="text">
                <strong>4.4.0</strong>
                <div>Aug 27, 2021</div>
              </div>
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                style="width: 20"
              >
                <path
                  fill-rule="evenodd"
                  d="M12.53 16.28a.75.75 0 01-1.06 0l-7.5-7.5a.75.75 0 011.06-1.06L12 14.69l6.97-6.97a.75.75 0 111.06 1.06l-7.5 7.5z"
                  clip-rule="evenodd"
                />
              </svg>
            </div>
          </div>
        </div>
      </li>
    </ul>
  </header>
</template>

<script>
import { mapStores } from "pinia";
import useToggleSidebarStore from "@/stores/useToggleSidebar";
export default {
  name: "AppHeader",
  computed: {
    ...mapStores(useToggleSidebarStore),
  },
  methods: {
    toggleSidebar() {
      this.toggleSidebarStore.isExpanded = !this.toggleSidebarStore.isExpanded;
    },
  },
};
</script>

<style scoped>
header {
  background-color: var(--primaryColor);
  height: 5.44rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 1rem;
  box-shadow: 0px 2px 24px -3px rgba(0, 0, 0, 0.37);
}
.left {
  display: flex;
  align-items: center;
  /* width: 60%; */
  gap: 1rem;
}
.form-control {
  padding: 1rem 2rem;
  background-color: var(--tertiaryColor);
  border: none;
  width: 100%;
  border-radius: 0.4rem;
  color: #fff;
}
input:focus {
  outline: none;
  border: none;
}
::placeholder {
  color: #fff;
  opacity: 0.5;
}
ul li {
  display: inline-flex;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  justify-content: center;
}
ul li:hover {
  background-color: var(--tertiaryColor);
}
.top-search {
  display: none;
}

#settings,
#monitor,
#revise,
#bell {
  position: relative;
}

#settings:hover .inner-settings,
#monitor:hover .dash-monitor,
#revise:hover .revision,
#bell:hover .notification {
  display: block;
}

.inner-settings,
.revision,
.notification {
  width: 30rem;
  position: absolute;
  right: 0;
  top: 0;
  margin-top: 4rem;
  background: #fff;
  box-shadow: var(--boxShadow);
  border-radius: 0.4rem;
  overflow: hidden;
  display: none;
}

.notification {
  right: -36px;
}

.inner-content-revision {
  display: flex;
  border-bottom: 1px solid #ccc;
  padding: 1.5rem 2rem;
}
.inner-content-revision .text {
  flex-grow: 1;
  padding: 0 1rem;
}

.dash-monitor {
  position: absolute;
  right: 0;
  top: 0;
  font-size: 1.2rem;
  width: 13em;
  background: #444;
  color: #fff;
  text-align: center;
  padding: 1rem;
  border-radius: 0.4rem;
  margin-top: 4rem;
  display: none;
}

.head {
  font-weight: 600;
  font-size: 1.6rem;
  padding: 1.5rem;
  border-block: 1px solid #ccc;
}
.content {
  padding: 1.5rem;
  border-bottom: 1px solid #ccc;
}
.content:last-child {
  border: none;
}
.inner-content {
  display: grid;
  grid-template-columns: 4rem 1fr;
  gap: 2rem;
  align-items: center;
  color: rgb(121, 121, 121);
}
.text {
  font-size: 1.4rem;
}
.date {
  font-weight: 700;
  font-size: 1.2rem;
  color: var(--bgBlue);
  margin-top: 0.5rem;
}
@media (min-width: 48em) {
  /* 768px */
  .top-search {
    display: block;
  }
  .left {
    width: 60%;
  }

  .notification {
    right: 0;
  }
}

input[type="checkbox"] {
  position: relative;
  appearance: none;
  width: 40px;
  height: 18px;
  background: #ccc;
  border-radius: 50px;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.2);
  cursor: pointer;
  transition: 0.4s;
}

input:checked[type="checkbox"] {
  background: #7da6ff;
}

input[type="checkbox"]::after {
  position: absolute;
  content: "";
  width: 21px;
  height: 19px;
  top: 0;
  left: 0;
  background: #fff;
  border-radius: 50%;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  transform: scale(1.1);
  transition: 0.4s;
}

input:checked[type="checkbox"]::after {
  left: 50%;
}
</style>
