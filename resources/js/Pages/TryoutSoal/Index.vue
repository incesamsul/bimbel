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
            <h1 class="h3 mb-2 text-gray-800">Data soal tryout</h1>
            <p class="mb-4">Semua data soal ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-4">
                    <div class="card border-0 mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Tambah soal</h6>
                            <Link href="/tryout" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group m-0">
                                        <label for="kelas">kelas</label>
                                        <select v-model="inputKelasId" name="kategori" id="kategori" class="form-control">
                                            <option value="">-- pilih kelas --</option>
                                            <option :value="data.id" v-for="data in  kelas ">{{ data.nama_kelas }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="kategori_soal">kategori_soal</label>
                                        <select v-model="inputKategoriSoalId" @change="loadSubKategoriSoalOptions"
                                            name="kategori" id="kategori" class="form-control">
                                            <option value="">-- pilih kategori_soal --</option>
                                            <option :value="data.id" v-for="data in kategori_soals">{{ data.nama }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group m-0">
                                        <label for="sub_kategori_soal">sub_kategori_soal</label>
                                        <select v-model="inputSubKategoriSoalId" name="subkategori" id="subkategori"
                                            class="form-control">
                                            <option value="">-- pilih subkategori_soal --</option>
                                            <option :value="data.id" v-for="data in subkategori_soal">{{ data.nama }}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm-12">
                                    <div class="form-grup">
                                        <button @click="searchSoal" class="btn bg-main text-white   ">Cari..</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">List soal</h6>
                            <div class="button-wrapper">
                                <span @click="addSoal" class="btn btn-light">

                                    <!-- Show loading indicator -->
                                    <i v-if="loading" class="fas fa-circle-notch fa-spin"></i>

                                    <i v-else class="fas fa-save mr-2"></i>
                                    Simpan
                                </span>
                                <input class="hide" id="selectAll" type="checkbox" v-model="selectAll"
                                    @change="toggleSelectAll">
                                <label for="selectAll" class="cursor-pointer ml-3 btn btn-light mt-2">Pilih semua</label>
                            </div>

                        </div>
                        <div class="card-body list-soal scrollable-div">
                            <template v-if="loading">
                                <!-- Show loading indicator -->
                                <div
                                    class="loading-indicator d-flex justify-content-center align-items-center mt-5 flex-column">
                                    <h1 class="fas fa-circle-notch fa-spin"></h1>
                                    <p> loading ..</p>
                                </div>
                            </template>
                            <template v-else-if="searchResults.length === 0">
                                <div>No search results</div>
                            </template>
                            <template v-else>

                                <div v-for="result in searchResults" :key="result.id"
                                    :class="['alert', 'alert-secondary', 'd-flex', 'justify-content-between', 'align-items-center', 'cursor-pointer', { 'bg-main text-white': result.selected }]"
                                    @click="toggleSelection(result)">
                                    <p class="m-0" v-html="result.pertanyaan"></p>
                                </div>

                            </template>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">List soal</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div>
                                    <div v-if="selectedQuestion">
                                        <div class="d-flex justify-content-between">
                                            <div class="question d-flex">
                                                <span class="mr-3">{{ selectedQuestionIndex + 1 }}. </span>
                                                <span v-html="selectedQuestion.soal.pertanyaan.trim()"></span>
                                            </div>
                                            <button @click="deleteSoal(selectedQuestion.id)" class="btn btn-danger m"><i
                                                    class="fas fa-trash"></i></button>
                                        </div>
                                        <ul>
                                            <li type="A" class="pilihan "
                                                v-for="(pilihan, pilihanIndex) in selectedQuestion.soal.pilihan"
                                                :key="pilihanIndex">
                                                {{ pilihan.pilihan }}
                                            </li>
                                        </ul>
                                    </div>
                                    <div v-else>
                                        pilih soal ...
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Nomor soal</h6>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 d-flex flex-wrap ">
                                    <div v-for="(item, index) in tryout_soal" :key="item.id">
                                        <button
                                            class="btn btn-outline-secondary mr-2 mt-2 p-3 d-flex justify-content-center align-items-center"
                                            @click="displayQuestion(index)"
                                            :class="{ 'bg-main text-white': selectedQuestionIndex === index }">{{ index +
                                                1
                                            }}</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>

<style>
.list-soal {
    height: 260px;
    overflow: auto;
}

.pilihan {
    border-radius: 15px;
    background-color: #eee;
    padding: 15px;
    margin-top: 10px;
    list-style-position: inside;
    cursor: pointer;
}

.pilihan:hover {
    background-color: #ddd;
}
</style>


<script>

export default {
    props: {
        user: Object,
        // tryout_soal: Object,
        kelas: Object,
        kategori_soals: Object,
        id_tryout: Number,
    },
    data() {
        return {
            tryout_soal: [],
            selectAll: false,
            selectedSoalId: [],
            loading: false,
            inputKategoriSoalId: '',
            inputSubKategoriSoalId: '',
            kategori_soal: [],
            subkategori_soal: [],
            inputKelasId: '',
            selectedQuestionIndex: 0,
            selectedQuestion: null,
            searchResults: [] // Initialize search results as an empty array

        };
    },
    created() {
        this.selectedQuestion = this.tryout_soal[this.selectedQuestionIndex];
    },
    methods: {
        deleteSoal(id_tryout_soal) {
            axios.delete(`/api/delete-soal/${id_tryout_soal}`)
                .then(response => {
                    // Update the soal data in the component
                    console.log(response);
                    this.fetchDataSoal();
                    showFlashMessage(response.data.message);
                })
                .catch(error => {
                    console.error(error);
                });

        },
        fetchDataSoal() {
            axios.get(`/api/get-soal/${this.id_tryout}/${this.segment_tryout_id}`)
                .then(response => {
                    // Update the soal data in the component
                    this.tryout_soal = response.data;
                    console.log(this.tryout_soal);
                })
                .catch(error => {
                    console.error(error);
                });

        },
        addSoal() {
            this.loading = true;
            axios.post('/api/tryout/add_soal', {
                soal_id: this.selectedSoalId,
                tryout_id: this.id_tryout,
            })
                .then(response => {
                    // Handle the response from the server
                    showFlashMessage(response.data.message);
                    this.fetchDataSoal();
                    console.log(response.data);
                })
                .catch(error => {
                    // Handle any errors
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });
        },
        toggleSelectAll() {
            this.searchResults.forEach(result => {
                result.selected = this.selectAll;
                if (this.selectAll && !this.selectedSoalId.includes(result.id)) {
                    this.selectedSoalId.push(result.id); // Add the selected ID to the array
                } else if (!this.selectAll) {
                    const index = this.selectedSoalId.indexOf(result.id);
                    if (index !== -1) {
                        this.selectedSoalId.splice(index, 1); // Remove the unselected ID from the array
                    }
                }
            });
        },
        toggleSelection(result) {
            result.selected = !result.selected;
            if (result.selected) {
                this.selectedSoalId.push(result.id); // Add the selected ID to the array
            } else {
                const index = this.selectedSoalId.indexOf(result.id);
                if (index !== -1) {
                    this.selectedSoalId.splice(index, 1); // Remove the unselected ID from the array
                }
            }

            // Check if all items are selected to update the "Select All" checkbox
            this.selectAll = this.searchResults.every(result => result.selected);
        },
        searchSoal() {
            this.loading = true;
            axios.get(`/api/search_soal/`, {
                params: {
                    kategoriSoalId: this.inputKategoriSoalId,
                    kelasId: this.inputKelasId,
                    subKategoriSoalId: this.inputSubKategoriSoalId
                }
            })
                .then(response => {
                    // Assuming the response data contains an array of search results
                    const searchResults = response.data;

                    console.log(searchResults);
                    // Update the data property used for rendering the search results
                    this.searchResults = searchResults;
                })
                .catch(error => {
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });
        },
        loadSubKategoriSoalOptions() {
            if (this.inputKategoriSoalId) {
                axios.get(`/api/get_sub_kategori_soal/${this.inputKategoriSoalId}`)
                    .then(response => {
                        this.subkategori_soal = response.data.options;
                    })
                    .catch(error => {
                        console.error(error);
                    });
            } else {
                this.subkategori_soal = [];
            }
        },
        displayQuestion(index) {
            this.selectedQuestionIndex = index;
            this.selectedQuestion = this.tryout_soal[index];
        },
        isActiveQuestion(index) {
            return this.selectedQuestionIndex === index;
        },
    },
    mounted() {
        this.fetchDataSoal();

    }


}
</script>
