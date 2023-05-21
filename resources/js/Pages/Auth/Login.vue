<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>

        <Head title="Log in" />

        <form @submit.prevent="submit" class="user">
            <div class="form-group">
                <TextInput id="email" type="email" class="form-control form-control-user shadow-none" v-model="form.email"
                    required autofocus autocomplete="username" placeholder="masukkan email..." />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            <div class="form-group">
                <TextInput id="password" type="password" class="form-control form-control-user shadow-none"
                    v-model="form.password" required autocomplete="current-password" placeholder="masukkan password..." />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox small">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </div>
            </div>


            <PrimaryButton class="btn bg-main text-white btn-user btn-block mt-4" :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing">
                Log in
            </PrimaryButton>
            <hr>

            <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                        <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                        <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                    </a> -->
        </form>

        <div class="d-flex justify-content-between">
            <Link v-if="canResetPassword" :href="route('password.request')" class="small">
            Forgot your password?
            </Link>
            <Link v-if="canResetPassword" :href="'/register'" class="small">
            don't have an account?
            </Link>
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>


    </GuestLayout>
</template>

<style>
.bg-main {
    background: #EC407A !important;
}
</style>
