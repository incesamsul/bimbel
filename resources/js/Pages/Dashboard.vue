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
            <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>
            <p class="mb-4">Overview data member.</p>

            <div class="row">
                <template v-if="user.role == 'admin'">
                    <div class="col-sm-4 mt-3">
                        <div class="card border-0 pt-3">
                            <div class="card-body text-center">
                                <h1 class="fas fa-users"></h1>
                                <h4>Total Member</h4>
                                <h6>{{ member.length }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="card border-0 pt-3">
                            <div class="card-body text-center">
                                <h1 class="fas fa-chalkboard"></h1>
                                <h4>Total Paket</h4>
                                <h6>{{ total_paket.length }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="card border-0 pt-3">
                            <div class="card-body text-center">
                                <h1 class="fas fa-file-video"></h1>
                                <h4>Paket video</h4>
                                <h6>{{ total_paket_video.length }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="card border-0 pt-3">
                            <div class="card-body text-center">
                                <h1 class="fas fa-file-video"></h1>
                                <h4>Paket latihan</h4>
                                <h6>{{ total_paket_latihan.length }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="card border-0 pt-3">
                            <div class="card-body text-center">
                                <h1 class="fas fa-file"></h1>
                                <h4>Paket text</h4>
                                <h6>{{ total_paket_text.length }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <div class="card border-0 pt-3">
                            <div class="card-body text-center">
                                <h1 class="fas fa-file"></h1>
                                <h4>Total transaksi</h4>
                                <h6>Rp. {{ Number(totalTransaksi(total_transaksi)).toLocaleString() }}</h6>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-if="user.role == 'member'">
                    <div class="col-sm-4 mt-3">
                        <Link href="/member/paket_aktif" class="card border-0 pt-3">
                        <div class="card-body text-center">
                            <h1 class="fas fa-folder-open "></h1>
                            <h4>Paket saya</h4>
                            <h6>{{ paket_aktif.length }}</h6>
                        </div>
                        </Link>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <Link href="/member/paket" class="card border-0 pt-3">
                        <div class="card-body text-center">
                            <h1 class="fas fa-credit-card "></h1>
                            <h4>Beli Paket</h4>
                            <h6>{{ transaksi_paid.length }}</h6>
                        </div>
                        </Link>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <Link href="/member/pembayaran" class="card border-0 pt-3">
                        <div class="card-body text-center">
                            <h1 class="fas fa-credit-card "></h1>
                            <h4>Transaksi belum terbayar</h4>
                            <h6>{{ transaksi_unpaid.length }}</h6>
                        </div>
                        </Link>
                    </div>
                </template>
            </div>

        </div>


    </AuthenticatedLayout>
</template>

<script>



export default {
    props: {
        user: Object,
        segment_tryout: Object,
        paket_aktif: Object,
        transaksi_paid: Object,
        transaksi_unpaid: Object,
        member: Object,
        total_transaksi: Object,
        total_paket: Object,
        total_tryout: Object,
        total_latihan: Object,
        total_paket_video: Object,
        total_paket_text: Object,
        total_paket_latihan: Object,
        total_paket_soal: Object,
    },
    computed: {

    },
    methods: {
        totalTransaksi(transaksi) {
            let total = 0;
            transaksi.forEach(el => {
                total += parseInt(el.total_amount);
            });
            return total;
        }
    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });



    }
}
</script>
