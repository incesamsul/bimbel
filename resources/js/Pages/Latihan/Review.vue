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
            <h1 class="h3 mb-2 text-gray-800">Data soal latihan</h1>
            <p class="mb-4">Semua data soal ada dihalaman ini.</p>



            <div class="row">
                <div class="col-sm-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 py-3 font-weight-bold text-">List soal</h6>
                            <!-- Show loading indicator when loading is true -->
                            <div v-if="loading" class="spinner-border text-primary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
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

                                        </div>
                                        <ul class="ml-0 pl-0">
                                            <li type="A" class="pilihan d-flex justify-content-between align-items-center"
                                                v-for="(pilihan, pilihanIndex) in selectedQuestion.soal.pilihan"
                                                :key="pilihanIndex" :class="{
                                                    'bg-success text-white': jawabanKamu(selectedQuestionIndex, pilihanIndex),
                                                    'bg-primary text-white': kunciJawaban(selectedQuestionIndex, pilihanIndex),
                                                }">
                                                <div class="options-warpper">
                                                    {{ ['A', 'B', 'C', 'D', 'E'][pilihanIndex] }}. {{ pilihan.pilihan }}
                                                </div>

                                            </li>

                                        </ul>
                                    </div>
                                    <div v-else>
                                        Loading... <!-- or any other loading indicator/message -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="card border-0 mb-4">
                                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-">Nomor soal</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row ">
                                        <div class="col-sm-12 d-flex flex-wrap ">
                                            <div v-for="(item, index) in latihan_soal" :key="item.id">
                                                <button
                                                    class="text-danger nomor-soal btn mr-2 mt-2 p-3 d-flex justify-content-center align-items-center"
                                                    @click="displayQuestion(index)" :class="{
                                                        'active': selectedQuestionIndex === index,
                                                        'answered': isQuestionAnswered(index),
                                                        'flagged': isQuestionFlagged(index)
                                                    }">
                                                    <strong>{{ index + 1 }}</strong>
                                                </button>


                                            </div>


                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-sm-12">
                                            <div class="d-flex justify-content-center">
                                                <button class="btn bg-main text-white mr-2" @click="previousQuestion"
                                                    :disabled="selectedQuestionIndex === 0"><i
                                                        class="fas fa-chevron-left"></i>
                                                    Previous </button>
                                                <button class="btn bg-main text-white mr-2" @click="nextQuestion"
                                                    :disabled="selectedQuestionIndex === latihan_soal.length - 1"> Next <i
                                                        class="fas fa-chevron-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card border-0 mb-4">
                                <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                                    <h6 class="m-0 font-weight-bold text-">Informasi </h6>
                                </div>
                                <div class="card-body">

                                    <div class="alert alert-secondary d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <i class="fas fa-circle"></i>
                                            Kosong
                                        </div>
                                    </div>
                                    <div class="alert alert-success d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <i class="fas fa-check"></i>
                                            Jawaban anda
                                        </div>
                                    </div>
                                    <div class="alert alert-primary d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <i class="fas fa-pen"></i>
                                            Kunci jawaban
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <div class="card border-0 mb-4">
                        <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 py-3 font-weight-bold text-">Pembahasan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div>
                                    <div v-if="selectedQuestion">

                                        <div class="d-flex flex-column">

                                            <p v-if="selectedQuestion.soal.kategori_soal_id == '2'"><strong>Kunci jawaban :
                                                    {{ selectedQuestion.soal.jawaban }}</strong></p>
                                            <p v-else><strong>Kunci jawaban : {{ ['A', 'B', 'C', 'D',
                                                'E'][selectedQuestion.soal.jawaban]
                                            }}</strong></p>
                                            <p><strong>Jawaban Anda : {{ ['A', 'B', 'C', 'D',
                                                'E'][selectedQuestion.jawaban_latihan ?
                                                    selectedQuestion.jawaban_latihan.jawaban : ''] }}</strong></p>
                                            <div class="question d-flex">
                                                <span v-html="selectedQuestion.soal.pembahasan"></span>
                                            </div>

                                        </div>

                                    </div>
                                    <div v-else>
                                        Loading... <!-- or any other loading indicator/message -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi selesai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah yakin ingin selesai ?
                        masih ada <strong>{{ answeredQuestions - latihan_soal.length }}</strong> soal yang belum terjawab
                    </div>
                    <div class="modal-footer">
                        <button @click="finishSegment(segment_latihan_id)" class="btn btn-success">Selesai <i
                                class="fas fa-check"></i></button>
                    </div>
                </div>
            </div>
        </div>

    </AuthenticatedLayout>
</template>

<style>
.btn-transparent:hover {
    background-color: #eeeeee5c;
}

.nomor-soal {
    width: 70px;
    height: 40px;
    box-shadow: 1px 1px 1px #eee;
}

.nomor-soal.flagged {
    background-color: #F6C23E !important;
    color: white !important;
}

.nomor-soal.answered {
    background-color: #2ccd8f;
    color: white !important;
}

.nomor-soal:hover {
    background-color: #cd2c62;
    color: white !important;
}

.bg-active {
    background-color: #cd2c62 !important;
}

.nomor-soal.active {
    background-color: #cd2c62 !important;
    color: white !important;
}

.list-soal {
    height: 260px;
    overflow: auto;
}

.pilihan {
    border-radius: 15px;
    background-color: #fff;
    box-shadow: 1px 1px 1px #eee;
    padding: 15px;
    margin-top: 10px;
    list-style-position: inside;
    cursor: pointer;
}

.pilihan:hover {
    background-color: #eee;
}
</style>


<script>

export default {
    props: {
        user: Object,
        // latihan_soal: Object,
        kelas: Object,
        kategori_soals: Object,
        id_latihan: Number,
        segment_latihan_id: Number,
        active_segment: Object,
    },
    data() {
        return {

            timerInterval: null,

            latihan_soal: [],
            selectedAnswerIndex: null,

            selectedQuestionIndex: 0,
            selectedQuestion: null,
            loading: false,
            searchResults: [] // Initialize search results as an empty array
        };
    },
    methods: {
        finishSegment(latihanId) {

            clearInterval(this.timerInterval);
            localStorage.removeItem('startTime');
            localStorage.removeItem('duration');

            // Reset the timer display
            $('#timer').text('00:00');
            this.loading = true;
            axios.post(`/api/finish_segment/${latihanId}`, {
                user_id: this.user.id,

            })
                .then(response => {
                    // console.log(response)
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    this.$inertia.visit(`/member/latihan/finish/${this.segment_latihan_id}`);

                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error(error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });
            // return '/member/latihan/konfirmasi/' + latihanId;
        },
        isQuestionAnswered(index) {
            const question = this.latihan_soal[index];

            return question.jawaban_latihan !== null;
        },
        isQuestionFlagged(index) {
            const question = this.latihan_soal[index];
            const jawaban = question.jawaban_latihan;
            return jawaban !== null && jawaban.ragu === '1';
        },
        flagQuestion(pilihanIndex, event) {
            event.stopPropagation();

            const questionId = this.selectedQuestion.soal.pilihan[pilihanIndex].soal_id;

            this.loading = true;

            axios.post(`/api/flag-latihan-answer/${this.segment_latihan_id}`, {
                questionId: questionId,
                user_id: this.user.id,

            })
                .then(response => {
                    // Handle the success response if needed
                    // console.log('Question flag successfully');
                    // Remove the question from the local array
                    this.fetchDataSoal();
                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error('Failed to flag question:', error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });
        },
        deleteFlagQuestion(pilihanIndex, event) {
            event.stopPropagation();

            const questionId = this.selectedQuestion.soal.pilihan[pilihanIndex].soal_id;

            this.loading = true;

            axios.post(`/api/delete-flag-latihan-answer/${this.segment_latihan_id}`, {
                questionId: questionId,
                user_id: this.user.id,

            })
                .then(response => {
                    // Handle the success response if needed
                    // console.log('Question flag successfully');
                    // Remove the question from the local array
                    this.fetchDataSoal();
                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error('Failed to flag question:', error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });;
        },
        removeQuestion(pilihanIndex, event) {
            event.stopPropagation();

            const questionId = this.selectedQuestion.soal.pilihan[pilihanIndex].soal_id;

            this.loading = true;

            axios.post(`/api/delete-latihan-answer/${this.segment_latihan_id}`, {
                questionId: questionId,
                user_id: this.user.id,

            })
                .then(response => {
                    // Handle the success response if needed
                    // console.log('Question removed successfully');
                    // Remove the question from the local array
                    this.fetchDataSoal();
                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error('Failed to remove question:', error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });;
        },

        jawabanKamu(questionIndex, optionIndex) {
            const question = this.latihan_soal[questionIndex];
            let jawaban = question.jawaban_latihan ? question.jawaban_latihan.jawaban : '';


            if (jawaban === optionIndex.toString()) {
                // Option is answered and should be highlighted
                return true;
            } else {
                // Option is not answered
                return false;
            }
        },

        kunciJawaban(questionIndex, optionIndex) {
            const question = this.latihan_soal[questionIndex];

            if (question.soal.jawaban === optionIndex.toString()) {
                // Option is answered and should be highlighted
                return true;
            } else {
                // Option is not answered
                return false;
            }
        },

        selectAnswer(index) {
            this.selectedAnswerIndex = index;
            const selectedAnswer = this.selectedQuestion.soal.pilihan[index];

            // Set loading state to true
            this.loading = true;

            // Save the selected answer to the database using an API call
            axios.post(`/api/save-latihan-answer/${this.segment_latihan_id}`, {
                questionId: selectedAnswer.soal_id,
                answer: this.selectedAnswerIndex,
                user_id: this.user.id,

            })
                .then(response => {
                    // Handle success response if needed
                    this.fetchDataSoal();
                })
                .catch(error => {
                    console.error(error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });
        },
        previousQuestion() {
            if (this.selectedQuestionIndex > 0) {
                this.selectedQuestionIndex--;
                this.selectedQuestion = this.latihan_soal[this.selectedQuestionIndex];
            }
        },

        nextQuestion() {
            if (this.selectedQuestionIndex < this.latihan_soal.length - 1) {
                this.selectedQuestionIndex++;
                this.selectedQuestion = this.latihan_soal[this.selectedQuestionIndex];
            }
        },
        fetchDataSoal() {
            axios.get(`/api/get-soal-latihan/${this.id_latihan}/${this.segment_latihan_id}`)
                .then(response => {
                    // Update the soal data in the component
                    this.latihan_soal = response.data;
                    // console.log(this.latihan_soal);

                    // Set the default selected question
                    this.displayQuestion(this.selectedQuestionIndex);
                })
                .catch(error => {
                    console.error(error);
                });
        },

        displayQuestion(index) {
            this.selectedQuestionIndex = index;
            this.selectedQuestion = this.latihan_soal[index];
        },
        isActiveQuestion(index) {
            return this.selectedQuestionIndex === index;
        },
    },
    mounted() {


        this.fetchDataSoal();

        const navbar = document.querySelector('.navbar-nav');
        navbar.classList.add('toggled');


    },
    computed: {
        answeredQuestions() {
            return this.latihan_soal.filter(question => question.jawaban_latihan !== null).length;
        },


    }



}
</script>
