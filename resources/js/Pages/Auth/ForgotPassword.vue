<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Lupa password!</h1>
            <div class="mb-4 text-sm text-gray-600">
                Lupa password ? jangan khawatir, masukkan email anda untuk melakukan reset password
            </div>
        </div>
        <form @submit.prevent="submit" class="user">
            <div class="form-group">
                <TextInput id="email" type="email" class="form-control form-control-user" v-model="form.email" required
                    autofocus autocomplete="username" placeholder="masukkan email..." />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <PrimaryButton class="btn btn-primary btn-user btn-block" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                Email Password Reset Link
            </PrimaryButton>

            <hr>


        </form>
        <hr>
        <Link :href="route('login')" class="small text-center">
        Login
        </Link>
        <!-- <div class="text-center">
            <a class="small" href="register.html">Create an Account!</a>
        </div> -->

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>


    </GuestLayout>
</template>
