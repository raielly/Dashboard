<template>
  <table class="table" id="datatable">
    <thead>
      <tr>
        <th v-for="(th, index) in thead" :key="index">
          {{ th }}
        </th>
      </tr>
    </thead>
    <slot></slot>
  </table>
</template>

<script>
export default {
  name: "DataTable",
  props: {
    thead: {
      type: Array,
    },
    items: {
      item: Object,
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
tbody tr td:last-child,
thead tr th:last-child {
  text-align: center;
  /* width: 20%; */
}
</style>
