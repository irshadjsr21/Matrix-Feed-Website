<template>
  <div class="row justify-content-center">
    <clap-icon
      v-if="!isLoading"
      v-on:click="addLike()"
      v-bind:liked="isLiked"
      v-bind:isLoading="isProcessing"
    />

    <div v-if="isLoading" class="loader loader-sm"></div>
  </div>
</template>

<script>
import axios from "axios";
import LoginRequestModalVue from "./LoginRequestModal.vue";
export default {
  props: ["postid", "user"],
  data() {
    return {
      http: null,
      isLiked: false,
      url: "/api/like/" + this.postid,
      isLoggedIn: this.user,
      currentUrl: window.location.pathname,
      isLoading: true,
      isProcessing: false
    };
  },

  methods: {
    async getData() {
      try {
        const data = await this.http.get(this.url);
        if (data.data) {
          this.isLiked = data.data.liked;
        }
        this.isLoading = false;
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },

    async addLike() {
      if (!this.isLoggedIn) {
        this.$modal.show(LoginRequestModalVue, null, { height: "auto" });
        return;
      }
      if (this.isProcessing) {
        return;
      }
      try {
        this.isProcessing = true;
        const data = await this.http.post(this.url);
        if (data.data) {
          this.isLiked = data.data.liked;
        }
        this.isProcessing = false;
      } catch (error) {
        console.log(error);
        this.isProcessing = false;
      }
    }
  },

  created() {
    if (this.isLoggedIn) {
      const csrfMeta = document.getElementById("csrf-token");
      const csrf = csrfMeta.getAttribute("content");
      this.http = axios.create({
        headers: { "X-CSRF-TOKEN": csrf }
      });
      this.getData();
    } else {
      this.isLoading = false;
    }
  }
};
</script>
