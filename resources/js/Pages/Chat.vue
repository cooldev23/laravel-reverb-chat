<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ChatBox from '@/Components/ChatBox.vue';

const props = defineProps({
    receiver: Object,
    previousMessages: Array
})
</script>

<template>

    <Head title="Chat Room" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat Room</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ChatBox :user="receiver" :messages="previousMessages" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
