<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex flex-column mb-4">
                <h1 class="h3 mb-0 main-color">{{ paket.nama_paket }} </h1>
                <p>Content text dari paket {{ paket.nama_paket.toLowerCase() }} </p>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Data {{ paket.nama_paket.toLowerCase() }}</h6>
                            <Link :href="'/member/paket_aktif/' + paket.id" class="btn btn-light"> <i
                                class="fas fa-arrow-left"></i></Link>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-body px-5">
                            <div class="row">
                                <Link :href="'text/' + item.id" class="col-6 col-sm-4 col-md-2 folder-col"
                                    v-for="item in paketText">
                                <i class="fas fa-folder text-info"></i>
                                <p>{{ item.nama_paket }}</p>
                                </Link>
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
        paket: Object,
        paket_text: Object,
    },
    data() {
        return {
            paketText: JSON.parse(this.paket_text)
        }
    },
    methods: {

    }
}
</script>
