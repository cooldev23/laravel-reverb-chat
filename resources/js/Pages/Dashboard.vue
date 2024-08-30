<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Card from '@/Components/Card.vue';
import PrimaryOutlineButton from '@/Components/PrimaryOutlineButton.vue';

const props = defineProps({
    users: Array
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 grid grid-cols-1 sm:grid-cols-3">
                        <Card v-for="user in users" :key="user.id" class="mx-auto mb-3 max-w-screen sm:w-72" :footer="true" :header="false" :cta="false" header-alignment="center">
                            <template #body>
                                <p>{{ user.name }}</p>
                                <p>{{ user.email }}</p>
                            </template>
                            <template #footer>
                                <PrimaryOutlineButton><Link :href="route('chat', user)">Chat</Link></PrimaryOutlineButton>
                            </template>
                        </Card>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
