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
            <h1 class="h3 mb-2 text-gray-800">latihan</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan latihan dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data latihan</h6>
                    <Link href="/latihan" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputId" type="hidden" class="form-control" name="id" id="nama_latihan">
                        </div>
                        <div class="form-group">
                            <label for="nama_latihan">nama_latihan</label>
                            <input v-model="inputNamalatihan" type="text" class="form-control" name="nama_latihan"
                                id="nama_latihan">
                        </div>
                        <div class="form-group">
                            <label for="durasi">durasi</label>
                            <input v-model="inputDurasi" type="number" class="form-control" name="durasi" id="durasi">
                        </div>
                        <div class="form-group">
                            <label for="mulai">mulai</label>
                            <input v-model="inputMulai" type="datetime-local" class="form-control" name="mulai" id="mulai">
                        </div>
                        <div class="form-group ">
                            <label for="kelas">kelas</label>
                            <select v-model="inputKelasId" name="kategori" id="kategori" class="form-control">
                                <option value="">-- pilih kelas --</option>
                                <option :value="data.id" v-for="data in  kelas ">{{ data.nama_kelas }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <label for="kategori_latihan">Kategori latihan</label>
                            <select v-model="inputKategoriLatihan" name="kategori_latihan" id="kategori_latihan"
                                class="form-control">
                                <option value="">-- pilih kategori latihan --</option>
                                <option :value="data.id" v-for="data in  kategori_soal ">{{ data.nama }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input @click="submitlatihan" type="button" class="btn bg-main text-white" value="simpan"
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
            inputNamalatihan: '',
            inputKelasId: '',
            inputDurasi: '',
            inputMulai: '',
            inputKategoriLatihan: '',
        };
    },
    props: {
        user: Object,
        kelas: Object,
        edit: Object,
        kategori_soal: Object,
    },

    methods: {
        submitlatihan() {
            const formData = {
                // produk
                id: this.inputIdlatihan,
                nama_latihan: this.inputNamalatihan,
                mulai: this.inputMulai,
                durasi: this.inputDurasi,
                kelas_id: this.inputKelasId,
                kategori_soal_id: this.inputKategoriLatihan,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/latihan', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('latihan'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/latihan', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('latihan'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        },


    }, mounted() {
        // Import a JavaScript file dynamically
        console.log(this.edit)
        if (this.edit) {
            this.inputNamalatihan = this.edit.nama_latihan;
            this.inputIdlatihan = this.edit.id;
            this.inputMulai = this.edit.mulai;
            this.inputDurasi = this.edit.durasi;
            this.inputKelasId = this.edit.kelas_id;
        }

    }
}
</script>
