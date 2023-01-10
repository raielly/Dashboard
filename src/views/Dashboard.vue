<template>
  <div id="dashboard" v-cloak>
    <div>
      <card :title="'Welcome to Walbro Dashboard'">
        <template v-slot:dateButton>
          <div class="dateToday">Data of {{ getDateToday() }}</div>
          <router-link to="/create-article">
            <Button :title="'create article'" />
          </router-link>
        </template>
        <div>
          <div id="article" class="customer">
            <div class="title">Customers</div>
            <div class="content">
              <div class="action">
                <div>
                  <img src="../assets/icons/pencil.svg" alt="" width="20" />
                </div>
                <div>
                  <img src="../assets/icons/user.svg" alt="" width="20" />
                </div>
                <div>
                  <img src="../assets/icons/file.svg" alt="" width="20" />
                </div>
              </div>
              <div class="inner-content">
                <div class="content-title">Part of the journey is the end.</div>
                <div class="rating">
                  <img src="../assets/icons/star.svg" alt="" width="15" />
                  <img src="../assets/icons/star.svg" alt="" width="15" />
                </div>
                <div class="content-info">
                  <div>Created on Oct. 8 2021 3:12 PM</div>
                  <div>[0|0] Source Date Oct. 8, 2021</div>
                  <div>Media Date Oct 8, 2021</div>
                </div>
              </div>
              <div class="comment">
                <img src="../assets/icons/comment.svg" alt="" width="25" />
              </div>
            </div>
            <div class="content">
              <div class="action">
                <div>
                  <img src="../assets/icons/pencil.svg" alt="" width="20" />
                </div>
                <div>
                  <img src="../assets/icons/user.svg" alt="" width="20" />
                </div>
                <div>
                  <img src="../assets/icons/file.svg" alt="" width="20" />
                </div>
              </div>
              <div class="inner-content">
                <div class="content-title">
                  I would rather be a good man than a great king.
                </div>
                <div class="rating">
                  <img src="../assets/icons/star.svg" alt="" width="15" />
                  <img src="../assets/icons/star.svg" alt="" width="15" />
                </div>
                <div class="content-info">
                  <div>Created on Oct. 8 2021 3:12 PM</div>
                  <div>[0|0] Source Date Oct. 8, 2021</div>
                  <div>Media Date Oct 8, 2021</div>
                </div>
              </div>
              <div class="comment">
                <img src="../assets/icons/comment.svg" alt="" width="25" />
              </div>
            </div>
          </div>
          <div id="article" class="competitors">
            <div class="title">Competitors</div>
            <div class="content-info" style="padding: 1rem; text-align: center">
              No article availble
            </div>
          </div>
          <div id="article" class="products">
            <div class="title">Products</div>
            <div class="content">
              <div class="action">
                <div>
                  <img src="../assets/icons/pencil.svg" alt="" width="20" />
                </div>
                <div>
                  <img src="../assets/icons/user.svg" alt="" width="20" />
                </div>
                <div>
                  <img src="../assets/icons/file.svg" alt="" width="20" />
                </div>
              </div>
              <div class="inner-content">
                <div class="content-title">
                  With great power comes great responsibility.
                </div>
                <div class="rating">
                  <img src="../assets/icons/star.svg" alt="" width="15" />
                  <img src="../assets/icons/star.svg" alt="" width="15" />
                </div>
                <div class="content-info">
                  <div>Created on Oct. 8 2021 3:12 PM</div>
                  <div>[0|0] Source Date Oct. 8, 2021</div>
                  <div>Media Date Oct 8, 2021</div>
                </div>
              </div>
              <div class="comment">
                <img src="../assets/icons/comment.svg" alt="" width="25" />
              </div>
            </div>
          </div>
        </div>
      </card>
    </div>
    <div>
      <card :title="'Writer Production'">
        <table cellspacing="0" cellpadding="0">
          <thead>
            <tr>
              <td>Name</td>
              <td>Assigned</td>
              <td>Submitted</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Writer 1</td>
              <td>1</td>
              <td>1</td>
            </tr>
            <tr>
              <td>Writer 1</td>
              <td>1</td>
              <td>1</td>
            </tr>
          </tbody>
        </table>
      </card>
      <br />
      <card :title="'Article Preview'">
        <div id="article" class="customer">
          <div class="title">Customers</div>
          <div class="content-prev">
            <div class="content-company">
              <div class="logo">
                <img
                  src="../assets/img/archintel.webp"
                  alt=""
                  class="img-logo"
                />
              </div>
              <div class="edit-status">Safe to use</div>
              <div class="company-name">Archintel</div>
              <div class="prev-action">View Details</div>
            </div>
            <div class="content-inner-prev">
              <div class="prev-title">
                <span class="for-editing">for editing</span>
                <div>
                  There's no heroes, no villains. Just people with different
                  agendas.
                </div>
              </div>
              <p class="prev-content">
                the quick brown fox jump over the lazy dog
              </p>
            </div>
          </div>
        </div>
        <div id="article" class="competitors">
          <div class="title">Competitors</div>
          <div class="content-info" style="padding: 1rem; text-align: center">
            No article availble
          </div>
        </div>
        <div id="article" class="products">
          <div class="title">Products</div>
          <div class="content-info" style="padding: 1rem; text-align: center">
            No article availble
          </div>
        </div>
      </card>
    </div>
  </div>
</template>

<script>
import Card from "@/components/Card.vue";
import Button from "@/components/Button.vue";
export default {
  name: "Dashboard",
  components: {
    Card,
    Button,
  },
  mounted() {
    let user = localStorage.getItem("userInfo");
    if (!user) {
      this.$router.push({ name: "Login" });
    }
  },
  data() {
    return {
      // dateToday: this.getDateToday(),
    };
  },
  methods: {
    getDateToday() {
      return new Date().toLocaleDateString("en-us", {
        // weekday: "long",
        day: "numeric",
        year: "numeric",
        month: "short",
        hour: "numeric",
        minute: "numeric",
      });
    },
  },
};
</script>

<style scoped>
.dateToday {
  font-size: 1.4rem;
  color: var(--grayColor);
  margin-bottom: 1.5rem;
}
#dashboard {
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
}
.top-0 {
  margin-top: 0;
}
#article .title {
  background-color: var(--bgBlue);
  padding: 0.5rem;
  color: #fff;
  text-align: center;
  font-size: 1.4rem;
  font-weight: 600;
}
.content {
  display: flex;
  border: 1px solid #ddd;
}
.content:last-child {
  border: none;
}
.content-title {
  color: var(--bgBlue);
  font-weight: 600;
}
.action {
  width: 6rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-self: center;
  gap: 0.2em;
}
.action div {
  text-align: center;
}
.inner-content {
  flex-grow: 1;
  padding: 1rem;
}
.content-info {
  color: #555;
  font-size: 1.2rem;
}
.comment {
  width: 6rem;
  display: flex;
  justify-content: center;
  align-content: center;
}
table {
  width: 100%;
  padding: 1rem;
  font-size: 1.4rem;
}
table thead td,
table tbody td {
  border-bottom: 1px solid #ccc;
  padding: 0.5rem;
}
table tbody tr:last-child td {
  border: none;
}
.content-prev {
  display: flex;
  padding: 1.5rem;
  gap: 1rem;
}
.content-company {
  width: 12rem;
}
.content-inner-prev {
  flex-grow: 1;
}
.logo {
  height: 11rem;
  margin-bottom: 1rem;
}

.img-logo {
  width: 100%;
  height: 11rem;
  object-fit: contain;
  border: 1px solid #ccc;
}

.edit-status {
  background: #4caf50;
  color: #fff;
  text-align: center;
  border-radius: 3rem;
  width: 10rem;
  font-size: 1.4rem;
  padding: 0.5rem;
  margin: auto;
  margin-bottom: 0.5rem;
}

.company-name {
  font-size: 1.4rem;
  color: #555;
  font-weight: 500;
  text-align: center;
  margin-bottom: 1.3rem;
}
.prev-action {
  font-weight: 600;
  color: var(--bgBlue);
  text-align: center;
  font-size: 1.4rem;
  text-transform: uppercase;
}
.prev-title {
  color: var(--bgBlue);
  font-weight: 600;
  display: grid;
  grid-template-columns: 90px 1fr;
  align-content: center;
  align-items: start;
  gap: 1rem;
}

.prev-title span {
  font-size: 1.2rem;
  padding: 0.5rem 1.2rem;
  border-radius: 4rem;
  background: rgb(247, 205, 81);
  color: #222;
  text-align: center;
}

.prev-content {
  font-size: 1.4rem;
  color: #aaa;
}

@media (min-width: 75em) {
  /* 992px */
  #dashboard {
    grid-template-columns: 1fr 1fr;
  }
}
</style>
