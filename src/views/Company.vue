<template>
  <div id="company">
    <Button @click="showModal" :title="'Add Company'" />
    <br />
    <card>
      <data-table :thead="thead">
        <tbody>
          <tr v-for="company in companies" :key="company.id">
            <td width="300">
              <img :src="imgLink + company.logo" alt="" width="80" />
            </td>
            <td>{{ company.name }}</td>
            <td>{{ company.status == 0 ? "Active" : "Inactive" }}</td>
            <td class="action">
              <Button
                @click.prevent="editCompanyModal(company)"
                :title="'Edit'"
                :bgColor="'#127245'"
              />
            </td>
          </tr>
          <tr v-if="!companies.length">
            <td colspan="3" style="text-align: center">No Data Found.</td>
          </tr>
        </tbody>
      </data-table>
    </card>
    <div class="overlay" v-show="modalPop" @click="showModal"></div>

    <!-- Add User -->
    <div class="modal-inner" v-show="modalPop">
      <div class="modal-title" v-if="!editModal">Add Company</div>
      <div class="modal-title" v-else>Edit Company</div>
      <div class="modal-content">
        <form v-if="editModal" method="post" @submit.prevent="editCompany">
          <input
            type="file"
            class="form-control"
            placeholder="File"
            @change="handleFileUpload($event)"
          />
          <input
            type="text"
            class="form-control"
            placeholder="Last Name"
            v-model="companyData.name"
            required
          />
          <select class="form-control" v-model="companyData.status">
            <option value="0">Active</option>
            <option value="1">Inactive</option>
          </select>
          <input type="hidden" v-model="companyData.id" />
          <Button :type="'submit'" title="Submit" :full="'full'" />
        </form>

        <form v-else method="post" @submit.prevent="addCompany">
          <input
            type="file"
            class="form-control"
            placeholder="File"
            @change="handleFileUpload($event)"
            required
          />
          <input
            type="text"
            class="form-control"
            placeholder="Name"
            v-model="companyData.name"
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

import axios from "axios";
import Card from "@/components/Card.vue";
import Button from "@/components/Button.vue";
import DataTable from "@/components/DataTable.vue";

export default {
  name: "Company",
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
      companies: [],
      editModal: false,
      thead: ["Logo", "Name", "Status", "Action"],
      modalPop: false,
      companyData: {
        logo: null,
        name: null,
        status: 0,
      },
      imgLink: "http://localhost/archintel/src/Api/",
    };
  },
  created() {
    this.getCompany();
  },
  methods: {
    resetForm() {
      this.companyData = {
        logo: null,
        name: null,
        status: 0,
      };
    },

    addCompany() {
      let data = new FormData();
      data.append("logo", this.companyData.logo);
      data.append("name", this.companyData.name);
      data.append("status", 0);

      axios
        .post(
          "http://localhost/archintel/src/Api/api.php?action=addcompany",
          data
        )
        .then((res) => {
          alert("Company Successfully added");
          this.getCompany();
          this.resetForm();
          this.modalPop = false;
          this.modalStore.isOpen = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    editCompanyModal(company) {
      this.editModal = true;
      this.modalPop = true;
      this.modalStore.isOpen = true;
      this.companyData = {
        id: company.id,
        logo: company.logo,
        name: company.name,
        status: company.status,
      };
    },

    editCompany() {
      let data = new FormData();
      data.append("id", this.companyData.id);
      data.append("logo", this.companyData.logo);
      data.append("name", this.companyData.name);
      data.append("status", this.companyData.status);

      axios
        .post(
          "http://localhost/archintel/src/Api/api.php?action=editcompany",
          data
        )
        .then((res) => {
          alert("Company Successfully Updated");
          this.getCompany();
          this.resetForm();
          this.modalPop = false;
          this.modalStore.isOpen = false;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    handleFileUpload(e) {
      this.companyData.logo = e.target.files[0];
    },

    async getCompany() {
      const result = await axios.get(
        "http://localhost/archintel/src/Api/api.php?action=companydata"
      );
      this.companies = result.data.companyData;
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
