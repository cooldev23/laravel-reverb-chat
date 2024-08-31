<script setup>
const props = defineProps({
  message: Object
});
</script>

<template>
  <p class="p-2 ml-auto text-white bg-blue-500 rounded-lg min-w-48 max-w-72 shadow-md">{{ message.text }}</p>
</template>
