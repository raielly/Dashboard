<template>
  <form method="post" class="article-form">
    <div id="new-article">
      <card :title="'Update Article'" class="update">
        <div class="editor">
          <input
            type="text"
            class="form-control"
            placeholder="Add Title"
            v-model="articles.title"
          />
          <br /><br />
          <ckeditor
            :editor="editor"
            v-model="articles.content"
            :config="editorConfig"
          ></ckeditor>
        </div>
      </card>
      <div class="article-action">
        <card>
          <div class="title2">Publish</div>
          <div style="padding: 1rem">
            <label for="">
              <input
                type="checkbox"
                v-model="articles.forEdit"
                :true-value="0"
                :false-value="1"
              />
              for Edit?
            </label>
            <label for="" v-show="userStore.type != 0">
              <input
                type="checkbox"
                v-model="articles.publish"
                :true-value="1"
                :false-value="0"
              />
              Publish?
            </label>
          </div>
          <div class="form-inner">
            <Button
              :type="'submit'"
              title="Submit"
              :full="'full'"
              @click.prevent="updateArticle"
            />
          </div>
        </card>
        <card>
          <div class="title2">Writer</div>
          <div class="form-inner">
            <select
              class="form-control"
              v-model="articles.writer"
              :disabled="userStore.type == 0"
            >
              <option
                v-for="user in users"
                :value="user.id"
                :key="user.id"
                :selected="user.id == articles.writer"
              >
                {{ user.firstName }} {{ user.lastName }}
              </option>
            </select>
          </div>
        </card>
        <card>
          <div class="title2">Editor</div>
          <div class="form-inner">
            <select
              class="form-control"
              v-model="articles.editor"
              :disabled="userStore.type == 0"
            >
              <option
                v-for="user in users"
                :value="user.id"
                :key="user.id"
                :selected="user.id == articles.editor"
              >
                {{ user.firstName }} {{ user.lastName }}
              </option>
            </select>
          </div>
        </card>
        <card>
          <div class="title2">Company</div>
          <div class="form-inner">
            <select class="form-control" v-model="articles.company">
              <option
                v-for="company in companies"
                :value="company.id"
                :key="company.id"
                :selected="company.id == articles.company"
              >
                {{ company.name }}
              </option>
            </select>
          </div>
        </card>
      </div>
    </div>
  </form>
</template>

<script>
import axios from "axios";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import Card from "@/components/Card.vue";
import Button from "@/components/Button.vue";
import { useUserStore } from "@/stores/useUser";
import { computed } from "@vue/runtime-core";

export default {
  name: "CreateArticle",
  components: {
    Card,
    Button,
    ClassicEditor,
  },
  mounted() {
    this.getCompany();
  },
  computed: {},
  data() {
    return {
      editor: ClassicEditor,
      editorData: "",
      editorConfig: {
        // The configuration of the editor.
      },
      id: this.$route.params.id,
      articles: [],
      users: [],
      companies: [],
      userStore: computed(() => useUserStore().getUserInfo),
    };
  },
  mounted() {
    this.getArticles();
    this.getUserData();
    this.getCompany();
  },
  methods: {
    async getArticles() {
      const { data } = await axios.get(
        "http://localhost/archintel/src/Api/api.php?action=article"
      );

      const newArticle = data.articleData.filter((item) => item.id === this.id);
      this.articles = newArticle[0];
    },

    async getUserData() {
      const { data } = await axios.get(
        "http://localhost/archintel/src/Api/api.php?action=userdata"
      );
      this.users = data.userData;
    },

    async updateArticle() {
      let data = new FormData();
      data.append("id", this.id);
      data.append("title", this.articles.title);
      data.append("link", "updated");
      data.append("content", this.articles.content);
      data.append("forEdit", this.articles.forEdit);
      data.append("publish", this.articles.publish);
      data.append("writer", this.articles.writer);
      data.append("editor", this.articles.editor);
      data.append("company", this.articles.company);

      const result = await axios.post(
        "http://localhost/archintel/src/Api/api.php?action=updatearticle",
        data
      );
      if (result.status == 200) {
        alert(result.data.message);
      }
      //console.log(result.status);
    },

    async getCompany() {
      const result = await axios.get(
        "http://localhost/archintel/src/Api/api.php?action=companydata"
      );
      this.companies = result.data.companyData;
    },
  },
};
</script>

<style scoped>
#new-article {
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
}
#new-article .update {
  overflow-x: scroll;
}
.editor {
  padding: 1rem;
  margin-top: -3rem;
}
.title2 {
  padding: 1rem;
  font-size: 1.6rem;
  font-weight: 600;
  border-bottom: 1px solid #ccc;
}
.article-action {
  margin-top: -1rem;
}
.article-action form {
  font-size: 1.4rem;
}
.form-inner {
  padding: 1rem;
  display: flex;
  flex-direction: column;
  gap: 1rem;
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

#new-article .card-content {
  margin-top: 0 !important;
}
@media (min-width: 75em) {
  /* 992px */
  #new-article {
    grid-template-columns: 3fr 1fr;
  }
  #new-article .update {
    overflow-x: unset;
  }
}
</style>

<style>
.ck-editor__editable {
  min-height: 30rem !important;
}
</style>
