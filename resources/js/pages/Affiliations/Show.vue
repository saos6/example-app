<script setup>
import AuthenticatedLayout from '@/Layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    affiliation: Object,
});
</script>

<template>
    <Head title="所属詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">所属詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">ID:</label>
                            <p class="mt-1 text-lg">{{ affiliation.id }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">名称:</label>
                            <p class="mt-1 text-lg">{{ affiliation.name }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">親所属:</label>
                            <p class="mt-1 text-lg">{{ affiliation.parent ? affiliation.parent.name : '-' }}</p>
                        </div>

                        <div class="mt-6">
                            <Link :href="route('affiliations.edit', affiliation.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                編集
                            </Link>
                            <Link :href="route('affiliations.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                戻る
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
