<template>
  <div class="row showcase" v-if="posts.length > 0">
    <a
      v-bind:href="'/posts/' + encodeCustom(posts[0].title)"
      v-bind:style="{ backgroundImage: 'url(\'' + posts[0].image + '\')' }"
      class="col showcase-main-section"
      v-if="posts[0]"
    >
      <div class="showcase-title">{{ posts[0].title | truncate(45)}}</div>
      <div class="showcase-details">
        <span class="showcase-author" v-if="posts[0].author_id">{{ posts[0].author_firstName + " " + posts[0].author_lastName }}</span>
        <span class="showcase-author" v-if="!posts[0].author_id">{{ posts[0].author }}</span>
        <span class="showcase-date">
          -
          <date-format v-bind:date="posts[0].created_at"></date-format>
        </span>
      </div>
    </a>

    <div class="col showcase-secondary-section-container">
      <div class="row showcase-secondary-section-container-row">
        <a
          v-bind:href="'/posts/' + encodeCustom(posts[1].title)"
          v-bind:style="{ backgroundImage: 'url(\'' + posts[1].image + '\')' }"
          class="col showcase-secondary-section"
          v-if="posts[1]"
        >
          <div class="showcase-title">{{ posts[1].title | truncate(45)}}</div>
        </a>
        <a
          v-bind:href="'/posts/' + encodeCustom(posts[2].title)"
          v-bind:style="{ backgroundImage: 'url(\'' + posts[2].image + '\')' }"
          class="col showcase-secondary-section"
          v-if="posts[2]"
        >
          <div class="showcase-title">{{ posts[2].title | truncate(45)}}</div>
        </a>
      </div>

      <div class="row showcase-secondary-section-container-row">
        <a
          v-bind:href="'/posts/' + encodeCustom(posts[3].title)"
          v-bind:style="{ backgroundImage: 'url(\'' + posts[3].image + '\')' }"
          class="col showcase-secondary-section"
          v-if="posts[3]"
        >
          <div class="showcase-title">{{ posts[3].title | truncate(45)}}</div>
        </a>
        <a
          v-bind:href="'/posts/' + encodeCustom(posts[4].title)"
          v-bind:style="{ backgroundImage: 'url(\'' + posts[4].image + '\')' }"
          class="col showcase-secondary-section"
          v-if="posts[4]"
        >
          <div class="showcase-title">{{ posts[4].title | truncate(45)}}</div>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["posts"],
  methods: {
    encodeCustom(str) {
      return window.encodeCustom(str);
    }
  }
};
</script>
