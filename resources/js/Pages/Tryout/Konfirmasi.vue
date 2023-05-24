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
            <h1 class="h3 mb-2 text-gray-800">Konfirmasi tryout</h1>
            <p class="mb-4">Baca dengan baik sebelum melanjutkan.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 pb-4">
                        <div class="card-body">
                            <div class="row mt-5">
                                <div class="col-sm-5 d-flex justify-content-center align-items-center">
                                    <img src="/assets/img/learn.svg" alt="" width="300">
                                </div>
                                <div class="col-sm-7">
                                    <h5 class="main-color  text-capitalize"><strong>
                                            <Link href="/member/tryout"><i class="fas fa-arrow-left mr-3 text-danger">
                                            </i></Link> {{ segment_tryout.tryout.nama_tryout
                                            }}
                                        </strong>
                                    </h5>
                                    <p class="badge badge-info mt-4">Premium</p>
                                    <p>Jumlah soal : 100</p>
                                    <!-- <Link :href="'/member/tryout/kerjakan/' + segment_tryout.id"
                                        class="btn bg-main text-white"><i class="fas fa-play-circle"></i> Mulai</Link> -->
                                    <button @click="startSegment(segment_tryout.tryout.id)" class="btn bg-main text-white">

                                        <i v-if="loading" class="fas fa-circle-notch fa-spin"></i>
                                        <i v-else class="fas fa-play-circle"></i>
                                        <span v-if="segment_tryout.mulai == null"> Mulai</span>
                                        <span v-else> lanjutkan</span>
                                    </button>

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
        segment_tryout: Object,
    },
    computed: {

    },
    methods: {
        startSegment(tryoutId) {
            this.loading = true;
            axios.post(`/api/start_segment/${tryoutId}`, {
                user_id: this.user.id,

            })
                .then(response => {
                    console.log(response)
                    this.$inertia.visit(`/member/tryout/kerjakan/${response.data.segment_tryout_id}`);

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
