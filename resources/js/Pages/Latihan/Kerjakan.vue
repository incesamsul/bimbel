<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";
import { showFlashMessage } from "@/global_func.js";
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout :user="user">
    <div class="container-fluid" id="container-kerjakan">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">Data soal latihan</h1>
      <p class="mb-4">Semua data soal ada dihalaman ini.</p>

      <div class="row">
        <div class="col-sm-8">
          <div class="card border-0 mb-4">
            <div
              class="card-header py-3 bg-white d-flex justify-content-between align-items-center"
            >
              <h6 class="m-0 py-3 font-weight-bold text-">List soal</h6>
              <!-- Show loading indicator when loading is true -->
              <div
                v-if="loading"
                class="spinner-border text-primary"
                role="status"
              >
                <span class="sr-only">Loading...</span>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <div>
                  <div v-if="selectedQuestion">
                    <div class="d-flex justify-content-between">
                      <div class="question d-flex">
                        <span class="mr-3"
                          >{{ selectedQuestionIndex + 1 }}.
                        </span>
                        <span
                          v-html="selectedQuestion.soal.pertanyaan.trim()"
                        ></span>
                      </div>
                    </div>
                    <ul class="ml-0 pl-0">
                      <li
                        type="A"
                        class="pilihan d-flex justify-content-between align-items-center"
                        v-for="(pilihan, pilihanIndex) in selectedQuestion.soal
                          .pilihan"
                        :key="pilihanIndex"
                        @click="selectAnswer(pilihanIndex)"
                        :class="{
                          'bg-success text-white': isOptionAnswered(
                            selectedQuestionIndex,
                            pilihanIndex
                          ),
                          'bg-success-h text-white': isHightlited(pilihanIndex),
                        }"
                      >
                        <div class="options-warpper">
                          {{ ["A", "B", "C", "D", "E"][pilihanIndex] }}.
                          {{ pilihan.pilihan }}
                        </div>
                        <template
                          v-if="
                            isHightlited(pilihanIndex) ||
                            isOptionAnswered(
                              selectedQuestionIndex,
                              pilihanIndex
                            )
                          "
                        >
                          <div class="button-wrapper">
                            <button
                              class="btn btn-transparent"
                              @click="removeQuestion(pilihanIndex, $event)"
                            >
                              <i class="fas fa-times text-white"></i>
                            </button>
                          </div>
                        </template>
                      </li>
                    </ul>
                  </div>
                  <div v-else>
                    Loading...
                    <!-- or any other loading indicator/message -->
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
                <div
                  class="card-header py-3 bg-white d-flex justify-content-between align-items-center"
                >
                  <h6 class="m-0 font-weight-bold text-">Sisa Waktu</h6>
                  <h6><i class="far fa-hourglass"></i></h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center">
                      <h3>
                        <strong>
                          <div id="timer"></div>
                          <div id="ket"></div>
                        </strong>
                      </h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card border-0 mb-4">
                <div
                  class="card-header py-3 bg-white d-flex justify-content-between align-items-center"
                >
                  <h6 class="m-0 font-weight-bold text-">Nomor soal</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12 d-flex flex-wrap">
                      <div v-for="(item, index) in latihan_soal" :key="item.id">
                        <button
                          class="text-danger nomor-soal btn mr-2 mt-2 p-3 d-flex justify-content-center align-items-center"
                          @click="displayQuestion(index)"
                          :class="{
                            active: selectedQuestionIndex === index,
                            answered: isQuestionAnswered(index),
                          }"
                        >
                          <strong>{{ index + 1 }}</strong>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-3">
                    <div class="col-sm-12">
                      <div class="d-flex justify-content-center">
                        <button
                          class="btn bg-main text-white mr-2"
                          @click="previousQuestion"
                          :disabled="selectedQuestionIndex === 0"
                        >
                          <i class="fas fa-chevron-left"></i> Previous
                        </button>
                        <button
                          class="btn bg-main text-white mr-2"
                          @click="nextQuestion"
                          :disabled="
                            selectedQuestionIndex === latihan_soal.length - 1
                          "
                        >
                          Next <i class="fas fa-chevron-right"></i>
                        </button>
                        <button class="btn bg-warning text-white mr-2">
                          <i class="fas fa-flag"></i> Ragu
                        </button>
                        <button
                          data-toggle="modal"
                          data-target="#exampleModal"
                          class="btn btn-success"
                        >
                          Selesai <i class="fas fa-check"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-12">
              <div class="card border-0 mb-4">
                <div
                  class="card-header py-3 bg-white d-flex justify-content-between align-items-center"
                >
                  <h6 class="m-0 font-weight-bold text-">Informasi</h6>
                </div>
                <div class="card-body">
                  <div
                    class="alert alert-warning d-flex justify-content-between align-items-center"
                  >
                    <div class="content">
                      <i class="fas fa-flag"></i>
                      Ragu
                    </div>
                  </div>
                  <div
                    class="alert alert-success d-flex justify-content-between align-items-center"
                  >
                    <div class="content">
                      <i class="fas fa-check"></i>
                      Dijawab
                    </div>
                    <span>{{ userAnswers.length }}</span>
                  </div>
                  <div
                    class="alert alert-danger d-flex justify-content-between align-items-center"
                  >
                    <div class="content">
                      <i class="fas fa-pen"></i>
                      Jumlah soal
                    </div>
                    <span>{{ latihan_soal.length }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              Konfirmasi selesai
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Apakah yakin ingin selesai ? masih ada
            <strong>{{ userAnswers.length - latihan_soal.length }}</strong> soal
            yang belum terjawab
          </div>
          <div class="modal-footer">
            <button
              @click="finishSegment(segment_latihan_id)"
              class="btn btn-success"
            >
              Selesai <i class="fas fa-check"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style>
#container-kerjakan img {
  width: 100% !important;
}

.btn-transparent:hover {
  background-color: #eeeeee5c;
}

.nomor-soal {
  width: 70px;
  height: 40px;
  box-shadow: 1px 1px 1px #eee;
}

.nomor-soal.flagged {
  background-color: #f6c23e !important;
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
      userAnswers: JSON.parse(localStorage.getItem("userAnswers")) || [],
      searchResults: [], // Initialize search results as an empty array
    };
  },

  methods: {
    updateUserAnswersCount() {
      this.userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];
    },
    updateUserAnswersCount() {
      this.userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];
    },
    isQuestionAnswered(index) {
      const question = this.latihan_soal[index];

      // Get existing answers from local storage or initialize an empty array
      let userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];

      // Check if there is an answer for the current question in the local storage
      const answered = userAnswers.some(
        (answer) => answer.soal_id === question.soal_id
      );

      return answered;
    },

    removeQuestion(pilihanIndex, event) {
      event.stopPropagation();

      console.log("tyring to remove");
      this.highlight = false;

      // Get the question ID to identify the answer to remove
      const questionId =
        this.selectedQuestion.soal.pilihan[pilihanIndex].soal_id;

      // Get existing answers from local storage or initialize an empty array
      let userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];

      // Find the index of the answer to remove in userAnswers
      const answerIndexToRemove = userAnswers.findIndex(
        (answer) => answer.soal_id === questionId
      );

      if (answerIndexToRemove !== -1) {
        // If an answer for the question exists, remove it from the array
        userAnswers.splice(answerIndexToRemove, 1);

        // Store the updated answers back in local storage
        localStorage.setItem("userAnswers", JSON.stringify(userAnswers));
      }
    },

    isOptionAnswered(questionIndex, optionIndex) {
      const question = this.latihan_soal[questionIndex];

      // Get existing answers from local storage or initialize an empty array
      let userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];

      // Find the answer for the current question in the local storage
      const answeredQuestion = userAnswers.find(
        (answer) => answer.soal_id === question.soal_id
      );

      if (answeredQuestion) {
        // Check if the option's ID matches the ID in the answeredQuestion
        const selectedOptionId = question.soal.pilihan[optionIndex].id;

        if (answeredQuestion.id === selectedOptionId) {
          // Option is answered
          return true;
        }
      }

      // Option is not answered
      return false;
    },

    isHightlited(pilihanIndex) {
      if (pilihanIndex == this.selectedAnswerIndex) {
        return this.highlight;
      }
    },

    selectAnswer(index) {
      this.selectedAnswerIndex = index;
      const selectedAnswer = this.selectedQuestion.soal.pilihan[index];

      // Set loading state to true
      this.highlight = true;

      // Get existing answers from local storage or initialize an empty array
      let userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];

      // Find the index of the selectedAnswer in userAnswers, if it exists
      const existingAnswerIndex = userAnswers.findIndex(
        (answer) => answer.soal_id === selectedAnswer.soal_id
      );

      if (existingAnswerIndex !== -1) {
        // If it exists, update the answer
        userAnswers[existingAnswerIndex] = {
          ...selectedAnswer,
          answerOption: index, // Store the selected option index (e.g., 0 for "A")
        };
      } else {
        // If it's not in the array, add the selected answer with answerOption
        userAnswers.push({
          ...selectedAnswer,
          answerOption: index,
        });
      }

      // Store answers in local storage as an array
      localStorage.setItem("userAnswers", JSON.stringify(userAnswers));

      // Log the updated userAnswers for debugging
      console.log("userAnswers:", userAnswers);

      // You can also handle other operations related to your API call and loading state here.
    },

    previousQuestion() {
      this.updateUserAnswersCount();

      this.highlight = false;

      if (this.selectedQuestionIndex > 0) {
        this.selectedQuestionIndex--;
        this.selectedQuestion = this.latihan_soal[this.selectedQuestionIndex];
      }
      $("#input").val(this.selectedQuestion.soal.pertanyaan);
      if (this.selectedQuestion.soal.kategori_soal_id == "1") {
        this.renderEquations();
      }
    },

    nextQuestion() {
      this.updateUserAnswersCount();

      this.highlight = false;

      if (this.selectedQuestionIndex < this.latihan_soal.length - 1) {
        this.selectedQuestionIndex++;
        this.selectedQuestion = this.latihan_soal[this.selectedQuestionIndex];
      }
      $("#input").val(this.selectedQuestion.soal.pertanyaan);
      if (this.selectedQuestion.soal.kategori_soal_id == "1") {
        this.renderEquations();
      }
    },
    fetchDataSoal() {
      axios
        .get(
          `/api/get-soal-latihan/${this.id_latihan}/${this.segment_latihan_id}`
        )
        .then((response) => {
          // Update the soal data in the component
          this.latihan_soal = response.data;
          // console.log(this.latihan_soal);

          // Set the default selected question
          this.displayQuestion(this.selectedQuestionIndex);
        })
        .catch((error) => {
          console.error(error);
        });
    },

    displayQuestion(index) {
      this.updateUserAnswersCount();
      this.highlight = false;

      this.selectedQuestionIndex = index;
      this.selectedQuestion = this.latihan_soal[index];
      $("#input").val(this.selectedQuestion.soal.pertanyaan);
      if (this.selectedQuestion.soal.kategori_soal_id == "1") {
        this.renderEquations();
      }
      console.log(this);
    },
    isActiveQuestion(index) {
      return this.selectedQuestionIndex === index;
    },

    renderEquations() {
      console.log("WRER");
      const script = document.createElement("script");
      script.type = "text/javascript";
      script.async = true;
      script.src = "https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml.js";
      document.head.appendChild(script);

      script.onload = () => {
        this.doRenderEquations();
      };
    },
    doRenderEquations() {
      if (window.MathJax && window.MathJax.typeset) {
        // Use this.$refs.equation instead of querySelector
        const elements = this.$refs.equation;
        console.log(elements);
        window.MathJax.typeset(elements);
      }
    },

    finishSegment(latihanId) {
      clearInterval(this.timerInterval);
      localStorage.removeItem("startTime");
      localStorage.removeItem("duration");

      // Reset the timer display
      $("#timer").text("00:00");
      this.loading = true;

      let userAnswers = JSON.parse(localStorage.getItem("userAnswers")) || [];

      axios
        .post(`/api/finish_segment_latihan/${latihanId}`, {
          user_id: this.user.id,
          answer: userAnswers,
        })
        .then((response) => {
          // console.log(response)
          $("body").removeClass("modal-open");
          $(".modal-backdrop").remove();

          localStorage.removeItem("userAnswers");
          this.$inertia.visit(
            `/member/latihan/finish/${this.segment_latihan_id}`
          );
        })
        .catch((error) => {
          // Handle the error response if needed
          console.error(error);
        })
        .finally(() => {
          // Set loading state to false
          this.loading = false;
        });
      // return '/member/latihan/konfirmasi/' + latihanId;
    },
  },

  mounted() {
    let durasi_menit = this.active_segment.latihan.durasi;
    let durasi_seconds = durasi_menit * 60;

    let self = this;

    this.fetchDataSoal();

    const navbar = document.querySelector(".navbar-nav");
    navbar.classList.add("toggled");

    // Check if the timer is already running
    var startTime = localStorage.getItem("startTime");
    var duration = localStorage.getItem("duration");
    var interval;

    if (startTime && duration) {
      // Calculate the remaining time
      var elapsedTime = Math.floor((Date.now() - startTime) / 1000);
      var remainingTime = Math.max(duration - elapsedTime, 0);
      startTimer(remainingTime);
    } else {
      // Set the exam duration in seconds (e.g., 10 minutes = 600 seconds)
      var examDuration = durasi_seconds;
      startTimer(examDuration);
    }

    function startTimer(seconds) {
      // Store the start time and duration
      localStorage.setItem("startTime", Date.now());
      localStorage.setItem("duration", seconds);

      // Start the countdown
      self.timerInterval = setInterval(function () {
        // Update the display
        var minutes = Math.floor(seconds / 60);
        var remainingSeconds = seconds % 60;
        $("#timer").text(
          minutes + ":" + remainingSeconds.toString().padStart(2, "0")
        );

        // Check if the timer has reached zero
        if (seconds <= 0) {
          clearInterval(self.timerInterval);
          $("#timer").text("Time is up!");
          localStorage.removeItem("startTime");
          localStorage.removeItem("duration");
          self.finishSegment(self.segment_latihan_id);
          // Perform actions when time is up (e.g., close the exam)
          // ...
        }

        seconds--;
      }, 1000);
    }
  },
  computed: {
    answeredQuestions() {
      return this.latihan_soal.filter(
        (question) => question.jawaban_latihan !== null
      ).length;
    },
    flaggedQuestions() {
      let flaggedCount = 0;

      for (let i = 0; i < this.latihan_soal.length; i++) {
        if (this.isQuestionFlagged(i)) {
          flaggedCount++;
        }
      }

      return flaggedCount;
    },
  },
};
</script>
