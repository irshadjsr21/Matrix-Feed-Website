<template>
  <div>
    <div v-if="!isLoading" class="row justify-content-center">
      <div class="like-container">
        <clap-icon v-on:click="addLike()" v-bind:liked="isLiked" v-bind:isLoading="isProcessing" />
        <div class="like-count">{{totalLikes}}</div>
      </div>
    </div>

    <div v-if="isLoading" class="row justify-content-center">
      <div class="loader loader-sm"></div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import LoginRequestModalVue from "./LoginRequestModal.vue";
export default {
  props: ["postid", "user"],
  data() {
    return {
      http: window.axios,
      isLiked: false,
      url: "/api/like/" + this.postid,
      isLoggedIn: this.user,
      currentUrl: window.location.pathname,
      isLoading: true,
      isProcessing: false,
      totalLikes: null
    };
  },

  methods: {
    async getData() {
      try {
        const data = await this.http.get(this.url);
        if (data.data) {
          this.isLiked = data.data.liked;
          this.totalLikes = data.data.total;
        }
        this.isLoading = false;
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },

    async addLike() {
      if (!this.isLoggedIn) {
        this.$modal.show(LoginRequestModalVue, null, { height: "auto", adaptive:true });
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
          this.totalLikes = data.data.total;
        }
        this.isProcessing = false;
      } catch (error) {
        console.log(error);
        this.isProcessing = false;
      }
    }
  },

  created() {
    this.getData();
  }
};
</script>
