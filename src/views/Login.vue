<template>
  <div id="login">
    <h2 class="text-center">Login</h2>
    <form action="post" class="login-form" @submit.prevent="login">
      <input
        type="text"
        class="form-control"
        placeholder="First Name"
        required
        v-model="firstName"
      />
      <select class="form-control" v-model="type">
        <option value="1">Editor</option>
        <option value="0">Writer</option>
      </select>
      <Button :type="'submit'" title="Submit" :full="'full'" />
    </form>
  </div>
</template>

<script>
import axios from "axios";
import Button from "@/components/Button.vue";
export default {
  name: "Login",
  components: {
    Button,
  },
  data() {
    return {
      firstName: "Raiel",
      type: 1,
    };
  },
  mounted() {
    let user = localStorage.getItem("userInfo");
    if (user) {
      this.$router.push({ name: "Dashboard" });
    }
  },
  methods: {
    async login() {
      if (this.firstName == "Raiel" || this.firstName == "raiel") {
        let data = new FormData();
        data.append("firstName", this.firstName);
        data.append("type", this.type);

        let result = await axios.post(
          "http://localhost/archintel/src/Api/api.php?action=login",
          data
        );

        if (result.status == 200) {
          localStorage.setItem(
            "userInfo",
            JSON.stringify(result.data.userLogin)
          );
          this.$router.push({ path: "/dashboard" }).then(() => {
            this.$router.go();
          });
        }
        //   console.log(result.data.userLogin);
      } else {
        alert("Incorrect User");
      }
    },
  },
};
</script>

<style scoped>
#login {
  border: 1px solid #ccc;
  width: 40rem;
  background: #fff;
  position: absolute;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  padding: 2rem;
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
.login-form {
  margin-top: 3rem;
}
.text-center {
  text-align: center;
}
h2 {
  margin: 0;
}
</style>
