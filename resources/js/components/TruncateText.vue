<template>
  <span>{{ text | truncate(len)}}</span>
</template>

<script>
export default {
  props: ["text", "len"]
};
</script>

