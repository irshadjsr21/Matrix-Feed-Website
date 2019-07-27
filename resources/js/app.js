/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
window.encodeCustom = function(str) {
  var enc = encodeURI(str.toLowerCase());
  return enc.replace(/%20/g, "+");
};
window.getUrlParameter = function(name) {
  name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
  var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
  var results = regex.exec(location.search);
  return results === null ? "" : decodeURI(results[1].replace(/\+/g, " "));
};

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

import VueTruncate from "vue-truncate-filter";
import VModal from "vue-js-modal";
import Showcase from "./components/PostShowcase";
import TimelinePost from "./components/TimelinePost";
import Timeline from "./components/Timeline";
import PostsDisplay from "./components/PostsDisplay";
import DateTimeFormat from "./components/DateTimeFormat";
import UserProfile from "./components/UserProfile";
import LikeComponent from "./components/LikeComponent";
import ClapIcon from "./components/ClapIcon";
import SetRedirect from "./components/SetRedirect";
import LoginRequestModal from "./components/LoginRequestModal";
import CommentsComponent from "./components/CommentsComponent";

Vue.use(VModal, { dynamic: true, injectModalsContainer: true });
Vue.use(VueTruncate);
Vue.component("post-showcase", Showcase);
Vue.component("timeline-post", TimelinePost);
Vue.component("timeline-list", Timeline);
Vue.component("date-format", DateTimeFormat);
Vue.component("posts-display", PostsDisplay);
Vue.component("user-profile", UserProfile);
Vue.component("like-component", LikeComponent);
Vue.component("clap-icon", ClapIcon);
Vue.component("set-redirect", SetRedirect);
Vue.component("login-modal", LoginRequestModal);
Vue.component("comments-component", CommentsComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: "#app"
});
