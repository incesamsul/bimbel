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
                                                :key="pilihanIndex" @click="selectAnswer(pilihanIndex)" :class="{
                                                    'bg-success text-white': isOptionAnswered(selectedQuestionIndex, pilihanIndex),
                                                    'bg-warning text-white': isOptionFlagged(selectedQuestionIndex, pilihanIndex)
                                                }">
                                                <div class="options-warpper">
                                                    {{ ['A', 'B', 'C', 'D', 'E'][pilihanIndex] }}. {{ pilihan.pilihan }}
                                                </div>
                                                <template v-if="isOptionAnswered(selectedQuestionIndex, pilihanIndex)">
                                                    <div class="button-wrapper">
                                                        <button class="btn btn-transparent "
                                                            @click="removeQuestion(pilihanIndex, $event)">
                                                            <i class="fas fa-times text-white"></i>
                                                        </button>
                                                        <template
                                                            v-if="isOptionFlagged(selectedQuestionIndex, pilihanIndex)">
                                                            <button class="btn btn-transparent ml-2"
                                                                @click="deleteFlagQuestion(pilihanIndex, $event)">
                                                                <i class="fas fa-flag text-white"></i>
                                                            </button>
                                                        </template>
                                                        <template v-else>
                                                            <button class="btn btn-success ml-2"
                                                                @click="flagQuestion(pilihanIndex, $event)">
                                                                <i class="fas fa-flag text-white"></i>
                                                            </button>
                                                        </template>
                                                    </div>
                                                </template>
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
                                            <div v-for="(item, index) in tryout_soal" :key="item.id">
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
                                                    :disabled="selectedQuestionIndex === tryout_soal.length - 1"> Next <i
                                                        class="fas fa-chevron-right"></i></button>
                                                <button class="btn bg-warning text-white mr-2"><i class="fas fa-flag"></i>
                                                    Ragu</button>
                                                <button data-toggle="modal" data-target="#exampleModal"
                                                    class="btn btn-success">Selesai <i class="fas fa-check"></i></button>

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

                                    <div class="alert alert-warning d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <i class="fas fa-flag"></i>
                                            Ragu
                                        </div>
                                        <span>{{ flaggedQuestions }}</span>
                                    </div>
                                    <div class="alert alert-success d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <i class="fas fa-check"></i>
                                            Dijawab
                                        </div>
                                        <span>{{ answeredQuestions - flaggedQuestions }}</span>
                                    </div>
                                    <div class="alert alert-danger d-flex justify-content-between align-items-center">
                                        <div class="content">
                                            <i class="fas fa-pen"></i>
                                            Jumlah soal
                                        </div>
                                        <span>{{ tryout_soal.length }}</span>
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
                        masih ada <strong>{{ answeredQuestions - tryout_soal.length }}</strong> soal yang belum terjawab
                    </div>
                    <div class="modal-footer">
                        <button @click="finishSegment(segment_tryout_id)" class="btn btn-success">Selesai <i
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
        // tryout_soal: Object,
        kelas: Object,
        kategori_soals: Object,
        id_tryout: Number,
        segment_tryout_id: Number,
        active_segment: Object,
    },
    data() {
        return {

            timerInterval: null,

            tryout_soal: [],
            selectedAnswerIndex: null,

            selectedQuestionIndex: 0,
            selectedQuestion: null,
            loading: false,
            searchResults: [] // Initialize search results as an empty array
        };
    },
    methods: {
        finishSegment(tryoutId) {

            clearInterval(this.timerInterval);
            localStorage.removeItem('startTime');
            localStorage.removeItem('duration');

            // Reset the timer display
            $('#timer').text('00:00');
            this.loading = true;
            axios.post(`/api/finish_segment/${tryoutId}`, {
                user_id: this.user.id,

            })
                .then(response => {
                    // console.log(response)
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    this.$inertia.visit(`/member/tryout/finish/${this.segment_tryout_id}`);

                })
                .catch(error => {
                    // Handle the error response if needed
                    console.error(error);
                }).finally(() => {
                    // Set loading state to false
                    this.loading = false;
                });
            // return '/member/tryout/konfirmasi/' + tryoutId;
        },
        isQuestionAnswered(index) {
            const question = this.tryout_soal[index];

            return question.jawaban_tryout !== null;
        },
        isQuestionFlagged(index) {
            const question = this.tryout_soal[index];
            const jawaban = question.jawaban_tryout;
            return jawaban !== null && jawaban.ragu === '1';
        },
        flagQuestion(pilihanIndex, event) {
            event.stopPropagation();

            const questionId = this.selectedQuestion.soal.pilihan[pilihanIndex].soal_id;

            this.loading = true;

            axios.post(`/api/flag-tryout-answer/${this.segment_tryout_id}`, {
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

            axios.post(`/api/delete-flag-tryout-answer/${this.segment_tryout_id}`, {
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

            axios.post(`/api/delete-tryout-answer/${this.segment_tryout_id}`, {
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
        isOptionFlagged(questionIndex, optionIndex) {
            const question = this.tryout_soal[questionIndex];
            let jawaban = question.jawaban_tryout ? question.jawaban_tryout.jawaban : '';

            let ragu = question.jawaban_tryout ? question.jawaban_tryout.ragu : 0;

            if (jawaban === optionIndex.toString() && ragu == '1') {
                // Option is answered and should be highlighted
                return true;
            } else {
                // Option is not answered
                return false;
            }
        },
        isOptionAnswered(questionIndex, optionIndex) {
            const question = this.tryout_soal[questionIndex];
            let jawaban = question.jawaban_tryout ? question.jawaban_tryout.jawaban : '';


            if (jawaban === optionIndex.toString()) {
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
            axios.post(`/api/save-tryout-answer/${this.segment_tryout_id}`, {
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
                this.selectedQuestion = this.tryout_soal[this.selectedQuestionIndex];
            }
        },

        nextQuestion() {
            if (this.selectedQuestionIndex < this.tryout_soal.length - 1) {
                this.selectedQuestionIndex++;
                this.selectedQuestion = this.tryout_soal[this.selectedQuestionIndex];
            }
        },
        fetchDataSoal() {
            axios.get(`/api/get-soal/${this.id_tryout}/${this.segment_tryout_id}`)
                .then(response => {
                    // Update the soal data in the component
                    this.tryout_soal = response.data;
                    // console.log(this.tryout_soal);

                    // Set the default selected question
                    this.displayQuestion(this.selectedQuestionIndex);
                })
                .catch(error => {
                    console.error(error);
                });
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

        const navbar = document.querySelector('.navbar-nav');
        navbar.classList.add('toggled');


    },
    computed: {
        answeredQuestions() {
            return this.tryout_soal.filter(question => question.jawaban_tryout !== null).length;
        },
        flaggedQuestions() {

            let flaggedCount = 0;

            for (let i = 0; i < this.tryout_soal.length; i++) {
                if (this.isQuestionFlagged(i)) {
                    flaggedCount++;
                }
            }

            return flaggedCount;

        }

    }



}
</script>
