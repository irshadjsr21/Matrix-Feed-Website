<template>
  <span>{{ formattedDate }}</span>
</template>

<script>
import moment from "moment";

export default {
  props: ["date", "islong"],
  data() {
    return {
      formattedDate: null
    };
  },
  created() {
    if (this.islong) {
      this.formattedDate = moment(this.date).format("LLL");
    } else {
      this.formattedDate = moment(this.date).format("MMM D");
    }
  }
};
</script>


