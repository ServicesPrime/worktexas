<template>
  <div :class="wrapperClass">
    <slot />
  </div>
</template>

<script>
export default {
  name: "BaseButtons",
  props: {
    noWrap: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: "justify-start",
    },
    mb: {
      type: String,
      default: "-mb-3",
    },
    classAddon: {
      type: String,
      default: "mr-3 last:mr-0 mb-3",
    },
  },
  computed: {
    wrapperClass() {
      return [
        "flex",
        "items-center",
        this.type,
        this.noWrap ? "flex-nowrap" : "flex-wrap",
        this.mb,
      ];
    },
  },
};
</script>

<style scoped>
/* Aplica classAddon a todos los hijos directos */
::v-deep > * {
  margin-right: 0.75rem; /* mr-3 */
  margin-bottom: 0.75rem; /* mb-3 */
}

/* Elimina margen derecho del último hijo */
::v-deep > *:last-child {
  margin-right: 0; /* last:mr-0 */
}
</style>
