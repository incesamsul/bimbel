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
