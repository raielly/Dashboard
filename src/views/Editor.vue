<template>
  <div id="editor">
    <Button
      @click="showModal"
      :title="'Add Editor'"
      v-show="userStore.type != 0"
    />
    <br />
    <card>
      <data-table :thead="thead">
        <tbody>
          <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.firstName }}</td>
            <td>{{ user.lastName }}</td>
            <td>{{ user.type == 0 ? "Writer" : "Editor" }}</td>
            <td>{{ user.status == 0 ? "Active" : "Inactive" }}</td>
            <td class="action">
              <Button
                @click.prevent="editUserModal(user)"
                :title="'Edit'"
                :bgColor="'#127245'"
                v-if="userStore.type != 0"
              />
              <Button
                v-else
                @click.prevent="editUserModal(user)"
                :title="'View'"
                :bgColor="'#127245'"
              />
            </td>
          </tr>
          <tr v-if="!users.length">
            <td colspan="6" style="text-align: center">No Data Found.</td>
          </tr>
        </tbody>
      </data-table>
    </card>
    <div class="overlay" v-show="modalPop" @click="showModal"></div>

    <!-- Add User -->
    <div class="modal-inner" v-show="modalPop">
      <div class="modal-title" v-if="!editModal">Add Editor</div>
      <div class="modal-title" v-else>Edit Editor</div>
      <div class="modal-content">
        <form v-if="editModal" method="post" @submit.prevent="editUser">
          <input
            type="text"
            class="form-control"
            placeholder="First Name"
            v-model="userData.firstName"
            required
            :disabled="userStore.type == 0"
          />
          <input
            type="text"
            class="form-control"
            placeholder="Last Name"
            v-model="userData.lastName"
            required
            :disabled="userStore.type == 0"
          />
          <select
            class="form-control"
            v-model="userData.status"
            :disabled="userStore.type == 0"
          >
            <option value="0">Active</option>
            <option value="1">Inactive</option>
          </select>
          <input type="hidden" v-model="userData.id" />
          <Button
            :type="'submit'"
            title="Submit"
            :full="'full'"
            v-show="userStore.type != 0"
          />
        </form>

        <form v-else method="post" @submit.prevent="addUser">
          <input
            type="text"
            class="form-control"
            placeholder="First Name"
            v-model="userData.firstName"
            required
          />
          <input
            type="text"
            class="form-control"
            placeholder="Last Name"
            v-model="userData.lastName"
            required
          />
          <Button :type="'submit'" title="Submit" :full="'full'" />
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { mapStores } from "pinia";
import useToggleModalStore from "@/stores/useToggleModal";
import { useUserStore } from "@/stores/useUser";
import { computed } from "@vue/runtime-core";

import axios from "axios";
import Card from "@/components/Card.vue";
import Button from "@/components/Button.vue";
import DataTable from "@/components/DataTable.vue";

export default {
  name: "Editor",
  components: {
    Button,
    Card,
    DataTable,
  },
  computed: {
    ...mapStores(useToggleModalStore),
  },
  data() {
    return {
      users: {},
      editModal: false,
      thead: ["id", "First Name", "Last Name", "Type", "Status", "Action"],
      modalPop: false,
      userData: {
        firstName: null,
        lastName: null,
        status: null,
      },
      userStore: computed(() => useUserStore().getUserInfo),
    };
  },
  created() {
    this.getUserData();
  },
  methods: {
    resetForm() {
      this.userData = {
        firstName: null,
        lastName: null,
        status: null,
      };
    },

    addUser() {
      let data = new FormData();
      data.append("firstName", this.userData.firstName);
      data.append("lastName", this.userData.lastName);
      data.append("type", 1);

      axios
        .post("http://localhost/archintel/src/Api/api.php?action=adduser", data)
        .then((res) => {
          alert("Editor Successfully added");
          this.getUserData();
          this.resetForm();
          this.modalPop = false;
          this.modalStore.isOpen = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    editUserModal(user) {
      this.editModal = true;
      this.modalPop = true;
      this.modalStore.isOpen = true;
      this.userData = {
        id: user.id,
        firstName: user.firstName,
        lastName: user.lastName,
        status: user.status,
      };
    },

    editUser() {
      let data = new FormData();
      data.append("id", this.userData.id);
      data.append("firstName", this.userData.firstName);
      data.append("lastName", this.userData.lastName);
      data.append("type", 1);
      data.append("status", this.userData.status);

      axios
        .post(
          "http://localhost/archintel/src/Api/api.php?action=edituser",
          data
        )
        .then((res) => {
          alert("Editor Successfully Updated");
          this.getUserData();
          this.resetForm();
          this.modalPop = false;
          this.modalStore.isOpen = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    getUserData() {
      axios
        .get("http://localhost/archintel/src/Api/api.php?action=userdata")
        .then((res) => {
          const newUser = res.data.userData.filter((user) => user.type == 1);
          this.users = newUser;
        });
    },

    showModal() {
      this.modalStore.isOpen = !this.modalStore.isOpen;
      this.modalPop = this.modalStore.isOpen;
      this.editModal = false;
      this.resetForm();
    },
  },
};
</script>

<style scoped>
table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 0.4rem;
  overflow: hidden;
}

tr:nth-of-type(odd) {
  background: #eee;
}

th {
  background: #1976d2;
  color: white;
  font-weight: bold;
}

td,
th {
  padding: 1rem;
  text-align: left;
  font-size: 1.4rem;
}
.action {
  text-align: center;
  width: 20%;
}

.form-control {
  border: 1px solid #eee;
  padding: 1.2rem;
  outline: 0;
  width: 100%;
  margin-bottom: 1rem;
}
input:focus {
  outline: none;
}
::placeholder {
  color: #6c6c6c;
}

.overlay {
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  z-index: 999;
  background-color: rgba(0, 0, 0, 0.7);
}
.modal-inner {
  width: 40rem;
  border-radius: 0.4rem;
  overflow: hidden;
  position: fixed;
  left: 50%;
  top: 35%;
  transform: translate(-50%, -50%);
  z-index: 9990;
}
.modal-title {
  background-color: var(--tertiaryColor);
  color: #fff;
  padding: 1.5rem;
}
.modal-content {
  padding: 1.5rem;
  background: #fff;
}
</style>
