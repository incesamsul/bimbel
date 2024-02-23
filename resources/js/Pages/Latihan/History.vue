<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";
import { showFlashMessage } from "@/global_func.js";
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout :user="user">
    <div class="container-fluid">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">History latihan</h1>
      <p class="mb-4">Semua data latihan ada dihalaman ini.</p>

      <div class="row">
        <div class="col-sm-12">
          <div class="card border-0 pb-4">
            <div class="card-header bg-white d-flex justify-content-between">
              <h5>History latihan</h5>
              <Link @click="goBack" class="btn btn-light">
                <i class="fas fa-arrow-left"></i>
              </Link>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <!-- <th>Tiu</th>
                                        <th>Tkp</th>
                                        <th>Twk</th>
                                        <th>Total</th> -->
                    <th>Durasi</th>
                    <!-- <th>Keterangan</th> -->
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="item in history">
                    <td>{{ item.mulai }}</td>
                    <td>{{ item.selesai }}</td>
                    <!-- <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td> -->
                    <td>{{ item.durasi }}</td>
                    <!-- <td>gagal</td> -->
                    <td>
                      <Link
                        class="btn btn-info"
                        :href="'/member/latihan/finish/' + item.id"
                        >Hasil
                      </Link>
                      <Link
                        class="btn btn-success ml-2"
                        :href="'/member/latihan/review/' + item.id"
                      >
                        Review
                      </Link>
                    </td>
                  </tr>
                </tbody>
              </table>
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
      loading: false,
    };
  },
  props: {
    user: Object,
    users: Object,
    history: Object,
  },
  computed: {},
  methods: {
    goBack() {
      window.history.back();
    },
  },
  mounted() {
    // Initialize DataTables
    $("#dataTable").DataTable({
      // DataTables configuration options
    });

    showFlashMessage("Anda tidak memiliki akses ke halaman ini");
  },
};
</script>
