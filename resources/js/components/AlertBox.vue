<template>
  <div v-if="show" class="container py-4">
    <div v-bind:class="classes">
      {{ msg }}
      <button type="button" class="close" @click="close()" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  props: ["msg", "type"],

  data() {
    return {
      show: true,
      classes:
        this.type == "success"
          ? "alert alert-success alert-dismissible fade show"
          : this.type == "error"
          ? "alert alert-danger alert-dismissible fade show"
          : ""
    };
  },

  methods: {
    close() {
      this.show = false;
    }
  }
};
</script>

