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
                        <div class="card-body text-center d-flex">
                            <Link :href="'/member/tryout/history/' + this.segment_tryout.tryout.id"><i
                                class="fas fa-arrow-left mr-2"></i></Link>
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
                            <small>Total Poin</small>
                            <h3>{{ this.hasilTryout.total_poin_tiu + this.hasilTryout.total_poin_twk +
                                this.hasilTryout.total_poin_tkp }}</h3>
                            <hr>
                            <div class="d-flex justify-content-around">
                                <div class="d-flex flex-column ">
                                    <small>TIU</small>
                                    <h3>{{ this.hasilTryout.total_poin_tiu }}</h3>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>TWK</small>
                                    <h3>{{ this.hasilTryout.total_poin_twk }}</h3>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>TKP</small>
                                    <h3>{{ this.hasilTryout.total_poin_tkp }}</h3>
                                </div>
                            </div>
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
                            <small>Total Poin</small>
                            <h3>{{ this.hasilTryout.total_poin_tiu }}</h3>
                            <hr>
                            <div class="d-flex justify-content-around">
                                <div class="d-flex flex-column ">
                                    <small>BENAR</small>
                                    <h3>{{ this.hasilTryout.tiu_terjawab_benar }}</h3>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>SALAH</small>
                                    <h3>{{ this.hasilTryout.tiu_terjawab_salah }}</h3>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>KOSONG</small>
                                    <h3>{{ this.hasilTryout.tiu_tidak_terjawab }}</h3>
                                </div>
                            </div>
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
                            <div class="d-flex flex-column">
                                <div class="d-flex flex-row justify-content-between">
                                    <small>Poin 5</small>
                                    <small>{{ this.hasilTryout.poin_tkp_5 }}</small>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <small>Poin 4</small>
                                    <small>{{ this.hasilTryout.poin_tkp_4 }}</small>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <small>Poin 3</small>
                                    <small>{{ this.hasilTryout.poin_tkp_3 }}</small>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <small>Poin 2</small>
                                    <small>{{ this.hasilTryout.poin_tkp_2 }}</small>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <small>Poin 1</small>
                                    <small>{{ this.hasilTryout.poin_tkp_1 }}</small>
                                </div>
                                <div class="d-flex flex-row justify-content-between">
                                    <small>Kosong</small>
                                    <small>{{ this.hasilTryout.tkp_tidak_terjawab }}</small>
                                </div>
                                <div class="d-flex flex-row justify-content-between mt-2">
                                    <small><strong>Total Poin</strong></small>
                                    <h6>{{ this.hasilTryout.total_poin_tkp }}</h6>
                                </div>
                            </div>
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
                            <small>Total Poin</small>
                            <h3>{{ this.hasilTryout.total_poin_twk }}</h3>
                            <hr>
                            <div class="d-flex justify-content-around">
                                <div class="d-flex flex-column ">
                                    <small>BENAR</small>
                                    <h3>{{ this.hasilTryout.twk_terjawab_benar }}</h3>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>SALAH</small>
                                    <h3>{{ this.hasilTryout.twk_terjawab_salah }}</h3>
                                </div>
                                <div class="d-flex flex-column">
                                    <small>KOSONG</small>
                                    <h3>{{ this.hasilTryout.twk_tidak_terjawab }}</h3>
                                </div>
                            </div>
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
                                        <td>{{ this.hasilTryout.total_poin_tiu }}</td>
                                        <td>Gagal</td>

                                    </tr>
                                    <tr>
                                        <td>TKP</td>
                                        <td>{{ this.hasilTryout.total_poin_tkp }}</td>
                                        <td>0</td>
                                        <td>Gagal</td>

                                    </tr>
                                    <tr>
                                        <td>TWK</td>
                                        <td>{{ this.hasilTryout.total_poin_twk }}</td>
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
        hasil_tryout: String,
    },
    data() {
        return {
            hasilTryout: JSON.parse(this.hasil_tryout)
        }
    },
    computed: {

    },
    methods: {

    }, mounted() {


        let total = [this.hasilTryout.total_poin_tiu, this.hasilTryout.total_poin_tkp, this.hasilTryout.total_poin_twk];
        let tiu = [this.hasilTryout.tiu_terjawab_benar, this.hasilTryout.tiu_terjawab_salah, this.hasilTryout.tiu_tidak_terjawab];
        let tkp = [
            this.hasilTryout.poin_tkp_5,
            this.hasilTryout.poin_tkp_4,
            this.hasilTryout.poin_tkp_3,
            this.hasilTryout.poin_tkp_2,
            this.hasilTryout.poin_tkp_1,
            this.hasilTryout.tkp_tidak_terjawab,
        ];
        let twk = [this.hasilTryout.twk_terjawab_benar, this.hasilTryout.twk_terjawab_salah, this.hasilTryout.twk_tidak_terjawab];

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
                        position: 'right',
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
                        position: 'right',
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
                        'poin 5',
                        'poin 4',
                        'poin 3',
                        'poin 2',
                        'poin 1',
                        'kosong',
                    ],
                },
                options: {
                    responsive: true,
                    legend: {
                        position: 'right',
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
                        position: 'right',
                    },
                }
            });
        }


    }
}
</script>
