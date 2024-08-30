<script setup>
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object
})
</script>

<template>
  <div class="w-full">
    <p class="text-center text-xl font-medium">Chat with {{ user.name }}</p>
    <!-- UserChatBubble -->
     <!-- FriendChatBubble -->
    <TextInput class="w-full"/>
  </div>
</template>

<style>
  
</style>