<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    whatsapp: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Register" />

        <form @submit.prevent="submit" class="auth">
            <div class="form-group">
                <InputLabel for="name" value="Name" />

                <TextInput id="name" type="text" class="form-control form-control-user shadow-none" v-model="form.name"
                    required autofocus autocomplete="name" />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="form-group">
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="form-control form-control-user shadow-none" v-model="form.email"
                    required autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="form-group">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="form-control form-control-user shadow-none"
                    v-model="form.password" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="form-group">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput id="password_confirmation" type="password" class="form-control form-control-user shadow-none"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="form-group">
                <InputLabel for="whatsapp" value="Nomor whatsapp" />

                <TextInput id="whatsapp" type="text" class="form-control form-control-user shadow-none"
                    v-model="form.whatsapp" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.whatsapp" />
            </div>

            <div class="flex items-center justify-end">
                <Link :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <small>Sudah punya akun ?</small>
                </Link>

                <PrimaryButton class="btn bg-main text-white btn-user btn-block mt-4"
                    :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Daftar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>


<style>
.bg-main {
    background-color: #EC407A !important;
}
</style>
