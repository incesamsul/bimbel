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
            <h1 class="h3 mb-2 text-gray-800">Data paket_text</h1>
            <p class="mb-4">Semua data paket_text ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data paket_text</h6>
                            <Link href="/paket_text/create" class="btn btn-light"> <i class="fas fa-plus"></i></Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-body p-5">
                            <div class="row">
                                <Link :href="'paket_text/' + item.id" class="col-6 col-sm-4 col-md-2 folder-col"
                                    v-for="item in paket_text">
                                <i class="fas fa-folder text-info item" :data-id="item.id"></i>
                                <p>{{ item.nama_paket }}</p>
                                </Link>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <ul class='menu'>
            <li class='menu-item btn-delete'>
                <i class="menu-icon fas fa-trash"></i>
                <span class='menu-option'>delete</span>
            </li>
            <hr>
            <li class='menu-item exit'>
                <i class="menu-icon fas fa-sign-out-alt"></i>
                <span class='menu-option'>exit</span>
            </li>
        </ul>


    </AuthenticatedLayout>
</template>

<script>



export default {
    props: {
        user: Object,
        users: Object,
        paket_text: Object,
    },
    computed: {

    },
    methods: {
        deletepaket_text(id_paket_text) {
            if (confirm('yakin ingin menghapus data ?')) {
                axios.delete(`/paket_text/${id_paket_text}`)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('paket_text'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        }
    }, mounted() {

        const menu = document.querySelector('.menu');
        const items = Array.from(document.querySelectorAll('.item'));
        const btnDelete = document.querySelector('.btn-delete');
        let self = this;
        function showMenu(e) {
            if (items.includes(e.target)) {
                e.preventDefault();
                menu.style.left = e.pageX + 'px';
                menu.style.top = e.pageY + 'px';
                menu.classList.add('visible');

                const id = e.target.getAttribute('data-id');
                btnDelete.addEventListener('click', function () {
                    self.deletepaket_text(id);
                })
            }
        }



        function removeMenu(e) {
            if (!e.target.closest('.menu') || e.target.closest('.exit')) {
                menu.classList.remove('visible');
            }
        }

        document.addEventListener('contextmenu', showMenu, false);
        document.addEventListener('click', removeMenu, false);

        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
