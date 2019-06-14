<template>
  <div class="py-4">
    <form action="/admin/login" method="post" @submit="submitForm">
      <div class="form-group">
        <label for="email">Email address</label>
        <input
          type="email"
          class="form-control"
          id="email"
          v-model="email.value"
          v-bind:class="email.error ? 'is-invalid': ''"
          placeholder="Enter email"
        >
        <small class="text-danger" v-if="email.error">{{ email.error }}</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input
          type="password"
          class="form-control"
          id="password"
          v-model="password.value"
          v-bind:class="password.error ? 'is-invalid': ''"
          placeholder="Password"
        >
        <small class="text-danger" v-if="password.error">{{ password.error }}</small>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
export default {
  methods: {
    submitForm: function(e) {
      e.preventDefault();
      if (this.checkForm()) {
      }
    },

    checkForm: function() {
      const email = this.checkEmail();
      const password = this.checkPassword();
      return email || password;
    },

    checkEmail: function(e) {
      if (!this.validEmail(this.email.value)) {
        this.email.error = "Invalid Email";
        return true;
      }

      return false;
    },

    checkPassword: function(e) {
      console.log("S");
      if (!this.validPassword(this.password.value)) {
        this.password.error = "Password is required";
        return true;
      }

      return false;
    },

    validEmail: function(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },

    validPassword: function(password) {
      return password;
    }
  },
  data() {
    return {
      email: {
        value: null,
        error: null
      },
      password: {
        value: null,
        error: null
      }
    };
  }
};
</script>
