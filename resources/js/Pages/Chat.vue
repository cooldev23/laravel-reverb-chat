<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router, usePage } from '@inertiajs/vue3';
import { nextTick, onMounted, ref, watch } from 'vue';
import UserChatBubble from '@/Components/UserChatBubble.vue';
import FriendChatBubble from '@/Components/FriendChatBubble.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { PaperAirplaneIcon } from '@heroicons/vue/20/solid';

const props = defineProps({
    receiver: Object,
    messages: Array
});

const allMessages = props.messages,
    newMessage = ref(''),
    messageContainer = ref(null),
    isFriendTyping = ref(false),
    isFriendTypingTimer = ref(null);

watch(allMessages, () => {
    nextTick(() => {
        messageContainer.value.scrollTo({
            top: messageContainer.value.scrollHeight,
            behavior: 'smooth'
        })
    });
}, { deep: true });

function sendMessage() {
    if (newMessage.value.trim !== '') {
        allMessages.push({
            text: newMessage.value,
            sender_id: usePage().props.auth.user.id,
            receiver_id: props.receiver.id
        })
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

function sendTypingEvent() {
    Echo.private(`chat.${props.receiver.id}`)
        .whisper('typing', {
            userId: usePage().props.auth.user.id
        })
}

onMounted(() => {
    Echo.private(`chat.${usePage().props.auth.user.id}`)
        .listen('MessageSent', (response) => {
            allMessages.push(response.message);
        })
        .listenForWhisper('typing', (response) => {
            isFriendTyping.value = response.userId === props.receiver.id;

            if (isFriendTypingTimer.value) {
                clearTimeout(isFriendTypingTimer.value);
            }

            isFriendTypingTimer.value = setTimeout(() => {
                isFriendTyping.value = false;
            }, 1000)
        });
})
</script>

<template>
    <Head title="Chat Room" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat Room</h2>
        </template>

        <div class="py-12" @store-chat="storeChat">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div ref="messageContainer" class="bg-white overflow-auto shadow-md sm:rounded-lg max-h-96">
                    <div class="p-6 text-gray-900">
                        <div class="w-full">
                            <p class="text-center text-xl font-medium">Chat with {{ receiver.name }}</p>
                            <!-- v-for to iterate through messages -->
                            <div v-for="message in allMessages" :key="message.id">
                                <div v-if="message.sender_id === usePage().props.auth.user.id" class="mb-2">
                                    <UserChatBubble :message />
                                </div>
                                <div v-else class="mb-2">
                                    <FriendChatBubble :message />
                                </div>
                            </div>
                            <div class="mt-3 flex">
                                <TextInput class="w-full" v-model="newMessage" @keyup.enter="sendMessage" @keydown="sendTypingEvent" />
                                <PrimaryButton class="ms-2" @click.enter="sendMessage">
                                    <PaperAirplaneIcon class="me-1 h-4 w-6 text-white" aria-hidden="true" />Send
                                </PrimaryButton>
                            </div>
                            <small v-if="isFriendTyping" class="text-gray-700">
                                {{ receiver.name }} is typing...
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
