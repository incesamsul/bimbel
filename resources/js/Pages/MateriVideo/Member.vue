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
            <h1 class="h3 mb-2 text-gray-800">Data materi_video</h1>
            <p class="mb-4">Semua data materi_video ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-3" v-for="materi_video in materi_video">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/aEPTQRUZUC4"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                            <h4 class="mt-3">{{ materi_video.judul_materi }}</h4>
                            <p><small>dibuat pada {{ formatCreatedAt(materi_video.created_at) }}</small></p>
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
        users: Object,
        materi_video: Object,
    },
    computed: {

    },
    methods: {
        formatCreatedAt(created_at) {
            const date = new Date(created_at);
            const formattedDate = date.toLocaleString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            });
            return formattedDate;
        }
    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
