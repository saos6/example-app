<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    person: Object,
});
</script>

<template>
    <Head title="担当者詳細" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">担当者詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">ID:</label>
                            <p class="mt-1 text-lg">{{ person.id }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">氏名:</label>
                            <p class="mt-1 text-lg">{{ person.name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">メールアドレス:</label>
                            <p class="mt-1 text-lg">{{ person.email }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">所属:</label>
                            <p class="mt-1 text-lg">{{ person.affiliation ? person.affiliation.name : '-' }}</p>
                        </div>

                        <div class="mt-6">
                            <Link :href="route('people.edit', person.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                編集
                            </Link>
                            <Link :href="route('people.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                戻る
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
