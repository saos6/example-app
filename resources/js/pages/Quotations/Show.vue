<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Quotation } from '@/types';

defineProps<{
    quotation: Quotation;
}>();
</script>

<template>
    <Head title="見積詳細" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">見積詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="mb-4">
                            <strong>ID:</strong> {{ quotation.id }}
                        </div>
                        <div class="mb-4">
                            <strong>顧客名:</strong> {{ quotation.customer ? quotation.customer.name : 'N/A' }}
                        </div>
                        <div class="mb-4">
                            <strong>担当者名:</strong> {{ quotation.person ? quotation.person.name : 'N/A' }}
                        </div>
                        <div class="mb-4">
                            <strong>見積日:</strong> {{ quotation.quotation_date }}
                        </div>
                        <div class="mb-4">
                            <strong>合計金額:</strong> {{ quotation.total_amount }}
                        </div>

                        <h3 class="text-lg font-semibold mt-6 mb-4">見積明細</h3>
                        <table class="min-w-full divide-y divide-gray-200 mb-4">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">商品名</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">数量</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">単価</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">小計</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="item in quotation.quotation_items" :key="item.id">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.product ? item.product.name : 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.quantity }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.unit_price }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ item.quantity * item.unit_price }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-end">
                            <Link :href="route('quotations.edit', quotation.id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                編集
                            </Link>
                            <Link :href="route('quotations.index')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                一覧に戻る
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
