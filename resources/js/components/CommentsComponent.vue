<template>
  <div class="comments-section my-4">
    <div v-if="!nocomment" class="form-group">
      <textarea
        name="comment"
        class="form-control mb-2"
        placeholder="Write a comment."
        v-model="newCommentText"
      ></textarea>
      <span v-if="error" class="invalid-feedback" style="display:block;" role="alert">
        <strong>{{ error }}</strong>
      </span>
      <div class="row justify-content-end no-gutters">
        <button
          class="btn btn-primary btn-loader-container"
          v-bind:disabled="isProcessing"
          @click="addComment()"
        >
          <span class="btn-loader" v-if="isProcessing"></span>
          <span>Add Comment</span>
        </button>
      </div>
    </div>

    <ul class="list-group" v-if="comments && comments.length > 0">
      <li
        v-bind:class="user && comment.user_id == user.id ? 'list-group-item comment comment-current-user' : 'list-group-item comment'"
        v-for="comment in comments"
        v-bind:key="comment.id"
      >
        <div
          class="comment-delete clickable"
          v-if="(user && comment.user_id == user.id) || isadmin"
          @click="deleteComment(comment.id)"
        >
          <i class="fas fa-trash-alt"></i>
        </div>
        <div class="comment-header">
          <div
            class="comment-avatar"
            v-bind:style="'backgroundImage: url(\'' + comment.user_avatar  + '\')'"
          ></div>

          <div class="comment-name">{{ comment.user_firstName + ' ' + comment.user_lastName }}</div>
        </div>
        <div class="comment-body">{{ comment.body }}</div>
        <div class="comment-meta text-right">
          <div class="time">
            <date-format v-bind:date="comment.created_at" v-bind:islong="true"></date-format>
          </div>
        </div>
      </li>
    </ul>
    <div class="row justify-content-center my-2 no-gutters">
      <div v-if="isLoading" class="loader loader-sm"></div>
      <button
        v-if="!isLoading"
        class="show-more"
        @click="showMore()"
        v-bind:disabled="currentPage == lastPage"
      >
        <div>
          <div v-if="currentPage != lastPage">Show More</div>
          <div v-if="currentPage == lastPage">No more comments available</div>
        </div>
      </button>
    </div>
  </div>
</template>

<script>
import LoginRequestModalVue from "./LoginRequestModal.vue";
export default {
  props: ["postid", "user", "isadmin", "nocomment"],

  data() {
    return {
      http: window.axios,
      isLoading: true,
      newCommentText: null,
      isLoggedIn: this.user,
      error: null,
      url: "/api/comment/" + this.postid,
      isProcessing: false,
      comments: [],
      currentPage: 1,
      lastPage: null
    };
  },

  methods: {
    async getData() {
      this.isLoading = true;
      try {
        const data = await this.http.get(
          this.url + "?page=" + this.currentPage
        );
        this.comments = this.comments.concat(data.data.data);
        this.lastPage = data.data.last_page;
        this.isLoading = false;
      } catch (error) {
        console.log(error);
        this.isLoading = false;
      }
    },

    async addComment() {
      this.error = null;
      if (!this.isLoggedIn) {
        this.$modal.show(LoginRequestModalVue, null, {
          height: "auto",
          adaptive: true
        });
        return;
      }
      if (!this.newCommentText) {
        this.error = "Please type a comment.";
        return;
      }
      if (this.newCommentText.length > 255) {
        this.error = "Comment cannot be greater than 255 charecters.";
        return;
      }
      if (this.isProcessing) {
        return;
      }
      try {
        this.isProcessing = true;
        const data = await this.http.post(this.url, {
          body: this.newCommentText
        });
        if (data.data) {
          this.comments.unshift(data.data);
        }
        this.isProcessing = false;
        this.newCommentText = null;
      } catch (error) {
        if (
          error &&
          error.response &&
          error.response.data &&
          error.response.data.body &&
          error.response.data.body.length > 0
        ) {
          this.error = error.response.data.body[0];
        } else {
          this.error = "Some error occured, please try again later.";
        }
        this.isProcessing = false;
      }
    },

    async deleteComment(id) {
      try {
        const data = await this.http.delete(this.url + "/" + id);
        this.comments = this.comments.filter(c => c.id != id);
      } catch (error) {
        console.log(error);
      }
    },

    showMore() {
      this.currentPage += 1;
      this.getData();
    }
  },

  created() {
    this.getData();
  }
};
</script>
