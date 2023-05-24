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

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data tryout</h6>
                    <Link href="/tryout/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama tryout</th>
                                    <th>Kelas</th>
                                    <th>mulai</th>
                                    <th>durasi</th>
                                    <th>soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="tryout in tryout">
                                    <td>{{ tryout.id }}</td>
                                    <td>{{ tryout.nama_tryout }}</td>
                                    <td>{{ tryout.kelas.nama_kelas }}</td>
                                    <td>{{ tryout.mulai }}</td>
                                    <td>{{ tryout.durasi }} m</td>
                                    <td>
                                        {{ tryout.tryout_soal.length }}
                                        <Link :href="'/tryout_soal/' + tryout.id" class="badge badge-primary">Lihat</Link>
                                    </td>
                                    <td>
                                        <span @click="deletetryout(tryout.id)" class="badge badge-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <Link :href="'tryout/edit/' + tryout.id"
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
        tryout: Object,
    },
    computed: {

    },
    methods: {
        deletetryout(id_tryout) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/tryout/${id_tryout}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('tryout'));

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
