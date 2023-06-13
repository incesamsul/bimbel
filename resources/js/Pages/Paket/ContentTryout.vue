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
            <h1 class="h3 mb-2 text-gray-800">Data tryout</h1>
            <p class="mb-4">Semua data tryout ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data Tryout</h6>
                            <Link :href="'/member/paket_aktif/' + paket.id" class="btn btn-light"> <i
                                class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4" v-for="item in tryoutData">
                    <div class="card border-0 pb-4">
                        <div class="card-body">
                            <h5 class="main-color text-center text-capitalize"><strong>{{ item.nama_tryout }}</strong></h5>
                            <div class="row mt-5">
                                <div class="col-sm-5 d-flex justify-content-center align-items-center">
                                    <img src="/assets/img/learn.svg" alt="" width="100">
                                </div>
                                <div class="col-sm-7">
                                    <p class="badge badge-info">Premium</p>
                                    <p>Jumlah soal : 100</p>
                                    <button @click="makeSegment(item.id)" class="btn bg-main text-white">

                                        <i v-if="loading" class="fas fa-circle-notch fa-spin"></i>
                                        <i v-else class="fas fa-play-circle"></i>
                                        Mulai
                                    </button>
                                    <Link title="History " class="btn btn-secondary ml-2"
                                        :href="'/member/tryout/history/' + item.id">
                                    <i class="fas fa-clock"></i>
                                    </Link>
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
    data() {
        return {
            loading: false,
            tryoutData: JSON.parse(this.tryout),
        }
    },
    props: {
        user: Object,
        users: Object,
        paket: Object,
        tryout: Object,
    },
    computed: {

    },
    methods: {
        makeSegment(tryoutId) {
            this.loading = true;
            axios.post(`/api/make_segment/${tryoutId}`, {
                user_id: this.user.id,

            })
                .then(response => {
                    console.log(response)
                    this.$inertia.visit(`/member/tryout/konfirmasi`);

                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error(error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });
            // return '/member/tryout/konfirmasi/' + tryoutId;
        },
    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
