<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { Head, Link, useForm } from '@inertiajs/vue3';
import { showFlashMessage } from '@/global_func.js';

import CkEditor from '@/Components/CkEditor.vue';



</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">soal</h1>
            <p class="mb-4">Lakukan penambahan/pengeditan soal dengan mengisi form dibawah ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data soal</h6>
                    <Link href="/soal" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                </div>
                <div class="card-body">
                    <form id="msform">
                        <div class="card border-0">
                            <div class="card-header border-0">
                                <h5>Kelas dan kategori soal</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group m-0">
                                            <label for="kelas">kelas</label>
                                            <select v-model="inputKelasId" name="kategori" id="kategori"
                                                class="form-control">
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
                                                <option :value="data.id" v-for="data in kategori_soal">{{ data.nama }}
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
                            </div>
                        </div>
                        <div class="card border-0">
                            <div class="card-header border-0">
                                <h5>Pertanyaan</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="form-group m-0">
                                    <input v-model="inputIdsoal" type="hidden" class="form-control" name="id"
                                        id="nama_soal">
                                </div>
                                <div class="form-group">
                                    <!-- <ck-editor v-model="inputTest"></ck-editor> -->
                                    <!-- <CkEditor :value="inputPertanyaan" @input="inputPertanyaan = $event" /> -->
                                    <ck-editor :content="inputPertanyaan"
                                        @update:content="inputPertanyaan = $event"></ck-editor>

                                    <!-- <textarea rows="2" v-model="inputTest"></textarea> -->
                                </div>
                            </div>
                        </div>
                        <div class="card border-0">
                            <div class="card-header">
                                <h5>Pilihan dan jawaban</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="card d-flex flex-row overflow-hidden">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                            <h6>A</h6>
                                        </div>
                                        <div class="card-body p-1">
                                            <textarea v-model="inputA" class="form-control border-0" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card d-flex flex-row overflow-hidden">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                            <h6>B</h6>
                                        </div>
                                        <div class="card-body p-1">
                                            <textarea v-model="inputB" class="form-control border-0" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card d-flex flex-row overflow-hidden">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                            <h6>C</h6>
                                        </div>
                                        <div class="card-body p-1">
                                            <textarea v-model="inputC" class="form-control border-0" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card d-flex flex-row overflow-hidden">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                            <h6>D</h6>
                                        </div>
                                        <div class="card-body p-1">
                                            <textarea v-model="inputD" class="form-control border-0" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="card d-flex flex-row overflow-hidden">
                                        <div class="card-header d-flex align-items-center justify-content-center">
                                            <h6>E</h6>
                                        </div>
                                        <div class="card-body p-1">
                                            <textarea v-model="inputE" class="form-control border-0" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="jawaban">jawaban</label>
                                    <select v-model="inputJawaban" name="jawaban" id="jawaban" class="form-control">
                                        <option value="">--pilih jawban--</option>
                                        <option value="0">A</option>
                                        <option value="1">B</option>
                                        <option value="2">C</option>
                                        <option value="3">D</option>
                                        <option value="4">E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card border-0">
                            <div class="card-header border-0">
                                <h5>Pembahasan</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="form-group m-0">
                                    <input v-model="inputPembahasan" type="hidden" class="form-control" name="id"
                                        id="nama_soal">
                                </div>
                                <div class="form-group">
                                    <!-- <CkEditor :value="inputPembahasan" @input="inputPembahasan = $event" /> -->
                                    <ck-editor :content="inputPembahasan"
                                        @update:content="inputPembahasan = $event"></ck-editor>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input @click="submitsoal" type="button" class="btn bg-main text-white" value="simpan"
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

            inputKategoriSoalId: '',
            inputSubKategoriSoalId: '',
            kategori_soal: [],
            subkategori_soal: [],
            inputIdsoal: '',
            inputKelasId: '',
            inputPertanyaan: '',
            inputA: '',
            inputB: '',
            inputC: '',
            inputD: '',
            inputE: '',
            inputJawaban: '',
            inputPembahasan: '',
        };
    },
    props: {
        user: Object,
        kelas: Object,
        kategori_soal: Object,
        edit: Object,
    },

    methods: {
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
        submitsoal() {
            const formData = {

                id: this.inputIdsoal,
                pertanyaan: this.inputPertanyaan,
                a: this.inputA,
                b: this.inputB,
                c: this.inputC,
                d: this.inputD,
                e: this.inputE,
                jawaban: this.inputJawaban,
                pembahasan: this.inputPembahasan,
                kelas_id: this.inputKelasId,
                kategori_soal_id: this.inputKategoriSoalId,
                sub_kategori_soal_id: this.inputSubKategoriSoalId,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/soal', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('soal'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/soal', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('soal'));

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
            this.inputIdsoal = this.edit.id;
            this.inputPertanyaan = this.edit.pertanyaan;
            this.inputPembahasan = this.edit.pembahasan;


            this.inputA = this.edit.pilihan[0].pilihan
            this.inputB = this.edit.pilihan[1].pilihan
            this.inputC = this.edit.pilihan[2].pilihan
            this.inputD = this.edit.pilihan[3].pilihan
            this.inputE = this.edit.pilihan[4].pilihan

            // filter the array to get the object with is_correct equal to 1
            let correctPilihan = this.edit.pilihan.filter(pilihan => pilihan.is_correct === 1)

            let correctIndex = -1;
            for (let i in this.edit.pilihan) {
                if (this.edit.pilihan[i].is_correct === 1) {
                    correctIndex = i;
                    break;
                }
            }

            console.log(correctIndex);

            let options = ['a', 'b', 'c', 'd', 'e'];

            this.inputJawaban = options[correctIndex];

        }

    }
}
</script>
