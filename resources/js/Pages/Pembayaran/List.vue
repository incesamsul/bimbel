<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { showFlashMessage } from '@/global_func.js';




</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Data transaksi</h1>
            <p class="mb-4">Semua data transaksi ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Paket</th>
                                    <th>Reference</th>
                                    <th>status</th>
                                    <th>Amount</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="transaksi in transaksi">
                                    <td>{{ transaksi.id }}</td>
                                    <td>{{ transaksi.paket.nama_paket }}</td>
                                    <td>{{ transaksi.reference }}</td>
                                    <td>
                                        <span class="badge"
                                            :class="{ 'badge-success': transaksi.status == 'paid', 'badge-danger': transaksi.status == 'unpaid' }">{{
                                                transaksi.status }}</span>
                                    </td>
                                    <td>Rp. {{ Number(transaksi.total_amount).toLocaleString() }}</td>
                                    <td>
                                        <Link :href="'/member/detail_transaksi/' + transaksi.reference">
                                        Lihat
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        transaksi: Object,
    },
    computed: {

    },
    methods: {

    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
