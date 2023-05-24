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
            <h1 class="h3 mb-2 text-gray-800">Data sub_kategori_soal</h1>
            <p class="mb-4">Semua data sub_kategori_soal ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data sub_kategori_soal</h6>
                    <Link href="/sub_kategori_soal/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kategori soal </th>
                                    <th>Nama </th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="item in sub_kategori_soal">
                                    <td>{{ item.id }}</td>
                                    <td>{{ item.kategori_soal.nama }} / {{ item.kategori_soal.kode }}</td>
                                    <td>{{ item.nama }}</td>
                                    <td>
                                        <span @click="deleteKategori(item.id)" class="badge badge-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <Link :href="'sub_kategori_soal/edit/' + item.id"
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
        sub_kategori_soal: Object,
    },
    computed: {

    },
    methods: {
        deleteKategori(sub_kategori_soal) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/sub_kategori_soal/${sub_kategori_soal}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('sub_kategori_soal'));

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
