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
            <h1 class="h3 mb-2 text-gray-800">Data paket_text</h1>
            <p class="mb-4">Semua data paket_text ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data {{ paket_text.nama_paket }}</h6>
                            <Link href="/paket_text" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <div class="card border-0">
                        <div
                            class="card-header bg-white main-radius d-flex flex-row justify-content-between align-items-center">
                            <h4>Text dalam paket</h4>
                            <!-- Show loading indicator -->
                            <template v-if="loading">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </template>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3" v-for="paket in paket_text">
                                    <div class="card p-0 overflow-hidden border-0 shadow-sm">
                                        <div class="card-body p-0">
                                            <div class="video-container">
                                                <iframe
                                                    src="https://drive.google.com/file/d/1Ci_QIGqEczFO8tE3jhaFcQyRnTMjCX3V/preview"
                                                    width="640" height="480"></iframe>

                                            </div>
                                            <div class="p-3 d-flex justify-content-between align-items-center flex-row">
                                                <small>{{ paket.text.judul_materi }}</small>
                                                <span @click="deleteText(paket.text.id)"
                                                    class="text-danger cursor-pointer"><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="card border-0">
                        <div class="card-header bg-white main-radius">
                            <h4>List Text</h4>
                            <div class="button-wrapper">
                                <span @click="addText" class="btn btn-light">
                                    Simpan
                                </span>
                                <input class="hide" id="selectAll" type="checkbox" v-model="selectAll"
                                    @change="toggleSelectAll">
                                <label for="selectAll" class="cursor-pointer ml-3 btn btn-light mt-2">Pilih semua</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-for="item in texts"
                                :class="['alert', 'alert-secondary', 'd-flex', 'align-items-center', 'flex-row', 'cursor-pointer', { 'bg-main text-white': item.selected }]"
                                @click="toggleSelection(item)">
                                <span><i class="fas fa-text"></i></span>
                                <span class="ml-3">{{ item.judul_materi }} ( {{ item.kategori.kode }} )</span>
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
    props: {
        user: Object,
        users: Object,
        id_paket_text: Number,
    },
    computed: {

    },
    data() {
        return {
            texts: [],
            selectAll: false,
            selectedId: [],
            loading: false,
            paket_text: [],
        };
    },
    methods: {
        deleteText(id_text) {
            this.loading = true;
            axios.delete(`/api/paket-text/delete-text/${id_text}`)
                .then(response => {
                    // Update the soal data in the component
                    console.log(response);
                    this.fetchDataPaket();
                    showFlashMessage(response.data.message);
                })
                .catch(error => {
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });

        },
        addText() {
            this.loading = true;
            axios.post('/api/paket-text/add-text', {
                id_materi_text: this.selectedId,
                id_paket_text: this.id_paket_text,
            })
                .then(response => {
                    // Handle the response from the server
                    showFlashMessage(response.data.message);
                    this.fetchDataPaket();
                    console.log(response.data);
                })
                .catch(error => {
                    // Handle any errors
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });
        },
        fetchTextData() {
            axios.get('/api/get-texts')
                .then((response) => {
                    this.texts = response.data;
                })
                .catch((error) => {
                    console.error('Error loading video data:', error);
                });
        },
        toggleSelectAll() {
            this.texts.forEach(result => {
                result.selected = this.selectAll;
                if (this.selectAll && !this.selectedId.includes(result.id)) {
                    this.selectedId.push(result.id); // Add the selected ID to the array
                } else if (!this.selectAll) {
                    const index = this.selectedId.indexOf(result.id);
                    if (index !== -1) {
                        this.selectedId.splice(index, 1); // Remove the unselected ID from the array
                    }
                }
            });
        },
        toggleSelection(result) {
            result.selected = !result.selected;
            if (result.selected) {
                this.selectedId.push(result.id); // Add the selected ID to the array
            } else {
                const index = this.selectedId.indexOf(result.id);
                if (index !== -1) {
                    this.selectedId.splice(index, 1); // Remove the unselected ID from the array
                }
            }

            // Check if all items are selected to update the "Select All" checkbox
            this.selectAll = this.texts.every(result => result.selected);
        },
        fetchDataPaket() {
            axios.get(`/api/get-text-paket/${this.id_paket_text}`)
                .then(response => {
                    // Update the soal data in the component
                    this.paket_text = response.data;
                    console.log(this.paket_text);
                })
                .catch(error => {
                    console.error(error);
                });

        },
    }, mounted() {
        this.fetchTextData();
        this.fetchDataPaket();


    }
}
</script>
