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
                    <div class="form-group">
                        <input v-model="inputIdpaket" type="hidden" class="form-control" name="id" id="nama_paket">
                    </div>
                    <div class="form-group">
                        <label for="nama_paket">nama_paket</label>
                        <input v-model="inputNamapaket" type="text" class="form-control" name="nama_paket" id="nama_paket">
                    </div>
                    <div class="form-group">
                        <label for="link_telegram">link telegram</label>
                        <input v-model="inputLinkTelegram" type="text" class="form-control" name="link_telegram"
                            id="link_telegram">
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input v-model="inputHarga" type="text" class="form-control" name="harga" id="harga">
                    </div>

                    <div class="form-group">
                        <label for="">List Paket</label>
                        <input class="form-control tagsinput" type="text" data-role="tagsinput"
                            value="Video, Latihan, Tryout">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Pilih paket video</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card border-0">
                                        <div class="card-body p-5">
                                            <div class="row">
                                                <div @click="toggleVideo(item)" :class="{
                                                    'bg-secondary text-white': item.selected,
                                                }" class="col-6 mr-3 col-sm-4 col-md-2 folder-col"
                                                    v-for="item in paket_video">
                                                    <i class="fas fa-folder text-info"></i>
                                                    <p>{{ item.nama_paket }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Pilih paket tryout</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card border-0">
                                        <div class="card-body p-5">
                                            <div class="row">
                                                <div @click="toggleTryout(item)" :class="{
                                                    'bg-secondary text-white': item.selected,
                                                }" class="col-6 mr-3 col-sm-4 col-md-2 folder-col"
                                                    v-for="item in paket_tryout">
                                                    <i class="fas fa-folder text-info"></i>
                                                    <p>{{ item.nama_tryout }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Pilih paket Materi text</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card border-0">
                                        <div class="card-body p-5">
                                            <div class="row">
                                                <div @click="toggleText(item)" :class="{
                                                    'bg-secondary text-white': item.selected,
                                                }" class="col-6 mr-3 col-sm-4 col-md-2 folder-col"
                                                    v-for="item in paket_text">
                                                    <i class="fas fa-folder text-info"></i>
                                                    <p>{{ item.nama_paket }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Pilih paket latihan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card border-0">
                                        <div class="card-body p-5">
                                            <div class="row">
                                                <div @click="toggleLatihan(item)" :class="{
                                                    'bg-secondary text-white': item.selected,
                                                }" class="col-6 mr-3 col-sm-4 col-md-2 folder-col"
                                                    v-for="item in paket_latihan">
                                                    <i class="fas fa-folder text-info"></i>
                                                    <p>{{ item.nama_latihan }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="form-group">
                                <input @click="submitpaket" type="button" class="btn bg-main text-white" value="simpan"
                                    id="btn-confirm" />
                            </div>
                        </div>
                    </div>
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

            selectedVideoId: [],
            selectedTryoutId: [],
            selectedTextId: [],
            selectedLatihanId: [],
        };
    },
    props: {
        user: Object,
        paket_video: Object,
        paket_text: Object,
        paket_tryout: Object,
        paket_latihan: Object,
        edit: Object,
    },

    methods: {
        toggleVideo(item) {
            item.selected = !item.selected;
            if (item.selected) {
                this.selectedVideoId.push(item.id); // Add the selected ID to the array
            } else {
                const index = this.selectedVideoId.indexOf(item.id);
                if (index !== -1) {
                    this.selectedVideoId.splice(index, 1); // Remove the unselected ID from the array
                }
            }
        },
        toggleTryout(item) {
            item.selected = !item.selected;
            if (item.selected) {
                this.selectedTryoutId.push(item.id); // Add the selected ID to the array
            } else {
                const index = this.selectedTryoutId.indexOf(item.id);
                if (index !== -1) {
                    this.selectedTryoutId.splice(index, 1); // Remove the unselected ID from the array
                }
            }
        },
        toggleText(item) {
            item.selected = !item.selected;
            if (item.selected) {
                this.selectedTextId.push(item.id); // Add the selected ID to the array
            } else {
                const index = this.selectedTextId.indexOf(item.id);
                if (index !== -1) {
                    this.selectedTextId.splice(index, 1); // Remove the unselected ID from the array
                }
            }
        },
        toggleLatihan(item) {
            item.selected = !item.selected;
            if (item.selected) {
                this.selectedLatihanId.push(item.id); // Add the selected ID to the array
            } else {
                const index = this.selectedLatihanId.indexOf(item.id);
                if (index !== -1) {
                    this.selectedLatihanId.splice(index, 1); // Remove the unselected ID from the array
                }
            }
        },

        toList(string) {
            return string.split(',').map(item => parseInt(item.trim()));
        },
        submitpaket() {
            const formData = {
                // produk
                id: this.inputIdpaket,
                nama_paket: this.inputNamapaket,
                link_telegram: this.inputLinkTelegram,
                paket_video: Object.values(this.selectedVideoId).join(','),
                paket_text: Object.values(this.selectedTextId).join(','),
                paket_tryout: Object.values(this.selectedTryoutId).join(','),
                paket_latihan: Object.values(this.selectedLatihanId).join(','),
                harga: this.inputHarga,
                list_paket: $('.tagsinput').val(),
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


        $('.tagsinput').tagsinput('add', { "value": 1, "text": "Video" });

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

            // Assuming you have the array from the controller


            // Loop through your data and update the 'selected' property
            this.paket_video.forEach(item => {
                if (this.toList(this.edit.paket_video).includes(item.id)) {
                    item.selected = true;
                    this.selectedVideoId.push(item.id); // Add the selected ID to the array
                } else {
                    item.selected = false;
                }
            });

            // Loop through your data and update the 'selected' property
            this.paket_tryout.forEach(item => {
                if (this.toList(this.edit.paket_tryout).includes(item.id)) {
                    item.selected = true;
                    this.selectedTryoutId.push(item.id); // Add the selected ID to the array
                } else {
                    item.selected = false;
                }
            });

            // Loop through your data and update the 'selected' property
            this.paket_text.forEach(item => {
                if (this.toList(this.edit.paket_text).includes(item.id)) {
                    item.selected = true;
                    this.selectedTextId.push(item.id); // Add the selected ID to the array
                } else {
                    item.selected = false;
                }
            });

            // Loop through your data and update the 'selected' property
            this.paket_latihan.forEach(item => {
                if (this.toList(this.edit.paket_latihan).includes(item.id)) {
                    item.selected = true;
                    this.selectedLatihanId.push(item.id); // Add the selected ID to the array
                } else {
                    item.selected = false;
                }
            });

        }

    }
}
</script>
