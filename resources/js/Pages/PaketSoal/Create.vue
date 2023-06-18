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
            <h1 class="h3 mb-2 text-gray-800">paket_soal</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan paket_soal dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data paket_soal</h6>
                    <Link href="/paket_soal" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputIdVideo" type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <label for="nama_paket_soal">nama paket</label>
                            <input v-model="inputNamaPaket" type="text" class="form-control" name="nama_paket_soal"
                                id="nama_paket_soal">
                        </div>
                        <div class="form-group">
                            <input @click="submitpaket_soal" type="button" class="btn bg-main text-white" value="simpan"
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
            inputIdVideo: '',
            inputNamaPaket: '',
        };
    },
    props: {
        user: Object,
        users: Object,
        edit: Object,
    },

    methods: {
        submitpaket_soal() {
            const formData = {
                // produk
                id: this.inputIdVideo,
                nama_paket: this.inputNamaPaket,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/paket_soal', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket_soal'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/paket_soal', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket_soal'));

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
            this.inputNamapaket_soal = this.edit.nama_paket_soal;
            this.inputIdVideo = this.edit.id;
        }

    }
}
</script>
