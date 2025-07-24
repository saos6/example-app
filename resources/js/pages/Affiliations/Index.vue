<script setup>
import AuthenticatedLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    affiliations: Array,
});

const form = useForm({});

const deleteAffiliation = (id) => {
    if (confirm('本当に削除しますか？')) {
        form.delete(route('affiliations.destroy', id));
    }
};
</script>

<template>
    <Head title="所属一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">所属一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <Link :href="route('affiliations.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                新規登録
                            </Link>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名称</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">親所属</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="affiliation in affiliations" :key="affiliation.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ affiliation.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ affiliation.name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ affiliation.parent ? affiliation.parent.name : '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('affiliations.edit', affiliation.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">編集</Link>
                                        <button @click="deleteAffiliation(affiliation.id)" class="text-red-600 hover:text-red-900">削除</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
