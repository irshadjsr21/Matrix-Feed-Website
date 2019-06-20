<template>
  <div class="timeline">
    <timeline-post v-bind:key="post.id" v-for="post in posts.data" v-bind:post="post"></timeline-post>
  </div>
</template>

<script>
import TimelinePost from "./TimelinePost";
export default {
  props: ["posts"],
  mounted() {
    console.log(this.posts);
  }
};
</script>
