<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 main-color">Bantuan</h1>
            </div>

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12">
                    <div class="card border-0  mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header bg-white py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Butuh bantuan ?</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <p>docs</p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: {
        user: Object
    }
}
</script>
