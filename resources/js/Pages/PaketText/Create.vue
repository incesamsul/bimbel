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
            <h1 class="h3 mb-2 text-gray-800">paket_text</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan paket_text dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data paket_text</h6>
                    <Link href="/paket_text" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputIdVideo" type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <label for="nama_paket_text">nama paket</label>
                            <input v-model="inputNamaPaket" type="text" class="form-control" name="nama_paket_text"
                                id="nama_paket_text">
                        </div>
                        <div class="form-group">
                            <input @click="submitpaket_text" type="button" class="btn bg-main text-white" value="simpan"
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
        submitpaket_text() {
            const formData = {
                // produk
                id: this.inputIdVideo,
                nama_paket: this.inputNamaPaket,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/paket_text', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket_text'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/paket_text', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket_text'));

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
            this.inputNamapaket_text = this.edit.nama_paket_text;
            this.inputIdVideo = this.edit.id;
        }

    }
}
</script>
