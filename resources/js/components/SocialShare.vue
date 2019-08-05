<template>
  <social-sharing
    v-bind:url="url"
    v-bind:title="quote"
    v-bind:description="quote"
    v-bind:quote="quote"
    inline-template
  >
    <div class="social-links">
      <network network="facebook">
        <i class="fab fa-facebook-square"></i>
      </network>
      <network network="linkedin">
        <i class="fab fa-linkedin"></i>
      </network>
      <network network="twitter">
        <i class="fab fa-twitter"></i>
      </network>
      <network network="whatsapp">
        <i class="fab fa-whatsapp"></i>
      </network>
    </div>
  </social-sharing>
</template>

<script>
export default {
  props: ["post"],
  data() {
    return {
      url: window.location.origin + window.location.pathname,
      quote: `Check out this awesome post I came across on Matrix Feed titled \"${this.post.title}\"`
    };
  }
};
</script>

