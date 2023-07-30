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
                <h1 class="h3 mb-0 main-color">Daftar Paket tersedia</h1>
            </div>
            <div class="row">
                <div class="col-sm-4" v-for="item in paket">
                    <div class="card border-0 p-5">
                        <span class="mb-3 badge badge-primary">{{ paket_saya.length > 0 ? 'Diskon alumni ' + diskon + '%' :
                            '' }}</span>
                        <h2><strong>{{ item.nama_paket }}</strong></h2>
                        <template v-if="paket_saya.length > 0">
                            <p class="text-secondary"><s><strong>Rp. {{
                                Number(item.harga).toLocaleString()
                            }}</strong></s>
                            </p>
                            <h4 class="main-color"><strong>Rp. {{
                                Number(item.harga - (item.harga * diskon / 100)).toLocaleString()
                            }}</strong>
                            </h4>

                        </template>
                        <h4 v-else class="main-color"><strong>Rp. {{ Number(item.harga).toLocaleString()
                        }}</strong>
                        </h4>
                        <div class="list mt-3">
                            <p v-for="paket in listPaket(item.list_paket)"><i class="fas fa-check text-success"></i> {{
                                paket }}
                            </p>
                        </div>
                        <div>
                            <button v-if="cekPaket(item.id)" class="btn btn-success"><i class="fas fa-check"></i> Paket
                                sudah di beli</button>
                            <Link v-else :href="'/member/paket/' + item.id + '/pembayaran'"
                                class="btn bg-main text-white cursor-pointer ">
                            <i class="fas fa-credit-card"></i>
                            Beli Paket
                            </Link>
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
        paket_saya: Object,
        diskon: Number,
    },
    methods: {
        listPaket(paket) {
            return paket.split(',');
        },
        cekPaket(paketId) {
            let listPaketSaya = [];
            this.paket_saya.forEach(paket => {
                listPaketSaya.push(paket.id_paket)
            });
            if (listPaketSaya.includes(paketId)) {
                return true;
            } else {
                return false
            }
        },
    },
    mounted() {

    }
}
</script>
