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
            <h1 class="h3 mb-2 text-gray-800">Data paket_video</h1>
            <p class="mb-4">Semua data paket_video ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data {{ paket_video.nama_paket }}</h6>
                            <Link href="/paket_video" class="btn btn-light"> <i class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-7">
                    <div class="card border-0">
                        <div
                            class="card-header bg-white main-radius d-flex flex-row justify-content-between align-items-center">
                            <h4>Video dalam paket</h4>
                            <!-- Show loading indicator -->
                            <template v-if="loading">
                                <i class="fas fa-circle-notch fa-spin"></i>
                            </template>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3 mt-3" v-for="paket in paket_video">
                                    <div class="card p-0 overflow-hidden border-0 shadow-sm">
                                        <div class="card-body p-0 ">
                                            <div class="video-container">
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/TrfvMuBfaCE"
                                                    title="YouTube video player" frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    allowfullscreen></iframe>
                                            </div>
                                            <div class="p-3 d-flex justify-content-between align-items-center flex-row">
                                                <small>{{ paket.video.judul_materi }}</small>
                                                <span @click="deleteVideo(paket.video.id)"
                                                    class="text-danger cursor-pointer"><i class="fas fa-trash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="card border-0">
                        <div class="card-header bg-white main-radius">
                            <h4>List video</h4>
                            <div class="button-wrapper">
                                <span @click="addVideo" class="btn btn-light">
                                    Simpan
                                </span>
                                <input class="hide" id="selectAll" type="checkbox" v-model="selectAll"
                                    @change="toggleSelectAll">
                                <label for="selectAll" class="cursor-pointer ml-3 btn btn-light mt-2">Pilih semua</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div v-for="item in videos"
                                :class="['alert', 'alert-secondary', 'd-flex', 'align-items-center', 'flex-row', 'cursor-pointer', { 'bg-main text-white': item.selected }]"
                                @click="toggleSelection(item)">
                                <span><i class="fas fa-video"></i></span>
                                <span class="ml-3">{{ item.judul_materi }} ( {{ item.kategori.kode }} )</span>
                            </div>
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
        id_paket_video: Number,
    },
    computed: {

    },
    data() {
        return {
            videos: [],
            selectAll: false,
            selectedId: [],
            loading: false,
            paket_video: [],
        };
    },
    methods: {
        deleteVideo(id_video) {
            this.loading = true;
            axios.delete(`/api/paket-video/delete-video/${id_video}`)
                .then(response => {
                    // Update the soal data in the component
                    console.log(response);
                    this.fetchDataPaket();
                    showFlashMessage(response.data.message);
                })
                .catch(error => {
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });

        },
        addVideo() {
            this.loading = true;
            axios.post('/api/paket-video/add-video', {
                id_materi_video: this.selectedId,
                id_paket_video: this.id_paket_video,
            })
                .then(response => {
                    // Handle the response from the server
                    showFlashMessage(response.data.message);
                    this.fetchDataPaket();
                    console.log(response.data);
                })
                .catch(error => {
                    // Handle any errors
                    console.error(error);
                }).finally(() => {
                    this.loading = false; // reset loading flag
                });
        },
        fetchVideoData() {
            axios.get('/api/get-videos')
                .then((response) => {
                    this.videos = response.data;
                })
                .catch((error) => {
                    console.error('Error loading video data:', error);
                });
        },
        toggleSelectAll() {
            this.videos.forEach(result => {
                result.selected = this.selectAll;
                if (this.selectAll && !this.selectedId.includes(result.id)) {
                    this.selectedId.push(result.id); // Add the selected ID to the array
                } else if (!this.selectAll) {
                    const index = this.selectedId.indexOf(result.id);
                    if (index !== -1) {
                        this.selectedId.splice(index, 1); // Remove the unselected ID from the array
                    }
                }
            });
        },
        toggleSelection(result) {
            result.selected = !result.selected;
            if (result.selected) {
                this.selectedId.push(result.id); // Add the selected ID to the array
            } else {
                const index = this.selectedId.indexOf(result.id);
                if (index !== -1) {
                    this.selectedId.splice(index, 1); // Remove the unselected ID from the array
                }
            }

            // Check if all items are selected to update the "Select All" checkbox
            this.selectAll = this.videos.every(result => result.selected);
        },
        fetchDataPaket() {
            axios.get(`/api/get-video-paket/${this.id_paket_video}`)
                .then(response => {
                    // Update the soal data in the component
                    this.paket_video = response.data;
                    console.log(this.paket_video);
                })
                .catch(error => {
                    console.error(error);
                });

        },
    }, mounted() {
        this.fetchVideoData();
        this.fetchDataPaket();


    }
}
</script>
