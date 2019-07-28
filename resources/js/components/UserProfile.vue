<template>
  <div>
    <!-- Details Section starts here -->
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>My Details</h4>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <label for="firstName" class="mb-2 col-md-2 col-4 col-form-label">First Name</label>

              <div class="mb-2 col-md-6 col-12">
                <input
                  id="firstName"
                  type="text"
                  class="form-control"
                  name="firstName"
                  v-model="firstName.value"
                  v-bind:disabled="!firstName.isEditing"
                />
                <span
                  v-if="firstName.error"
                  class="invalid-feedback"
                  style="display:block;"
                  role="alert"
                >
                  <strong>{{ firstName.error }}</strong>
                </span>
              </div>

              <div class="col-md-4 col-6 mb-2">
                <div class="row">
                  <div class="col" v-if="!firstName.isEditing">
                    <button class="btn btn-info" v-on:click="edit(firstName)">Edit</button>
                  </div>
                  <div class="col" v-if="firstName.isEditing">
                    <button class="btn btn-danger" v-on:click="cancle(firstName)">Cancle</button>
                  </div>
                  <div class="col" v-if="firstName.isEditing" v-on:click="save(firstName)">
                    <button
                      class="btn btn-primary btn-loader-container"
                      v-bind:disabled="firstName.isLoading"
                    >
                      <span class="btn-loader" v-if="firstName.isLoading"></span>
                      <span>Save</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="lastName" class="mb-2 col-md-2 col-4 col-form-label">Last Name</label>

              <div class="mb-2 col-md-6 col-12">
                <input
                  id="lastName"
                  type="text"
                  class="form-control"
                  name="lastName"
                  v-model="lastName.value"
                  v-bind:disabled="!lastName.isEditing"
                />
                <span
                  v-if="lastName.error"
                  class="invalid-feedback"
                  style="display:block;"
                  role="alert"
                >
                  <strong>{{ lastName.error }}</strong>
                </span>
              </div>

              <div class="col-md-4 col-6 mb-2">
                <div class="row">
                  <div class="col" v-if="!lastName.isEditing">
                    <button class="btn btn-info" v-on:click="edit(lastName)">Edit</button>
                  </div>
                  <div class="col" v-if="lastName.isEditing">
                    <button class="btn btn-danger" v-on:click="cancle(lastName)">Cancle</button>
                  </div>
                  <div class="col" v-if="lastName.isEditing" v-on:click="save(lastName)">
                    <button
                      class="btn btn-primary btn-loader-container"
                      v-bind:disabled="lastName.isLoading"
                    >
                      <span class="btn-loader" v-if="lastName.isLoading"></span>
                      <span>Save</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="mb-2 col-md-2 col-4 col-form-label">Email</label>

              <div class="mb-2 col-md-6 col-12">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  v-model="email.value"
                  v-bind:disabled="!email.isEditing"
                />
                <span
                  v-if="email.error"
                  class="invalid-feedback"
                  style="display:block;"
                  role="alert"
                >
                  <strong>{{ email.error }}</strong>
                </span>
              </div>

              <div class="col-md-4 col-6 mb-2">
                <div class="row">
                  <div class="col" v-if="!email.isEditing">
                    <button class="btn btn-info" v-on:click="edit(email)">Edit</button>
                  </div>
                  <div class="col" v-if="email.isEditing">
                    <button class="btn btn-danger" v-on:click="cancle(email)">Cancle</button>
                  </div>
                  <div class="col" v-if="email.isEditing" v-on:click="save(email)">
                    <button
                      class="btn btn-primary btn-loader-container"
                      v-bind:disabled="email.isLoading"
                    >
                      <span class="btn-loader" v-if="email.isLoading"></span>
                      <span>Save</span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Details Section ends here -->

    <!-- Change password starts -->
    <div class="mt-4 row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>Change Password</h4>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <label for="password" class="mb-2 col-md-4 col-12 col-form-label">Password</label>
              <div class="mb-2 col-md-6 col-12">
                <input
                  id="password"
                  type="password"
                  class="form-control"
                  name="password"
                  v-model="passForm.password"
                />
              </div>
            </div>
            <div class="form-group row">
              <label for="newPassword" class="mb-2 col-md-4 col-12 col-form-label">New Password</label>
              <div class="mb-2 col-md-6 col-12">
                <input
                  id="newPassword"
                  type="password"
                  class="form-control"
                  name="newPassword"
                  v-model="passForm.newPassword"
                />
              </div>
            </div>
            <div class="form-group row">
              <label
                for="confirmPassword"
                class="mb-2 col-md-4 col-12 col-form-label"
              >Confirm Password</label>
              <div class="mb-2 col-md-6 col-12">
                <input
                  id="confirmPassword"
                  type="password"
                  class="form-control"
                  name="confirmPassword"
                  v-model="passForm.confirmPassword"
                />
              </div>
            </div>

            <div v-for="error in passForm.errors" v-bind:key="error" class="row mb-2">
              <div class="offset-md-4 col-md-4 col-12">
                <div>
                  <span class="invalid-feedback" style="display:block;" role="alert">
                    <strong>{{ error }}</strong>
                  </span>
                </div>
              </div>
            </div>

            <div class="row mb-2" v-if="passForm.success">
              <div class="offset-md-4 col-md-4 col-12">
                <div class="alert alert-success">{{ passForm.success }}</div>
              </div>
            </div>

            <div class="row">
              <div class="offset-md-4 col-md-4 col-12">
                <button class="btn btn-primary btn-loader-container" v-on:click="changePass()">
                  <span class="btn-loader" v-if="passForm.isLoading"></span>
                  <span>Change Password</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Change password ends -->
  </div>
</template>

<script>
import axios from "axios";
import { isArray, isString } from "util";
export default {
  props: ["user"],
  data() {
    return {
      id: this.user.id,
      originalUser: this.user,
      firstName: {
        name: "firstName",
        value: this.user.firstName,
        isEditing: false,
        isLoading: false,
        error: null,
        url: "/api/profile"
      },
      lastName: {
        name: "lastName",
        value: this.user.lastName,
        isLoading: false,
        isEditing: false,
        error: null,
        url: "/api/profile"
      },
      email: {
        name: "email",
        value: this.user.email,
        isLoading: false,
        isEditing: false,
        error: null,
        url: "/api/profile/email"
      },
      passForm: {
        password: null,
        newPassword: null,
        confirmPassword: null,
        errors: [],
        isLoading: null,
        success: null
      },
      http: window.axios
    };
  },
  methods: {
    edit(field) {
      field.isEditing = true;
    },
    cancle(field) {
      field.value = this.originalUser[field.name];
      field.isEditing = false;
    },
    async save(field) {
      this.clearError();
      this[field.name].isLoading = true;
      try {
        const data = await this.http.patch(field.url, {
          [field.name]: field.value
        });
        const dta = data.data;
        this[field.name].value = dta[field.name];
        this[field.name].isLoading = false;
        this[field.name].isEditing = false;
        this.originalUser = dta;
      } catch (error) {
        console.log(error);
        this[field.name].isLoading = false;
        this[field.name].isEditing = false;
        this[field.name].value = this.originalUser[field.name];
        const errorMsg =
          error.response && error.response.data
            ? error.response.data[field.name]
            : null;
        this[field.name].error =
          isArray(errorMsg) && errorMsg.length > 0
            ? errorMsg[0]
            : errorMsg
            ? errorMsg
            : "Some error occured.";
      }
    },
    clearError() {
      this.firstName.error = null;
      this.lastName.error = null;
      this.email.error = null;
    },
    async changePass() {
      this.passForm.errors = [];
      this.passForm.success = null;
      this.passForm.isLoading = true;
      if (!this.passForm.password) {
        this.passForm.errors.push("Password is required.");
      }
      if (!this.passForm.newPassword) {
        this.passForm.errors.push("New Password is required.");
      }
      if (this.passForm.confirmPassword != this.passForm.newPassword) {
        this.passForm.errors.push(
          "New Password does not match with confirm password."
        );
      }

      if (this.passForm.errors.length > 0) {
        this.passForm.isLoading = false;
        return;
      }

      try {
        const data = await this.http.post("/api/profile/password", {
          password: this.passForm.password,
          newPassword: this.passForm.newPassword,
          confirmPassword: this.passForm.confirmPassword
        });
        this.passForm.success = "Password changed successfully";
        this.passForm.isLoading = false;
        this.clearPassForm();
      } catch (error) {
        if (error.response && error.response.data) {
          for (const obj in error.response.data) {
            if (
              isArray(error.response.data[obj]) &&
              error.response.data[obj].length > 0
            )
              this.passForm.errors.push(error.response.data[obj][0]);
            else if (isString(error.response.data[obj])) {
              this.passForm.errors.push(error.response.data[obj]);
            }
          }
        } else {
          console.log(error);
          this.passForm.errors.push("Some error occured.");
        }
      }
      this.passForm.isLoading = false;
    },
    clearPassForm() {
      this.passForm.password = this.passForm.newPassword = this.passForm.confirmPassword = null;
    }
  },
};
</script>
