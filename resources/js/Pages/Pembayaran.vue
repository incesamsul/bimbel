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
                <h1 class="h3 mb-0 main-color">pembayaran</h1>
            </div>
            <div class="row">
                <div class="col-sm-3 mt-3" v-for="channel in channels">
                    <div class="card border-0">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <img :src="channel.icon_url" alt="" width="100">
                            <div class="mt-4">
                                <p class="mb-0"><small>{{ channel.name }} </small></p>
                                <p class="my-0"><small>{{ channel.code }} </small></p>
                                <p class="my-0"><small>Biaya : {{ channel.fee_merchant.flat }} </small></p>
                            </div>

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
        user: Object,
        channels: Object,
    }
}
</script>
