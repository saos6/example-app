<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Quotation } from '@/types';

defineProps<{
    quotations: Quotation[];
}>();
</script>

<template>
    <Head title="見積一覧" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">見積一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-start mb-4">
                            <Link :href="route('quotations.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                新規登録
                            </Link>
                            <a :href="route('quotations.export.excel')" class="ml-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                Export
                            </a>
                        </div>

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">顧客名</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">担当者名</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">見積日</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">合計金額</th>
                                    <th scope="col" class="relative px-6 py-3"><span class="sr-only">アクション</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="quotation in quotations" :key="quotation.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ quotation.id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ quotation.customer ? quotation.customer.name : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ quotation.person ? quotation.person.name : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ quotation.quotation_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ quotation.total_amount }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <Link :href="route('quotations.show', quotation.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">詳細</Link>
                                        <Link :href="route('quotations.edit', quotation.id)" class="text-indigo-600 hover:text-indigo-900 mr-4">編集</Link>
                                        <button @click="deleteQuotation(quotation.id)" class="text-red-600 hover:text-red-900">削除</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script lang="ts">
import { useForm } from '@inertiajs/vue3';

export default {
    methods: {
        deleteQuotation(id: number) {
            if (confirm('本当に削除しますか？')) {
                const form = useForm({});
                form.delete(route('quotations.destroy', id));
            }
        },
    },
};
</script>
