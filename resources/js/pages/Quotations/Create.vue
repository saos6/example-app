<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Customer, Person, Product } from '@/types';
import { ref, computed } from 'vue';

const props = defineProps<{
    customers: Customer[];
    people: Person[];
    products: Product[];
}>();

const form = useForm({
    customer_id: '',
    person_id: '',
    quotation_date: new Date().toISOString().slice(0, 10),
    items: [] as { product_id: string; quantity: number; unit_price: number }[],
});

const addQuotationItem = () => {
    form.items.push({ product_id: '', quantity: 1, unit_price: 0 });
};

const removeQuotationItem = (index: number) => {
    form.items.splice(index, 1);
};

const updateUnitPrice = (index: number) => {
    const selectedProduct = props.products.find(p => p.id === parseInt(form.items[index].product_id));
    if (selectedProduct) {
        form.items[index].unit_price = selectedProduct.price;
    }
};

const submit = () => {
    form.post(route('quotations.store'));
};
</script>

<template>
    <Head title="見積登録" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">見積登録</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div class="mb-4">
                                <Label for="customer_id">顧客名</Label>
                                <select
                                    id="customer_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.customer_id"
                                    required
                                >
                                    <option value="">顧客を選択</option>
                                    <option v-for="customer in customers" :key="customer.id" :value="customer.id">
                                        {{ customer.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.customer_id" />
                            </div>

                            <div class="mb-4">
                                <Label for="person_id">担当者名</Label>
                                <select
                                    id="person_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.person_id"
                                    required
                                >
                                    <option value="">担当者を選択</option>
                                    <option v-for="person in people" :key="person.id" :value="person.id">
                                        {{ person.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.person_id" />
                            </div>

                            <div class="mb-4">
                                <Label for="quotation_date">見積日</Label>
                                <Input
                                    id="quotation_date"
                                    type="date"
                                    class="mt-1 block w-full"
                                    v-model="form.quotation_date"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.quotation_date" />
                            </div>

                            <h3 class="text-lg font-semibold mt-6 mb-4">見積明細</h3>
                            <div v-for="(item, index) in form.items" :key="index" class="grid grid-cols-5 gap-4 mb-4 p-4 border rounded-lg">
                                <div>
                                    <Label :for="`product_id_${index}`">商品</Label>
                                    <select
                                        :id="`product_id_${index}`"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        v-model="item.product_id"
                                        @change="updateUnitPrice(index)"
                                        required
                                    >
                                        <option value="">商品を選択</option>
                                        <option v-for="product in products" :key="product.id" :value="product.id">
                                            {{ product.name }}
                                        </option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors[`items.${index}.product_id`]" />
                                </div>
                                <div>
                                    <Label :for="`quantity_${index}`">数量</Label>
                                    <Input
                                        :id="`quantity_${index}`"
                                        type="number"
                                        class="mt-1 block w-full"
                                        v-model="item.quantity"
                                        required
                                        min="1"
                                    />
                                    <InputError class="mt-2" :message="form.errors[`items.${index}.quantity`]" />
                                </div>
                                <div>
                                    <Label :for="`unit_price_${index}`">単価</Label>
                                    <Input
                                        :id="`unit_price_${index}`"
                                        type="number"
                                        class="mt-1 block w-full"
                                        v-model="item.unit_price"
                                        required
                                        min="0"
                                    />
                                    <InputError class="mt-2" :message="form.errors[`items.${index}.unit_price`]" />
                                </div>
                                <div>
                                    <Label>金額</Label>
                                    <p class="mt-1 block w-full text-gray-700">{{ item.quantity * item.unit_price }}</p>
                                </div>
                                <div class="flex items-end">
                                    <Button type="button" @click="removeQuotationItem(index)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        削除
                                    </Button>
                                </div>
                            </div>

                            <Button type="button" @click="addQuotationItem" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mt-4">
                                明細追加
                            </Button>

                            <div class="flex items-center justify-end mt-4">
                                <Button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    登録
                                </Button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
