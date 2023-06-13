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
            <h1 class="h3 mb-2 text-gray-800">Data materi_text</h1>
            <p class="mb-4">Semua data materi_text ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data materi_text</h6>
                    <Link href="/materi_text/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
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
                                <tr v-for="materi_text in materi_text">
                                    <td>{{ materi_text.id }}</td>
                                    <td>{{ materi_text.kategori.nama }}</td>
                                    <td>{{ materi_text.judul_materi }}</td>
                                    <td>
                                        <span @click="deletemateri_text(materi_text.id)"
                                            class="badge badge-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <Link :href="'materi_text/edit/' + materi_text.id"
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
        materi_text: Object,
    },
    computed: {

    },
    methods: {
        deletemateri_text(id_materi_text) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/materi_text/${id_materi_text}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('materi_text'));

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
