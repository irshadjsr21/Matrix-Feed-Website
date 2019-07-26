<template>
  <input type="hidden" name="redirect" v-bind:value="url" />
</template>

<script>
export default {
  data() {
    return {
      url: null
    };
  },

  created() {
    const url = getUrlParameter("redirect");
    this.url = url;
  }
};
</script>

