<template>
  <div>
    <div
      class="h-100 row align-items-center"
      v-if="showcasePosts.length == 0 && timelinePosts == 0"
    >
      <div class="col text-center">
        <h3>No Posts Available</h3>
        <div style="opacity: 0.8" class="mb-2">We're sorry for the inconvenice caused.</div>
        <a href="/" class="btn btn-primary">Go Back</a>
      </div>
    </div>
    <post-showcase v-bind:posts="showcasePosts"></post-showcase>
    <timeline-list v-bind:posts="timelinePosts"></timeline-list>
  </div>
</template>

<script>
export default {
  props: ["posts"],
  data() {
    return {
      showcasePosts: [],
      timelinePosts: []
    };
  },

  created() {
    if (this.posts.data) {
      const page = this.getParameterByName("page");
      if (!page || page == 1) {
        this.showcasePosts = this.posts.data.slice(0, 5);
        this.timelinePosts = this.posts.data.slice(5);
      } else {
        this.timelinePosts = this.posts.data;
      }
    }
  },

  methods: {
    getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return "";
      return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
  }
};
</script>
