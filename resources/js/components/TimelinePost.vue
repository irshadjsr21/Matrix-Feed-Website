<template>
  <div class="timeline-post-container">
    <div class="timeline-post">
      <a v-bind:href="'/posts/' + encodeURI(post.title)">
        <div
          class="timeline-post-image"
          v-bind:style="{ backgroundImage: 'url(\'' + post.image + '\')' }"
        ></div>
      </a>

      <a
        v-bind:href="'/posts/' + encodeURI(post.title)"
        class="timeline-post-title"
      >{{ post.title }}</a>

      <div class="timeline-post-details">
        <a
          v-bind:href="'/author/' + post.author_id"
          class="timeline-post-author"
          v-if="post.author_id"
        >
          <span class="t-mute">by {{ post.author_firstName + " " + post.author_lastName }}</span>
          <span class="verified">
            <i class="fas fa-check-circle"></i>
          </span>
        </a>
        <span class="timeline-post-author t-mute" v-if="!post.author_id">by {{ post.author }}</span>
        <span class="timeline-post-date t-mute">
          -
          <date-format v-bind:date="post.created_at"></date-format>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["post"]
};
</script>
