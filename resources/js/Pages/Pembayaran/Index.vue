<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head } from '@inertiajs/vue3';
import { showFlashMessage } from '@/global_func.js';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 main-color">Pilih metode pembayaran</h1>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Channel pembayaran</h6>
                            <Link href="/member/paket" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 mt-3">
                    <div class="card border-0 p-5">
                        <h2><strong>{{ paket.nama_paket }}</strong></h2>
                        <h4 class="main-color"><strong>Rp. {{ Number(paket.harga).toLocaleString() }}</strong></h4>
                        <div class="list mt-3">
                            <p v-for="paket in listPaket(paket.list_paket)"><i class="fas fa-check text-success"></i> {{
                                paket }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <template v-if="loading">
                        <div class="row">
                            <div class="col-sm-12 mt-3 cursor-pointer">
                                <div class="card border-0 hovered-item">
                                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                        <h1 class="fas fa-circle-notch fa-spin"></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div class="row" v-else>
                        <div @click="requestPembayaran(channel.code)" class="col-sm-3 mt-3 cursor-pointer"
                            v-for="channel in channels">
                            <div class="card border-0 hovered-item">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <img :src="channel.icon_url" alt="" width="100">
                                    <div class="mt-4">
                                        <p class="mb-0"><small>{{ channel.name }} </small></p>
                                        <p class="my-0"><small>{{ channel.code }} </small></p>
                                        <p class="my-0"><small>Biaya : Rp. {{
                                            Number(channel.fee_customer.flat).toLocaleString()
                                        }} </small></p>
                                    </div>

                                </div>
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
        paket: Object,
    },
    data() {
        return {
            loading: false,
        };
    },

    methods: {
        listPaket(paket) {
            return paket.split(',');
        },
        requestPembayaran(metode_pembayaran) {
            this.loading = true;
            const formData = {
                // produk
                method: metode_pembayaran,
                total_pembayaran: this.paket.harga,
                id_paket: this.paket.id,

            }
            axios.post('/member/request_pembayaran', formData)
                .then(response => {
                    // Handle success response
                    console.log(response);
                    showFlashMessage(response.data.message);
                    this.$inertia.visit('/member/detail_transaksi/' + response.data.reference);
                })
                .catch(error => {
                    // Handle error response
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });

        },


    },
}
</script>
