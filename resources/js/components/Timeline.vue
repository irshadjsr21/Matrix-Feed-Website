<template>
  <div class="timeline">
    <timeline-post v-bind:key="post.id" v-for="post in posts" v-bind:post="post"></timeline-post>
  </div>
</template>

<script>
export default {
  props: ["posts"]
};
</script>
