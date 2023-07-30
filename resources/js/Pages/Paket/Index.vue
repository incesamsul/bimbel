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
            <h1 class="h3 mb-2 text-gray-800">Data paket</h1>
            <p class="mb-4">Semua data paket ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4 main-radius">
                        <div class="card-body py-3 bg-white d-flex justify-content-between align-items-center main-radius">
                            <h6 class="m-0 font-weight-bold text-">Data paket</h6>
                            <Link href="/paket/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4" v-for="item in paket">
                    <div class="card border-0 p-5">
                        <h2><strong>{{ item.nama_paket }}</strong> <span class="badge badge-info ">{{ item.jenis_paket
                        }}</span></h2>

                        <h4 class="main-color"><strong>Rp. {{ Number(item.harga).toLocaleString() }}</strong></h4>
                        <div class="list mt-3">
                            <p v-for="paket in listPaket(item.list_paket)"><i class="fas fa-check text-success"></i> {{
                                paket }}
                            </p>
                        </div>
                        <div>
                            <span @click="deletepaket(item.id)" class="btn btn-danger cursor-pointer">
                                <i class="fas fa-trash"></i>
                                hapus
                            </span>
                            <Link :href="'paket/edit/' + item.id" class="btn btn-warning cursor-pointer ml-2">
                            <i class="fas fa-pen"></i>
                            edit
                            </Link>
                            <span v-if="item.tampilkan == '1'" @click="sembunyikanPaket(item.id)"
                                class="btn btn-info cursor-pointer ml-2">
                                <i class="fas fa-eye"></i>
                                hide
                            </span>
                            <span v-else @click="tampilkanPaket(item.id)" class="btn btn-success cursor-pointer ml-2">
                                <i class="fas fa-eye"></i>
                                show
                            </span>
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
        paket: Object,
    },
    computed: {

    },
    methods: {
        listPaket(paket) {
            return paket.split(',');
        },
        deletepaket(id_paket) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/paket/${id_paket}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        },
        tampilkanPaket(id_paket) {
            if (confirm('yakin ingin menampilkan paket ?')) {
                axios.put(`/paket/tampilkan/${id_paket}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        },
        sembunyikanPaket(id_paket) {
            if (confirm('yakin ingin sembunyikan paket ?')) {
                axios.put(`/paket/sembunyikan/${id_paket}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket'));

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
