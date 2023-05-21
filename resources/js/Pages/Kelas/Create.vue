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
            <h1 class="h3 mb-2 text-gray-800">kelas</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan kelas dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data kelas</h6>
                    <Link href="/kelas" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputIdKelas" type="hidden" class="form-control" name="id" id="nama_kelas">
                        </div>
                        <div class="form-group">
                            <label for="nama_kelas">nama_kelas</label>
                            <input v-model="inputNamaKelas" type="text" class="form-control" name="nama_kelas"
                                id="nama_kelas">
                        </div>
                        <div class="form-group">
                            <input @click="submitKelas" type="button" class="btn bg-main text-white" value="simpan"
                                id="btn-confirm" />
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<script>



export default {
    data() {
        return {
            // deadline
            inputIdKelas: '',
            inputNamaKelas: '',
        };
    },
    props: {
        user: Object,
        users: Object,
        edit: Object,
    },

    methods: {
        submitKelas() {
            const formData = {
                // produk
                id: this.inputIdKelas,
                nama_kelas: this.inputNamaKelas,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/kelas', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('kelas'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/kelas', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('kelas'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        },


    }, mounted() {
        // Import a JavaScript file dynamically
        if (this.edit) {
            this.inputNamaKelas = this.edit.nama_kelas;
            this.inputIdKelas = this.edit.id;
        }

    }
}
</script>
