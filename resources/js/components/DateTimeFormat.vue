<template>
  <span>{{ formattedDate }}</span>
</template>

<script>
import moment from "moment";

export default {
  props: ["date"],
  data() {
    return {
      formattedDate: null
    };
  },
  created() {
    this.formattedDate = moment(this.date).format("MMM D");
  }
};
</script>


