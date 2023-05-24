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
            <h1 class="h3 mb-2 text-gray-800">kategori_soal</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan kategori_soal dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data kategori_soal</h6>
                    <Link href="/kategori_soal" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputId" type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <label for="kode">kode</label>
                            <input v-model="inputKode" type="text" class="form-control" name="kode" id="kode">
                        </div>
                        <div class="form-group">
                            <label for="nama">nama</label>
                            <input v-model="inputNama" type="text" class="form-control" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <input @click="submitData" type="button" class="btn bg-main text-white" value="simpan"
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
            inputId: '',
            inputKode: '',
            inputNama: '',
        };
    },
    props: {
        user: Object,
        users: Object,
        edit: Object,
    },

    methods: {
        submitData() {
            const formData = {
                // produk
                id: this.inputId,
                nama: this.inputNama,
                kode: this.inputKode,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/kategori_soal', formData)
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
            } else {
                axios.post('/kategori_soal', formData)
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
        },


    }, mounted() {
        // Import a JavaScript file dynamically
        if (this.edit) {
            this.inputId = this.edit.id;
            this.inputNama = this.edit.nama;
            this.inputKode = this.edit.kode;
        }

    }
}
</script>
