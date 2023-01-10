<template>
  <button
    :type="type"
    class="button"
    :class="full"
    :style="{ backgroundColor: bgColor }"
  >
    {{ title }}
  </button>
</template>

<script>
export default {
  name: "Button",
  props: {
    title: {
      type: String,
    },
    bgColor: {
      type: String,
      default: "#4CAF50",
    },
    type: {
      type: String,
      default: "button",
    },
    full: {
      type: String,
      default: "",
    },
  },
};
</script>

<style scoped>
.button {
  color: #fff;
  text-transform: uppercase;
  padding: 1rem;
  border: none;
  border-radius: 0.4rem;
  font-weight: 600;
  box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.37);
  cursor: pointer;
}
.button:hover {
  opacity: 0.9;
}
</style>
