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
            <h1 class="h3 mb-2 text-gray-800">Data paket_soal</h1>
            <p class="mb-4">Semua data paket_soal ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data {{ paket_soal.nama_paket }}</h6>
                            <Link href="/paket_soal" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <div class="card border-0">
                        <div
                            class="card-header bg-white main-radius d-flex flex-row justify-content-between align-items-center">
                            <h4>soal dalam paket</h4>
                            <Link :href="'/paket_soal/' + id_paket_soal + '/1'" class="btn btn-light"> TIU</Link>
                            <Link :href="'/paket_soal/' + id_paket_soal + '/2'" class="btn btn-light"> TKP</Link>
                            <Link :href="'/paket_soal/' + id_paket_soal + '/3'" class="btn btn-light"> TWB</Link>
                            <!-- Show loading indicator -->
                            <template v-if="loading">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </template>
                        </div>
                        <div class="card-body">
                            <div v-for="item in paket_soal"
                                class="alert alert-secondary d-flex align-items-center justify-content-between  flex-rowcursor-pointer">
                                <span class="ml-3"
                                    v-html="item.soal.pertanyaan + 'kategori : ' + item.soal.kategori_soal.kode"></span>
                                <span @click="deletesoal(item.soal.id)" class="text-danger cursor-pointer"><i
                                        class="fas fa-trash"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="card border-0">
                        <div class="card-header bg-white main-radius">
                            <h4>List soal</h4>
                            <div class="button-wrapper">
                                <span @click="addsoal" class="btn btn-light">
                                    Simpan
                                </span>
                                <input class="hide" id="selectAll" type="checkbox" v-model="selectAll"
                                    @change="toggleSelectAll">
                                <label for="selectAll" class="cursor-pointer ml-3 btn btn-light mt-2">Pilih semua</label>
                                <select v-model="selectedKelas" class="form-control" @change="fetchsoalData(selectedKelas)">
                                    <option value="0">--pilih kelas--</option>
                                    <option v-for="item in kelas" :value="item.id">{{ item.nama_kelas }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-for="item in soals"
                                :class="['alert', 'alert-secondary', 'd-flex', 'align-items-center', 'flex-row', 'cursor-pointer', { 'bg-main text-white': item.selected }]"
                                @click="toggleSelection(item)">


                                <span><i class="fas fa-soal"></i></span>
                                <span class="ml-3"
                                    v-html="item.pertanyaan + 'kategori : ' + item.kategori_soal.kode + '<br>kelas :' + item.kelas.nama_kelas"></span>

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
        id_paket_soal: Number,
        kelas: Object,
    },
    computed: {

    },
    data() {
        return {
            selectedKelas: 0,
            soals: [],
            selectAll: false,
            selectedId: [],
            loading: false,
            paket_soal: [],
        };
    },
    methods: {

        deletesoal(id_soal) {
            this.loading = true;
            axios.delete(`/api/paket-soal/delete-soal/${id_soal}`)
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
        addsoal() {
            this.loading = true;
            axios.post('/api/paket-soal/add-soal', {
                id_soal: this.selectedId,
                id_paket_soal: this.id_paket_soal,
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
        fetchsoalData(id_kelas) {

            this.loading = true;
            axios.get('/api/get-soals/' + id_kelas)
                .then((response) => {
                    this.soals = response.data;
                    this.loading = false;
                })
                .catch((error) => {
                    console.error('Error loading soal data:', error);
                });
        },
        toggleSelectAll() {
            this.soals.forEach(result => {
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
            this.selectAll = this.soals.every(result => result.selected);
        },
        fetchDataPaket() {
            axios.get(`/api/get-soal-paket/${this.id_paket_soal}`)
                .then(response => {
                    // Update the soal data in the component
                    this.paket_soal = response.data;
                    console.log(this.paket_soal);
                })
                .catch(error => {
                    console.error(error);
                });

        },
    }, mounted() {
        this.fetchsoalData();
        this.fetchDataPaket();


    }
}
</script>
