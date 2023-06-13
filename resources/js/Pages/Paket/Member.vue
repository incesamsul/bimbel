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
                <div class="col-sm-4" v-for="item in paket">
                    <div class="card border-0 p-5">
                        <h2><strong>{{ item.nama_paket }}</strong></h2>
                        <h4 class="main-color"><strong>Rp. {{ Number(item.harga).toLocaleString() }}</strong></h4>
                        <div class="list mt-3">
                            <p><i class="fas fa-check text-success"></i> video
                            </p>
                        </div>
                        <div>
                            <span class="btn btn-primary cursor-pointer ml-2">
                                <i class="fab fa-telegram-plane"></i>
                                Telegram
                            </span>
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
        paket: Object,
    }
}
</script>
