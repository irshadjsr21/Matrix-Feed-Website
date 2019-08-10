<template>
  <div class="default-modal">
    <div class="top-right clickable" @click="$emit('close')">
      <i class="fas fa-times"></i>
    </div>
    <h3 class="title">Oops ! It seems that you aren't logged in.</h3>
    <div class="line"></div>
    <div class="text">To be able to like or comment on any of the post you need to login.</div>
    <div class="actions row justify-content-center align-items-center text-center">
      <div class="col">
        <a v-bind:href="'/login?redirect=' + encodeURI(url)" class="btn btn-lg btn-primary">Login</a>
      </div>
      <div class="col">
        <a
          v-bind:href="'/signup?redirect=' + encodeURI(url)"
          class="btn btn-lg btn-secondary"
        >Sign up</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      url: window.location.pathname
    };
  }
};
</script>

