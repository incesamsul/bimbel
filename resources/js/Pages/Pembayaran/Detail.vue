<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, Head } from '@inertiajs/vue3';

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
                            <h6 class="m-0 font-weight-bold text-">Detail Transaksi #{{ detail_transaksi.reference }}</h6>
                            <Link href="/member/pembayaran" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 mt-3">
                    <div class="card border-0 ">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h1>Rp. {{ Number(detail_transaksi.amount).toLocaleString() }}</h1>
                            <table width="400" cellspacing="0" cellpadding="10" class="mt-3">
                                <tr>
                                    <td>payment method</td>
                                    <td>:</td>
                                    <td>{{ detail_transaksi.payment_method }}</td>
                                </tr>
                                <tr>
                                    <td>payment name</td>
                                    <td>:</td>
                                    <td>{{ detail_transaksi.payment_name }}</td>
                                </tr>
                                <tr>
                                    <td>Customer name</td>
                                    <td>:</td>
                                    <td>{{ detail_transaksi.customer_name }}</td>
                                </tr>
                                <tr>
                                    <td>Biaya merchant</td>
                                    <td>:</td>
                                    <td>{{ Number(detail_transaksi.fee_merchant).toLocaleString() }}</td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>:</td>
                                    <td><span class="badge"
                                            :class="{ 'badge-success': detail_transaksi.status == 'PAID', 'badge-danger': detail_transaksi.status == 'UNPAID' }">{{
                                                detail_transaksi.status }}</span></td>
                                </tr>
                                <tr>
                                    <td>Expired time</td>
                                    <td>:</td>
                                    <td>{{ formatDateTime(detail_transaksi.expired_time) }}</td>
                                </tr>
                                <tr>
                                    <td>Qr</td>
                                    <td>:</td>
                                    <td>
                                        <img :src="detail_transaksi.qr_url" alt="" width="200">
                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mt-3">
                    <div class="card border-0 p-5">
                        <h2><strong>Instruksi Pembayaran</strong></h2>
                        <div class="list mt-3">
                            <div class="accordion" id="accordionExample">
                                <div class="card" v-for="(instruksi, index) in detail_transaksi.instructions" :key="index">
                                    <div class="card-header" :id="'heading' + index">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link btn-block text-left" type="button"
                                                data-toggle="collapse" :data-target="'#collapse' + index"
                                                :aria-expanded="index === 0 ? 'true' : 'false'"
                                                :aria-controls="'collapse' + index">
                                                {{ instruksi.title }}
                                            </button>
                                        </h2>
                                    </div>
                                    <div :id="'collapse' + index" class="collapse" :class="{ 'show': index === 0 }"
                                        :aria-labelledby="'heading' + index" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ol>
                                                <li v-for="step in instruksi.steps" v-html="step"></li>
                                            </ol>
                                        </div>
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
        detail_transaksi: Object,
        paket: Object,
    },

    methods: {
        formatDateTime(timestamp) {
            const timestampInMillis = timestamp * 1000; // Convert to milliseconds
            const date = new Date(timestampInMillis);
            const formattedDate = date.toLocaleDateString(); // Format the date portion
            const formattedTime = date.toLocaleTimeString(); // Format the time portion
            return this.formattedDateTime = `${formattedDate} ${formattedTime}`;
        },
        requestPembayaran(metode_pembayaran) {
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
                    // showFlashMessage(response.data.message);
                    // this.$inertia.visit(route('paket'));

                })
                .catch(error => {
                    // Handle error response
                    console.error(error);
                });

        },


    },
}
</script>
