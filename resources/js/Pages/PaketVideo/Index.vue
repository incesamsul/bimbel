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
            <h1 class="h3 mb-2 text-gray-800">Data paket_video</h1>
            <p class="mb-4">Semua data paket_video ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data paket_video</h6>
                            <Link href="/paket_video/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-body p-5">
                            <div class="row">
                                <Link :href="'paket_video/' + item.id" class="col-6 col-sm-4 col-md-2 folder-col"
                                    v-for="item in paket_video">
                                <i class="fas fa-folder text-info"></i>
                                <p>{{ item.nama_paket }}</p>
                                </Link>
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
        paket_video: Object,
    },
    computed: {

    },
    methods: {
        deletepaket_video(id_paket_video) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/paket_video/${id_paket_video}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket_video'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        }
    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
