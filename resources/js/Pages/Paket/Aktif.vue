<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex flex-column mb-4">
                <h1 class="h3 mb-0 main-color">Paket aktif</h1>
                <p>List paket yang telah anda beli </p>
            </div>
            <div class="row">
                <div class="col-sm-4" v-for="item in paket">
                    <div class="card border-0 p-5">
                        <h2><strong>{{ item.paket.nama_paket }}</strong></h2>
                        <h4 class="main-color"><strong>Rp. {{ Number(item.paket.harga).toLocaleString() }}</strong></h4>
                        <div class="list mt-3">
                            <p v-for="paket in listPaket(item.paket.list_paket)"><i class="fas fa-check text-success"></i>
                                {{
                                    paket }}
                            </p>
                        </div>
                        <div>
                            <Link :href="'/member/paket_aktif/' + item.paket.id" class="btn btn-primary cursor-pointer">
                            <i class="fas fa-arrow-right"></i>
                            Buka
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
    },
    methods: {
        listPaket(paket) {
            return paket.split(',');
        },
    }
}
</script>
