<script setup>
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from './PrimaryButton.vue';
import { PaperAirplaneIcon } from '@heroicons/vue/20/solid';
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import UserChatBubble from './UserChatBubble.vue';
import FriendChatBubble from './FriendChatBubble.vue';

const props = defineProps({
    user: Object,
    messages: Array
});

const emit = defineEmits(['store-chat']);

const newMessage = ref(''),
  allMessages = props.messages

function sendMessage() {
  if (newMessage.value.trim !== '') {
    postMessage();

    newMessage.value = '';
  }
}

function postMessage() {
  emit('store-chat');
}
</script>

<template>
  <div class="w-full">
    <p class="text-center text-xl font-medium">Chat with {{ user.name }}</p>
    <!-- v-for to iterate through messages -->
    <div v-for="message in allMessages" :key="message.id">
      <div v-if="message.sender_id === usePage().props.auth.user.id">
        <UserChatBubble :message />
      </div>
      <div v-else>
        <FriendChatBubble :message />
      </div>
    </div>
    <div class="flex">
      <TextInput class="w-full" v-model="newMessage" @keyup.enter="sendMessage" />
      <PrimaryButton class="ms-2" @click.enter="sendMessage">
        <PaperAirplaneIcon class="me-1 h-4 w-6 text-white" aria-hidden="true" />Send
      </PrimaryButton>
    </div>
  </div>
</template>
