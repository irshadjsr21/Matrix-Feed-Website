<template>
  <div class="timeline-post-container">
    <a v-bind:href="'/posts/' + post.id" class="timeline-post">
      <div
        class="timeline-post-image"
        v-bind:style="{ backgroundImage: 'url(\'' + post.image + '\')' }"
      ></div>

      <div class="timeline-post-title">{{ post.title }}</div>

      <div class="timeline-post-details">
        <span class="timeline-post-author">by {{ post.author }}</span>
        <span class="timeline-post-date">
          -
          <date-format v-bind:date="post.created_at"></date-format>
        </span>
      </div>
    </a>
  </div>
</template>

<script>
export default {
  props: ["post"]
};
</script>
