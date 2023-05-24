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
            <h1 class="h3 mb-2 text-gray-800">Summary tryout</h1>
            <p class="mb-4">Berikut hasil tryout anda.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-body text-center">
                            <h4>Maaf, Anda tidak lulus</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Total</h5>
                        </div>
                        <div class="card-body text-center">
                            <canvas height="350" id="totalChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>TIU</h5>
                        </div>
                        <div class="card-body text-center">
                            <canvas height="350" id="tiuChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>TKP</h5>
                        </div>
                        <div class="card-body text-center">
                            <canvas height="350" id="tkpChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>TWK</h5>
                        </div>
                        <div class="card-body text-center">
                            <canvas height="350" id="twkChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-sm-6">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Passing grade</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Passing grade</th>
                                        <th>Nilai</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiu</td>
                                        <td>80</td>
                                        <td>0</td>
                                        <td>Gagal</td>

                                    </tr>
                                    <tr>
                                        <td>TKP</td>
                                        <td>126</td>
                                        <td>0</td>
                                        <td>Gagal</td>

                                    </tr>
                                    <tr>
                                        <td>TWK</td>
                                        <td>65</td>
                                        <td>0</td>
                                        <td>Gagal</td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border-0">
                        <div class="card-header bg-white">
                            <h5>Informasi durasi pengerjaan</h5>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Durasi</th>
                                        <th>Rata rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiu</td>
                                        <td>80</td>
                                        <td>0</td>


                                    </tr>
                                    <tr>
                                        <td>TKP</td>
                                        <td>126</td>
                                        <td>0</td>


                                    </tr>
                                    <tr>
                                        <td>TWK</td>
                                        <td>65</td>
                                        <td>0</td>


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
    props: {
        user: Object,
        segment_tryout: Object,
    },
    computed: {

    },
    methods: {

    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });

        let total = [10, 30, 5];
        let tiu = [24, 30, 5];
        let tkp = [77, 30, 5];
        let twk = [0, 0, 25];

        var ctx = document.getElementById("totalChart");
        if (ctx) {
            var myChart = new Chart(ctx, {
                aspectRatio: 1,
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: total,
                        backgroundColor: [
                            '#6777ef', '#63ed7a', '#ffa426', '#fc544b', '#6777ef',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'tiu',
                        'tkp',
                        'twk'
                    ],
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                }
            });
        }

        var ctx = document.getElementById("tiuChart");
        if (ctx) {
            var myChart = new Chart(ctx, {
                aspectRatio: 1,
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: tiu,
                        backgroundColor: [
                            '#6777ef', '#63ed7a', '#ffa426', '#fc544b', '#6777ef',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'benar',
                        'salah',
                        'kosong'
                    ],
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                }
            });
        }


        var ctx = document.getElementById("tkpChart");
        if (ctx) {
            var myChart = new Chart(ctx, {
                aspectRatio: 1,
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: tkp,
                        backgroundColor: [
                            '#6777ef', '#63ed7a', '#ffa426', '#fc544b', '#6777ef',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'benar',
                        'salah',
                        'kosong'
                    ],
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                }
            });
        }


        var ctx = document.getElementById("twkChart");
        if (ctx) {
            var myChart = new Chart(ctx, {
                aspectRatio: 1,
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: twk,
                        backgroundColor: [
                            '#6777ef', '#63ed7a', '#ffa426', '#fc544b', '#6777ef',
                        ],
                        label: 'Dataset 1'
                    }],
                    labels: [
                        'benar',
                        'salah',
                        'kosong'
                    ],
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'bottom',
                    },
                }
            });
        }


    }
}
</script>
