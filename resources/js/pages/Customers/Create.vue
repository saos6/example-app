<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Person } from '@/types';

defineProps<{
    people: Person[];
}>();

const form = useForm({
    name: '',
    email: '',
    people_id: '',
});

const submit = () => {
    form.post(route('customers.store'));
};
</script>

<template>
    <Head title="Create Customer" />

    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Customer</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <form @submit.prevent="submit">
                            <div>
                                <Label for="name">顧客名</Label>
                                <Input
                                    id="name"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="mt-4">
                                <Label for="email">メールアドレス</Label>
                                <Input
                                    id="email"
                                    type="email"
                                    class="mt-1 block w-full"
                                    v-model="form.email"
                                    required
                                    autocomplete="email"
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <Label for="people_id">担当者</Label>
                                <select
                                    id="people_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    v-model="form.people_id"
                                    required
                                >
                                    <option value="">Select a person</option>
                                    <option v-for="person in people" :key="person.id" :value="person.id">
                                        {{ person.name }}
                                    </option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.people_id" />
                            </div>

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
