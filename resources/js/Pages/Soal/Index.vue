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
            <h1 class="h3 mb-2 text-gray-800">Data soal</h1>
            <p class="mb-4">Semua data soal ada dihalaman ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-">Data soal</h6>
                    <div>
                        <Link href="/soal/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                        <button data-toggle="modal" data-target="#import" type="button" class="btn btn-success ml-2"> <i
                                class="fas fa-file-excel"></i></button>
                        <a href="/download_format" class="btn btn-primary ml-2"> <i class="fas fa-arrow-down"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>kelas</th>
                                    <th>kategori</th>
                                    <th>sub kategori</th>
                                    <th>soal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="item in soal">
                                    <td>{{ item.id }}</td>

                                    <td>{{ item.kelas.nama_kelas }}</td>
                                    <td>{{ item.kategori_soal.nama }}</td>
                                    <td>{{ item.sub_kategori_soal.nama }}</td>
                                    <td v-html="item.pertanyaan"></td>
                                    <td>
                                        <span @click="deletesoal(item.id)" class="badge badge-danger cursor-pointer">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                        <Link :href="'soal/edit/' + item.id"
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


        <!-- Modal -->
        <div class="modal fade" id="import" tabindex="-1" aria-labelledby="importLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importLabel">Import soal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" ref="fileInput" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="uploadFile"><template v-if="loading">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </template><span v-else>Import</span></button>
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
        soal: Object,
    },
    computed: {

    },
    data() {
        return {
            loading: false,
        };
    },
    methods: {
        uploadFile() {
            this.loading = true;
            const fileInput = this.$refs.fileInput;
            const file = fileInput.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('soal', file);

                axios.post('/api/import-soal', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        document.location.reload();
                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    }).finally(() => {
                        this.loading = false; // reset loading flag
                    });
            }
        },
        deletesoal(soal_id) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/soal/${soal_id}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('soal'));

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
