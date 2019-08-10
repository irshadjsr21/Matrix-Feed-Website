<template>
  <form class="default-modal" action="/profile/avatar" method="POST" enctype="multipart/form-data">
    <div class="top-right clickable" @click="$emit('close')">
      <i class="fas fa-times"></i>
    </div>
    <h3 class="title">Update Your Avatar</h3>
    <div class="line"></div>
    <div class="text">
      <div class="row justify-content-center">
        <div class="avatar" v-bind:style="'backgroundImage: url(\'' + currentAvatar  + '\')'"></div>
      </div>
      <div class="form-group mt-2">
        <input type="hidden" name="_token" v-bind:value="csrf" />
        <input type="file" name="avatar" id="avatar" class="form-control-file" @change="onChange" />
      </div>
    </div>
    <div class="actions row justify-content-center align-items-center text-center">
      <div class="col">
        <button class="btn btn-lg btn-primary" type="submit">Update</button>
      </div>
    </div>
  </form>
</template>

<script>
export default {
  props: ["avatar"],

  data() {
    return {
      currentAvatar: this.avatar,
      csrf: window.token
    };
  },

  methods: {
    onChange(e) {
      if (e.target && e.target.files && e.target.files.length > 0) {
        const reader = new FileReader();

        const changeAvatar = this.changeAvatar;

        reader.onload = function(e) {
          changeAvatar(e.target.result);
        };

        reader.readAsDataURL(e.target.files[0]);
      }
    },

    changeAvatar(newAvatar) {
      this.currentAvatar = newAvatar;
    }
  }
};
</script>

