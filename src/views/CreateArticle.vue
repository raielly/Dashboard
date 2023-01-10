<template>
  <form method="post" class="article-form" @submit.prevent="addArticle">
    <div id="new-article">
      <card :title="'Add New Article'" class="update">
        <div class="editor">
          <input
            type="text"
            class="form-control"
            placeholder="Add Title"
            v-model="articleData.title"
            required
          />
          <br /><br />
          <ckeditor
            :editor="editor"
            v-model="articleData.content"
            :config="editorConfig"
          ></ckeditor>
        </div>
      </card>
      <div class="article-action">
        <card>
          <div class="title2">Publish</div>
          <div class="form-inner">
            <Button :type="'submit'" title="Submit" :full="'full'" />
          </div>
        </card>
        <card>
          <div class="title2">Writer</div>
          <div class="form-inner">
            <input
              type="text"
              class="form-control"
              v-model="articleData.writer"
              disabled
            />
          </div>
        </card>
        <card>
          <div class="title2">Editor</div>
          <div class="form-inner">
            <input
              type="text"
              class="form-control"
              v-model="articleData.editor"
              disabled
            />
          </div>
        </card>
        <card>
          <div class="title2">Company</div>
          <div class="form-inner">
            <select class="form-control" v-model="articleData.company">
              <option
                v-for="company in companies"
                :value="company.id"
                :key="company.id"
                :selected="company.id == userStore.company"
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
    this.articleData.writer = this.fullName();
    this.articleData.editor = this.fullName();
    this.getCompany();
    // console.log(useUserStore().users);
  },
  computed: {},
  data() {
    return {
      editor: ClassicEditor,
      editorData: "<p>Content of the editor.</p>",
      editorConfig: {
        // The configuration of the editor.
      },
      articleData: {
        title: null,
        link: window.location.host + "/",
        content: "",
        forEdit: null,
        publish: null,
        writer: "null",
        editor: null,
        company: "",
        companyId: null,
      },
      userStore: computed(() => useUserStore().users),
      companies: [],
    };
  },
  methods: {
    async addArticle() {
      const {
        title,
        link,
        content,
        publish,
        forEdit,
        writer,
        editor,
        company,
      } = this.articleData;
      let data = new FormData();
      data.append("title", title);
      data.append("link", link + title.replace(/\s+/g, "-").toLowerCase());
      data.append("content", content);
      data.append("forEdit", forEdit);
      data.append("publish", publish);
      data.append("writer", this.userStore.id);
      data.append("editor", this.userStore.id);
      data.append("company", this.articleData.company);

      const result = await axios.post(
        "http://localhost/archintel/src/Api/api.php?action=addpost",
        data
      );
      alert("Article Successfully Submitted!");
      this.$router.push("/media");
      // console.log(result);
    },

    fullName() {
      return this.userStore.firstName + " " + this.userStore.lastName;
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
