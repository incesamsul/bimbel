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
      <h1 class="h3 mb-2 text-gray-800">Data latihan</h1>
      <p class="mb-4">Semua data latihan ada dihalaman ini.</p>

      <!-- DataTales Example -->
      <div class="card border-0 mb-4">
        <div
          class="card-header py-3 bg-white d-flex justify-content-between align-items-center"
        >
          <h6 class="m-0 font-weight-bold text-">Data latihan</h6>
          <Link href="/latihan/create" class="btn btn-light">
            <i class="fas fa-plus"></i
          ></Link>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table
              class="table table-bordered"
              id="dataTable"
              width="100%"
              cellspacing="0"
            >
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nama latihan</th>
                  <th>Kategori</th>
                  <th>Kelas</th>
                  <th>mulai</th>
                  <th>durasi</th>
                  <th>Pembahasan</th>
                  <th>soal</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="latihan in latihan">
                  <td>{{ latihan.id }}</td>
                  <td>{{ latihan.nama_latihan }}</td>
                  <td>{{ latihan.kategori_soal.nama }}</td>
                  <td>{{ latihan.kelas.nama_kelas }}</td>
                  <td>{{ latihan.mulai }}</td>
                  <td>{{ latihan.durasi }} m</td>
                  <td>
                    <span
                      v-if="latihan.pembahasan == '0'"
                      class="cursor-pointer badge badge-danger"
                      @click="aktifkanPembahasan(latihan.id)"
                    >
                      Tidak
                    </span>
                    <span
                      v-else
                      class="cursor-pointer badge badge-info"
                      @click="nonAktifkanPembahasan(latihan.id)"
                      >Ya</span
                    >
                  </td>
                  <td>
                    {{ latihan.latihan_soal.length }}
                    <Link
                      :href="'/latihan_soal/' + latihan.id"
                      class="badge badge-primary"
                      >Lihat</Link
                    >
                  </td>
                  <td>
                    <span
                      @click="deletelatihan(latihan.id)"
                      class="badge badge-danger cursor-pointer"
                    >
                      <i class="fas fa-trash"></i>
                    </span>
                    <Link
                      :href="'latihan/edit/' + latihan.id"
                      class="badge badge-warning cursor-pointer ml-2"
                    >
                      <i class="fas fa-pen"></i>
                    </Link>
                  </td>
                </tr>
              </tbody>
            </table>
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
    latihan: Object,
  },
  computed: {},
  methods: {
    aktifkanPembahasan(id_latihan) {
      axios
        .put(`/latihan/aktifkan-pembahasan/${id_latihan}`)
        .then((response) => {
          // Handle success response
          console.log(response);
          showFlashMessage(response.data.message);
          this.$inertia.visit(route("latihan"));
        })
        .catch((error) => {
          // Handle error response
          console.error(error);
        });
    },
    nonAktifkanPembahasan(id_latihan) {
      axios
        .put(`/latihan/non-aktifkan-pembahasan/${id_latihan}`)
        .then((response) => {
          // Handle success response
          console.log(response);
          showFlashMessage(response.data.message);
          this.$inertia.visit(route("latihan"));
        })
        .catch((error) => {
          // Handle error response
          console.error(error);
        });
    },
    deletelatihan(id_latihan) {
      if (confirm("yakin ingin menghapus data ?")) {
        axios
          .delete(`/latihan/${id_latihan}`)
          .then((response) => {
            // Handle success response
            console.log(response);
            showFlashMessage(response.data.message);
            this.$inertia.visit(route("latihan"));
          })
          .catch((error) => {
            // Handle error response
            console.error(error);
          });
      }
    },
  },
  mounted() {
    // Initialize DataTables
    $("#dataTable").DataTable({
      // DataTables configuration options
    });
  },
};
</script>
