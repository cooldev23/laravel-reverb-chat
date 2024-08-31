<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';
import UserChatBubble from '@/Components/UserChatBubble.vue';
import FriendChatBubble from '@/Components/FriendChatBubble.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { PaperAirplaneIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    receiver: Object,
    messages: Array
});

const newMessage = ref('');

function sendMessage() {
    if (newMessage.value.trim !== '') {
        postMessage();

        newMessage.value = '';
    }
}

function postMessage() {
    router.post('/chat/' + props.receiver.id, {
        message: newMessage.value,
        senderId: usePage().props.auth.user.id,
        receiverId: props.receiver.id
    });
}
</script>

<template>

    <Head title="Chat Room" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat Room</h2>
        </template>

        <div class="py-12" @store-chat="storeChat">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="w-full">
                            <p class="text-center text-xl font-medium">Chat with {{ receiver.name }}</p>
                            <!-- v-for to iterate through messages -->
                            <div v-for="message in messages" :key="message.id">
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
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
