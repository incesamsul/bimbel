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
                <h1 class="h3 mb-0 main-color">{{ transaksi.paket.nama_paket }} </h1>
                <p>Content dari paket {{ transaksi.paket.nama_paket.toLowerCase() }} </p>
            </div>
            <div class="row">

                <div class="col-sm-2">
                    <div class="card border-0 paket-item">
                        <Link :href="'/member/paket_aktif/' + transaksi.paket.id + '/text'"
                            class="card-body d-flex align-items-center flex-column pt-5">
                        <img src="/assets/img/svg/text_file.svg" alt="Example Image" width="100">
                        <p class="mt-3">Materi text</p>
                        </Link>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card border-0 paket-item">
                        <Link :href="'/member/paket_aktif/' + transaksi.paket.id + '/video'"
                            class="card-body d-flex align-items-center flex-column pt-5">
                        <img src="/assets/img/svg/video_file.svg" alt="Example Image" width="100">
                        <p class="mt-3">Materi Video</p>
                        </Link>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card border-0 paket-item">
                        <Link :href="'/member/paket_aktif/' + transaksi.paket.id + '/tryout'"
                            class="card-body d-flex align-items-center flex-column pt-5">
                        <img src="/assets/img/svg/exam.svg" alt="Example Image" width="95">
                        <p class="mt-3">Tryout</p>
                        </Link>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card border-0 paket-item">
                        <Link :href="'/member/paket_aktif/' + transaksi.paket.id + '/latihan'"
                            class="card-body d-flex align-items-center flex-column pt-5">
                        <img src="/assets/img/svg/learn.svg" alt="Example Image" width="80">
                        <p class="mt-3">Latihan</p>
                        </Link>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="card border-0 paket-item">
                        <a target="_blank" :href="transaksi.paket.link_telegram"
                            class="card-body d-flex align-items-center flex-column pt-5">
                            <img src="/assets/img/svg/group.svg" alt="Example Image" width="85">
                            <p class="mt-3">Group Telegram</p>
                        </a>
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
    mounted() {

    }
}
</script>
