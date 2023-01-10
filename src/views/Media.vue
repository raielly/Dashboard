<template>
  <div id="media">
    <div>
      <card :title="'Walbro - All Media'">
        <template v-slot:dateButton>
          <div class="two-col">
            <div class="sub">
              This table shows recently research articles for Walbro
            </div>
            <a href="#" class="older-post"> View older articles </a>
          </div>
          <div class="action-buttons">
            <Button :title="'Export'" :bgColor="'#1976D2'" />
            <div>
              <input type="text" class="form-control" placeholder="Search" />
              <input
                type="text"
                class="form-control"
                placeholder="Filter Date Start"
              />
              <input
                type="text"
                class="form-control"
                placeholder="Filter Date End"
              />
            </div>
          </div>
        </template>
        <data-table :thead="thead">
          <tbody>
            <tr v-for="article in articles" :key="article.id">
              <td class="table-action">
                <a href="#">
                  <img src="../assets/icons/file-edit.svg" alt="" width="15" />
                </a>
                <a href="#">
                  <img src="../assets/icons/cloud.svg" alt="" width="20" />
                </a>
              </td>
              <td>{{ getDateToday2(article.date) }}</td>
              <td>{{ getDateToday(article.date) }}</td>
              <td>
                <input
                  type="checkbox"
                  :checked="forEdit(article.forEdit)"
                  style="pointer-events: none"
                />
              </td>
              <td>
                <input
                  type="checkbox"
                  :checked="forPublish(article.publish)"
                  style="pointer-events: none"
                />
              </td>
              <td>Customer</td>
              <td style="max-width: 200px; text-align: left">
                <router-link
                  :to="{ name: 'Article', params: { id: article.id } }"
                  style="color: var(--bgBlue); text-decoration: underline"
                >
                  {{ article.title }}</router-link
                >
              </td>
              <td>{{ article.firstName }} {{ article.lastName }}</td>
              <td>{{ article.firstName }} {{ article.lastName }}</td>
              <td>{{ article.firstName }} {{ article.lastName }}</td>
              <td>
                <img src="../assets/icons/star.svg" alt="" width="15" />
                <img src="../assets/icons/star.svg" alt="" width="15" />
                <img src="../assets/icons/star.svg" alt="" width="15" />
                <img src="../assets/icons/star.svg" alt="" width="15" />
              </td>
            </tr>
            <tr v-if="!articles.length">
              <td colspan="11" style="text-align: center">No Data Found.</td>
            </tr>
          </tbody>
        </data-table>
      </card>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Card from "@/components/Card.vue";
import Button from "@/components/Button.vue";
import DataTable from "@/components/DataTable.vue";
export default {
  name: "Media",
  components: {
    Card,
    Button,
    DataTable,
  },
  data() {
    return {
      thead: [
        "Action",
        "Media Date",
        "Create Date & Time",
        "For Editing",
        "Published",
        "Category",
        "Title",
        "Researcher",
        "Writer",
        "Editor",
        "Rating",
      ],
      articles: [],
    };
  },
  created() {
    this.getArticles();
  },
  methods: {
    async getArticles() {
      const result = await axios.get(
        "http://localhost/archintel/src/Api/api.php?action=article"
      );
      this.articles = result.data.articleData;
      console.log(this.articles);
    },

    getDateToday(date) {
      return new Date().toLocaleDateString("en-us", {
        // weekday: "long",
        day: "numeric",
        year: "numeric",
        month: "short",
        // hour: "numeric",
        // minute: "numeric",
      });
    },

    getDateToday2(date) {
      return new Date().toLocaleDateString("en-us", {
        // weekday: "long",
        day: "numeric",
        year: "numeric",
        month: "short",
        hour: "numeric",
        minute: "numeric",
      });
    },

    forEdit(val) {
      if (val == 0) {
        return true;
      } else {
        return false;
      }
    },

    forPublish(val) {
      if (val == 1) {
        return true;
      } else {
        return false;
      }
    },
  },
};
</script>

<style>
.sub {
  font-size: 1.4rem;
  color: var(--grayColor);
  margin-bottom: 1.5rem;
}
#media th {
  background: #fff !important;
  color: #888 !important;
  font-weight: 500 !important;
  border-top: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
}
#media td,
#media th {
  padding: 1rem;
  text-align: left;
  font-size: 1.2rem;
}
#media tbody tr td:last-child,
#media thead tr th:last-child {
  text-align: center;
  /* width: 20%; */
}
.two-col {
  display: flex;
  justify-content: space-between;
}
.older-post {
  text-transform: uppercase;
  font-size: 1.2rem;
  margin-top: -2.5rem;
  color: var(--bgBlue);
  font-weight: 600;
  display: none;
}
.form-control {
  border: 1px solid #eee;
  padding: 1.2rem;
  outline: 0;
  width: 100%;
  border-radius: 0.4rem;
}
input:focus {
  outline: none;
}
::placeholder {
  color: #6c6c6c;
}
.action-buttons {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
.action-buttons div {
  display: flex;
  gap: 0.5rem;
  display: none;
}
#media .card-content {
  overflow-x: scroll;
  display: block;
}
#media table {
  display: block;
  min-width: 99.2rem;
}

@media (min-width: 75em) {
  /* 992px */
  .older-post {
    display: block;
  }
  .action-buttons div {
    display: flex;
  }
  #media .card-content {
    overflow-x: unset;
    display: block;
  }
  #media table {
    display: inline-table;
    min-width: auto;
  }
}
</style>
