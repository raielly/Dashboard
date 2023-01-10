<template>
  <div class="card">
    <div class="card-head" v-show="title">
      <div class="card-title">
        {{ title }}
      </div>
      <slot name="dateButton"></slot>
    </div>
    <div class="card-content">
      <slot></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "Card",
  props: {
    title: {
      type: String,
    },
  },
};
</script>

<style scoped>
.card {
  background-color: #fff;
  box-shadow: var(--boxShadow2);
  border-radius: 0.4rem;
}
.card-head {
  padding: 1.5rem;
}
.card-title {
  font-size: 1.8rem;
  font-weight: 700;
  margin-bottom: 0.3rem;
}
.card-content {
  margin-top: 1rem;
}
</style>
