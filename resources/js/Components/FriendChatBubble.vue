<script setup>
const props = defineProps({
  message: Object
});
</script>

<template>
  <p class="p-2 mr-auto text-white bg-green-500 rounded-lg min-w-48 max-w-72">{{ message.text }}</p>
</template>