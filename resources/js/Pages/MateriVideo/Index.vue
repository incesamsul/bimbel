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
            <h1 class="h3 mb-2 text-gray-800">Data materi_video</h1>
            <p class="mb-4">Semua data materi_video ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data materi_video</h6>
                    <Link href="/materi_video/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>kategori</th>
                                    <th>Judul</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="materi_video in materi_video">
                                    <td>{{ materi_video.id }}</td>
                                    <td>{{ materi_video.kategori.nama }}</td>
                                    <td>{{ materi_video.judul_materi }}</td>
                                    <td>
                                        <span @click="deletemateri_video(materi_video.id)"
                                            class="badge badge-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <Link :href="'materi_video/edit/' + materi_video.id"
                                            class="badge badge-warning cursor-pointer ml-2">
                                        <i class="fas fa-pen"></i>
                                        </Link>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        materi_video: Object,
    },
    computed: {

    },
    methods: {
        deletemateri_video(id_materi_video) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/materi_video/${id_materi_video}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('materi_video'));

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
