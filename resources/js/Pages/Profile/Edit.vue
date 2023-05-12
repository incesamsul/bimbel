<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    user: {
        type: Object,
    }
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout :user="user">

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 p-3">
                        <div class="card-body">
                            <UpdateProfileInformationForm :must-verify-email="mustVerifyEmail" :status="status"
                                class="max-w-xl" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card border-0 p-3">
                        <div class="card-body">
                            <UpdatePasswordForm class="max-w-xl" />
                        </div>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card border-0 p-5">
                        <DeleteUserForm class="max-w-xl" />
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

