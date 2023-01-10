<template>
  <div id="account-setting">
    <card :title="'Walbro - Account Setting'">
      <template v-slot:dateButton>
        <div class="sub">Manage account setting for Walbro</div>
      </template>
      <div class="content">
        <div class="inner-content">
          <div class="title">General</div>
          <form action="">
            <div class="form-control">
              <label>
                <input type="checkbox" checked />
                Require Image Caption
              </label>
              <div class="sub-label">
                This will require image caption line 1 upon submit for editing
                or publish, Unchecking will disable all image caption fields.
              </div>
            </div>
            <div class="form-control">
              <label>
                <input type="checkbox" />
                Require Meta Description
              </label>
              <div class="sub-label">
                This will require description upon submit for editing or publish
                will hide the field
              </div>
            </div>
            <div class="form-control">
              <label>
                <input type="checkbox" />
                Show Video Text field
              </label>
              <div class="sub-label">
                This will show video text field in the writer/editor panels
              </div>
            </div>
            <div class="form-control">
              <label>
                <input type="checkbox" />
                Enable Video Process
              </label>
              <div class="sub-label">
                This will show video text field in the writer/editor panels
              </div>
            </div>
            <div class="two-col">
              <div>
                <div class="input-control">
                  <input type="text" value="10" required />
                  <label>Minimum</label>
                </div>
                <div class="sub-label">
                  Below the value will appear the count display red text
                  otherwise it will appear orange
                </div>
              </div>
              <div>
                <div class="input-control">
                  <input type="text" value="10" required />
                  <label>Minimum</label>
                </div>
                <div class="sub-label">
                  Below the value will appear the count display red text
                  otherwise it will appear orange
                </div>
              </div>
              <div>
                <div class="input-control">
                  <input type="text" value="80" required />
                  <label>Standard</label>
                </div>
                <div class="sub-label">
                  Equal or greater then this value will appear the count display
                  in green text.
                </div>
              </div>
              <div>
                <div class="input-control">
                  <input type="text" value="80" required />
                  <label>Standard</label>
                </div>
                <div class="sub-label">
                  Equal or greater then this value will appear the count display
                  in green text.
                </div>
              </div>
              <div>
                <div class="input-control">
                  <input type="text" value="100" required />
                  <label>Maximum</label>
                </div>
                <div class="sub-label">
                  Greater than this value will appear the count display in red
                  text.
                </div>
              </div>
              <div>
                <div class="input-control">
                  <input type="text" value="100" required />
                  <label>Maximum</label>
                </div>
                <div class="sub-label">
                  Greater than this value will appear the count display in red
                  text.
                </div>
              </div>
            </div>
            <br />
            <Button :type="'submit'" title="Save" :full="'full'" />
          </form>
        </div>
        <div class="inner-content" style="overflow: hidden">
          <div class="title" style="margin-bottom: 0.5rem">General</div>
          <div class="sub">
            These settings are category validations on submitting an article for
            editing and publish
          </div>
          <form action="">
            <div>
              <data-table :thead="thead">
                <tbody>
                  <tr>
                    <td>Customer</td>
                    <td><input type="checkbox" checked /></td>
                    <td><input type="checkbox" checked /></td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" /></td>
                  </tr>
                  <tr>
                    <td>Competitor</td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" checked /></td>
                    <td><input type="checkbox" checked /></td>
                    <td><input type="checkbox" /></td>
                  </tr>
                  <tr>
                    <td>Products</td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" checked /></td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" /></td>
                    <td><input type="checkbox" /></td>
                  </tr>
                </tbody>
              </data-table>
            </div>
            <br /><br /><br />
            <Button :type="'submit'" title="Save" :full="'full'" />
          </form>
        </div>
      </div>
    </card>
  </div>
</template>

<script>
import Card from "@/components/Card.vue";
import Button from "@/components/Button.vue";
import DataTable from "@/components/DataTable.vue";
export default {
  name: "AccountSetting",
  components: {
    Card,
    Button,
    DataTable,
  },
  data() {
    return {
      thead: [
        "Name",
        "Require Summary",
        "Require Content",
        "Require Link in Content",
        "Prevent Link in the Summary",
        "Prevent Link in the content",
      ],
    };
  },
};
</script>

<style scoped>
.sub {
  font-size: 1.4rem;
  color: var(--grayColor);
  margin-bottom: 1.5rem;
}
.content {
  padding: 1rem;
  display: grid;
  grid-template-columns: 1fr;
  gap: 2rem;
}
.two-col {
  display: grid;
  grid-template-columns: 1fr;
  gap: 1rem;
}
.inner-content {
  border: 1px solid #ccc;
  padding: 1.5rem;
  border-radius: 0.4rem;
  color: #6c6c6c;
}
.form-control {
  user-select: none;
  margin-bottom: 2.5rem;
}
input:focus {
  outline: none;
}
::placeholder {
  color: #6c6c6c;
}
.title {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 2.5rem;
  color: #222;
}
.sub-label {
  font-size: 1.2rem;
  margin-top: 0.3rem;
}
.input-control {
  position: relative;
}
.input-control input {
  display: inline-block;
  border: 1px solid #ccc;
  padding: 10px;
  width: 100%;
  border-radius: 0.4rem;
}
.input-control input:focus {
  border: 1px solid #ccc;
  background-color: #fff;
}
.input-control label {
  color: #999;
  position: absolute;
  pointer-events: none;
  left: 10px;
  top: 10px;
  transition: 0.2s;
  font-size: 1.2rem;
}
.input-control input:focus ~ label,
.input-control input:valid ~ label {
  top: -8px;
  left: 10px;
  font-size: 12px;
  color: #ccc;
  background-color: #fff;
  padding: 0 5px 0 5px;
}
table {
  display: block;
  overflow-x: scroll;
}
@media (min-width: 75em) {
  /* 992px */
  .content {
    grid-template-columns: 1fr 1fr;
  }
  .two-col {
    grid-template-columns: 1fr 1fr;
  }
}
</style>

<style>
#account-setting th {
  background: #fff !important;
  color: #888 !important;
  font-weight: 500 !important;
  border-top: 1px solid #ccc;
  border-bottom: 1px solid #ccc;
}
#account-setting td,
#account-setting th {
  padding: 1rem;
  text-align: left;
  font-size: 1.2rem;
}
#account-setting tbody tr td:last-child,
#account-setting thead tr th:last-child {
  text-align: left;
  /* width: 20%; */
}
</style>
