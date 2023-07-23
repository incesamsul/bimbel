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
            <h1 class="h3 mb-2 text-gray-800">Data diskon</h1>
            <p class="mb-4">set data diskon ada dihalaman ini.</p>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0 mb-4">
                        <div class="card-body main-radius py-3 bg-white d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-">Diskon sekarang : {{ this.edit ? this.edit.persen : '' }}
                                %</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card border-0">
                        <div class="card-body p-5">
                            <form id="msform">
                                <div class="form-group">
                                    <input v-model="inputId" type="hidden" class="form-control" name="id" persen="diskon"
                                        inputPersen>
                                </div>
                                <div class="form-group">
                                    <label for="persen">persen</label>
                                    <input v-model="inputPersen" type="text" class="form-control" name="persen" id="persen">
                                </div>
                                <div class="form-group">
                                    <input @click="submit" type="button" class="btn bg-main text-white" value="simpan"
                                        id="btn-confirm" />
                                </div>
                            </form>

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
            // deadline
            inputId: '',
            inputPersen: '',
        };
    },
    props: {
        user: Object,
        users: Object,
        edit: Object,
    },
    computed: {

    },
    methods: {
        submit() {
            const formData = {
                // produk
                id: this.inputId,
                persen: this.inputPersen,
            }
            // Send the data to the backend server using axios
            if (this.edit) {
                axios.put('/diskon', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('diskon'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            } else {
                axios.post('/diskon', formData)
                    .then(response => {
                        // Handle success response
                        console.log(response);
                        showFlashMessage(response.data.message);
                        this.$inertia.visit(route('diskon'));

                    })
                    .catch(error => {
                        // Handle error response
                        console.error(error);
                    });
            }
        },


    }, mounted() {

        if (this.edit) {
            this.inputId = this.edit.id;
            this.inputPersen = this.edit.persen;
        }
        console.log(this.edit)
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
