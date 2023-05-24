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
            <h1 class="h3 mb-2 text-gray-800">Data kategori_soal</h1>
            <p class="mb-4">Semua data kategori_soal ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data kategori_soal</h6>
                    <Link href="/kategori_soal/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>kode</th>
                                    <th>Nama kategori_soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="kategori_soal in kategori_soal">
                                    <td>{{ kategori_soal.id }}</td>
                                    <td>{{ kategori_soal.kode }}</td>
                                    <td>{{ kategori_soal.nama }}</td>
                                    <td>
                                        <span @click="deleteKategori(kategori_soal.id)"
                                            class="badge badge-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <Link :href="'kategori_soal/edit/' + kategori_soal.id"
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
        kategori_soal: Object,
    },
    computed: {

    },
    methods: {
        deleteKategori(kategori_soal) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/kategori_soal/${kategori_soal}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('kategori_soal'));

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
