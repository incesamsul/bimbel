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
            <h1 class="h3 mb-2 text-gray-800">paket</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan paket dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data paket</h6>
                    <Link href="/paket" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputIdpaket" type="hidden" class="form-control" name="id" id="nama_paket">
                        </div>
                        <div class="form-group">
                            <label for="nama_paket">nama_paket</label>
                            <input v-model="inputNamapaket" type="text" class="form-control" name="nama_paket"
                                id="nama_paket">
                        </div>
                        <div class="form-group">
                            <label for="link_telegram">link telegram</label>
                            <input v-model="inputLinkTelegram" type="text" class="form-control" name="link_telegram"
                                id="link_telegram">
                        </div>
                        <div class="form-group">
                            <label for="list_paket">list paket video</label>
                            <input v-model="inputPaketVideo" type="text" class="form-control" name="list_paket"
                                id="list_paket">
                        </div>
                        <div class="form-group">
                            <label for="list_paket">list paket text</label>
                            <input v-model="inputPaketText" type="text" class="form-control" name="list_paket"
                                id="list_paket">
                        </div>
                        <div class="form-group">
                            <label for="list_paket">list paket tryout</label>
                            <input v-model="inputPaketTryout" type="text" class="form-control" name="list_paket"
                                id="list_paket">
                        </div>
                        <div class="form-group">
                            <label for="list_paket">list paket latihan</label>
                            <input v-model="inputPaketLatihan" type="text" class="form-control" name="list_paket"
                                id="list_paket">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input v-model="inputHarga" type="text" class="form-control" name="harga" id="harga">
                        </div>

                        <div class="form-group">
                            <input @click="submitpaket" type="button" class="btn bg-main text-white" value="simpan"
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
            inputIdpaket: '',
            inputNamapaket: '',
            inputLinkTelegram: '',
            inputPaketVideo: '',
            inputPaketTryout: '',
            inputHarga: '',
        };
    },
    props: {
        user: Object,
        users: Object,
        edit: Object,
    },

    methods: {
        submitpaket() {
            const formData = {
                // produk
                id: this.inputIdpaket,
                nama_paket: this.inputNamapaket,
                link_telegram: this.inputLinkTelegram,
                paket_video: this.inputPaketVideo,
                paket_text: this.inputPaketText,
                paket_tryout: this.inputPaketTryout,
                paket_latihan: this.inputPaketLatihan,
                harga: this.inputHarga,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/paket', formData)
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
            } else {
                axios.post('/paket', formData)
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


    }, mounted() {
        // Import a JavaScript file dynamically
        if (this.edit) {
            this.inputNamapaket = this.edit.nama_paket;
            this.inputIdpaket = this.edit.id;
            this.inputLinkTelegram = this.edit.link_telegram;
            this.inputHarga = this.edit.harga;
            this.inputPaketVideo = this.edit.paket_video;
            this.inputPaketText = this.edit.paket_text;
            this.inputPaketTryout = this.edit.paket_tryout;
            this.inputPaketLatihan = this.edit.paket_latihan;
        }

    }
}
</script>
