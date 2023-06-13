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
            <h1 class="h3 mb-2 text-gray-800">materi_video</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan materi_video dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data materi_video</h6>
                    <Link href="/materi_video" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="form-group">
                            <input v-model="inputIdMateri" type="hidden" class="form-control" name="id" id="id">
                        </div>
                        <div class="form-group">
                            <label for="judul_materi">Judul materi</label>
                            <input v-model="inputJudulMateri" type="text" class="form-control" name="judul_materi"
                                id="judul_materi">
                        </div>
                        <div class="form-group">
                            <label for="link_materi">Link Materi</label>
                            <input v-model="inputLinkMateri" type="text" class="form-control" name="link_materi"
                                id="link_materi">
                        </div>
                        <div class="form-group ">
                            <label for="kategori">Kategori </label>
                            <select v-model="inputKategori" name="kategori" id="kategori" class="form-control">
                                <option value="">-- pilih kategori latihan --</option>
                                <option :value="data.id" v-for="data in  kategori_soal ">{{ data.nama }}
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input @click="submitmateri_video" type="button" class="btn bg-main text-white" value="simpan"
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
            inputIdMateri: '',
            inputJudulMateri: '',
            inputLinkMateri: '',
            inputKategori: '',
        };
    },
    props: {
        user: Object,
        users: Object,
        edit: Object,
        kategori_soal: Object,
    },

    methods: {
        submitmateri_video() {
            const formData = {
                // produk
                id: this.inputIdMateri,
                judul_materi: this.inputJudulMateri,
                link_materi: this.inputLinkMateri,
                kategori: this.inputKategori,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/materi_video', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('materi_video'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/materi_video', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('materi_video'));

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
            this.inputNamamateri_video = this.edit.nama_materi_video;
            this.inputIdmateri_video = this.edit.id;
        }

    }
}
</script>
