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
            <h1 class="h3 mb-2 text-gray-800">Data paket_text</h1>
            <p class="mb-4">Semua data paket_text ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <template v-if="loading">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </template>
                            <template v-else>
                                <h6 class="m-0 font-weight-bold text-">Data {{ paket_text.nama_paket }}</h6>
                            </template>
                            <Link :href="'/member/paket_aktif/' + id_paket + '/video'" class="btn btn-light"> <i
                                class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">

                        <div class="card-body">

                            <div class="row">
                                <template v-if="paket_text.length < 1" class="p-5">
                                    <p class="ml-3 mt-3">tidak ada video</p>
                                </template>
                                <div class="col-sm-3" v-for="paket in paket_text">
                                    <div class="card p-0 overflow-hidden border-0 shadow-sm">
                                        <div class="card-body p-0">
                                            <div class="video-container">
                                                <iframe :src="paket.text.link" width="640" height="480"></iframe>

                                            </div>
                                            <div class="p-3 d-flex justify-content-between align-items-center flex-row">
                                                <small>{{ paket.text.judul_materi }}</small>
                                            </div>
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
        users: Object,
        id_paket_text: Number,
        id_paket: Number,
    },
    computed: {

    },
    data() {
        return {
            selectAll: false,
            selectedId: [],
            loading: false,
            paket_text: [],
        };
    },
    methods: {


        fetchDataPaket() {
            this.loading = true;
            axios.get(`/api/get-text-paket/${this.id_paket_text}`)
                .then(response => {
                    // Update the soal data in the component
                    this.paket_text = response.data;
                    console.log(this.paket_text);
                })
                .catch(error => {
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });

        },
    }, mounted() {

        this.fetchDataPaket();


    }
}
</script>
