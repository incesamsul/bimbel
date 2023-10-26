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
            <h1 class="h3 mb-2 text-gray-800">Rank tryout</h1>
            <p class="mb-4">Rank tryout ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 pb-4">
                        <div class="card-header bg-white d-flex justify-content-between">
                            <h5>Rank tryout</h5>
                            <Link @click="goBack" class="btn btn-light">
                            <i class="fas fa-arrow-left"></i>
                            </Link>

                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-striped" id="dataTable">
                                <thead>
                                    <tr>
                                        <th>Rank</th>
                                        <th>Nama</th>
                                        <th>Tiu</th>
                                        <th>Tkp</th>
                                        <th>Twk</th>
                                        <th>Total</th>
                                        <th>Ketarangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in tryout_result">
                                        <td>{{ index + 1 }}</td>
                                        <td>{{ item.user.name }}</td>
                                        <td>{{ item.tiu }}</td>
                                        <td>{{ item.tkp }}</td>
                                        <td>{{ item.twk }}</td>
                                        <td>{{ item.total }}</td>
                                        <td>
                                            {{ checkLulus(item.tiu, item.tkp, item.twk) }}
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                            <!-- <div v-html="pagination_links"></div> -->

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
        }
    },
    props: {
        user: Object,
        users: Object,
        tryout_result: Object,
        pagination_links: String,
        passing_grade_tiu : Number,
        passing_grade_tkp : Number,
        passing_grade_twk : Number,
    },
    computed: {

    },
    methods: {
        checkLulus(tiu, tkp, twk) {
            if (tiu >= this.passing_grade_tiu && tkp >= this.passing_grade_tkp && twk >= this.passing_grade_twk) {
                return 'Lulus';
            } else {
                return 'TIDAK LULUS';
            }
        },
        goBack() {
            window.history.back();
        },
    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
