<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';


import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { showFlashMessage } from '@/global_func.js';


const form = useForm({
    id: '',
    name: '',
    email: '',
    whatsapp: '',
    role: '',
    alamat: '',
});

const editUser = (user) => {
    // Set the user data to the form fields for editing
    form.name = user.name;
    form.email = user.email;
    form.whatsapp = user.whatsapp;
    form.role = user.role;
    form.alamat = user.alamat;
    form.id = user.id; // store user ID for reference during update
    editMode = true; // enable edit mode
};

// Add this variable to track edit mode
let editMode = false;

// Update the submitForm method
const submit = () => {
    try {
        if (editMode) {
            form.put(route('pengguna.update'), {
                onFinish: () => {
                    resetForm();
                    showFlashMessage('Data berhasil terupdate');
                }
            });
        } else {
            form.post(route('pengguna.store'), {
                onFinish: () => {
                    resetForm();
                    showFlashMessage('Data berhasil tersimpan');
                }
            });
        }
        resetForm();
    } catch (error) {
        console.error(error);
    }
};

function resetForm() {
    form.name = '';
    form.email = '';
    form.whatsapp = '';
    form.role = '';
    form.alamat = '';
    $('#modalUser').modal('hide');
}

// const submit = () => {
//     form.post(route('pengguna.store'), {
//         onFinish: () => {
//             form.name = '';
//             form.email = '';
//             form.whatsapp = '';
//             form.role = '';
//             form.alamat = '';
//             showFlashMessage('Data berhasil tersimpan');
//         }
//     });
// };

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout :user="user">
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Pengguna</h1>
            <p class="mb-4">Manajemen pengguna, tambah, cari, hapus dan ubah data pengguna aplikasi ini.</p>

            <!-- DataTales Example -->
            <div class="card border-0 mb-4">
                <div class="card-header py-3 bg-main d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white">Data pengguna</h6>
                    <button class="btn btn-light" data-toggle="modal" data-target="#modalUser"> <i
                            class="fas fa-plus"></i></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th>whatsapp</th>
                                    <th>alamat</th>
                                    <th>Password</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in users">
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.role }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.whatsapp }}</td>
                                    <td>{{ user.alamat }}</td>
                                    <td>
                                        <button @click="resetPass(user.id)" type="button" class="btn btn-info"><i
                                                class="fas fa-sync"></i></button>
                                    </td>
                                    <td>
                                        <button @click="deleteUser(user.id)" type="button" class="btn btn-danger"><i
                                                class="fas fa-trash"></i></button>
                                        <button @click="editUser(user)" type="button" class="btn btn-warning ml-2"
                                            data-toggle="modal" data-target="#modalUser"><i class="fas fa-pen"></i></button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalUser" tabindex="-1" role="dialog" aria-labelledby="modalPengguna"
            aria-hidden="true">
            <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <form @submit.prevent="submit">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPengguna">Pengguna</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group">
                                <InputLabel for="name" value="Name" />
                                <TextInput id="name" type="text" class="form-control shadow-none" v-model="form.name"
                                    required autofocus autocomplete="name" />

                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <div class="form-group">
                                <InputLabel for="email" value="Email" />

                                <TextInput id="email" type="email" class="form-control shadow-none" v-model="form.email"
                                    required autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="form-group">
                                <InputLabel for="whatsapp" value="Whatsapp" />

                                <TextInput id="whatsapp" type="text" class="form-control shadow-none"
                                    v-model="form.whatsapp" required autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.whatsapp" />
                            </div>

                            <div class="form-group">
                                <InputLabel for="role" value="Role" />
                                <select v-model="form.role" required class="form-control">
                                    <option value="">-- pilih role --</option>
                                    <option value="admin">admin</option>
                                    <option value="member">member</option>
                                </select>

                                <InputError class="mt-2" :message="form.errors.role" />
                            </div>

                            <div class="form-group">
                                <InputLabel for="alamat" value="Alamat" />

                                <TextInput id="alamat" type="text" class="form-control shadow-none" v-model="form.alamat"
                                    required autocomplete="username" />

                                <InputError class="mt-2" :message="form.errors.alamat" />
                            </div>

                        </div>
                        <div class="modal-footer">
                            <PrimaryButton class="btn bg-main text-white" :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing">
                                Register
                            </PrimaryButton>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>



export default {
    props: {
        user: Object,
        users: Object
    },

    methods: {
        resetPass(id) {
            // Make API request to delete row using Inertia.js
            if (confirm('yakin ingin reset password?')) {
                this.$inertia.put(`/admin/reset-pass/${id}`)
                showFlashMessage('data berhasil tereset');
            }
        },
        deleteUser(id) {
            // Make API request to delete row using Inertia.js
            if (confirm('yakin ingin menghapus data?')) {
                this.$inertia.delete(`/admin/pengguna/${id}`)
                showFlashMessage('data berhasil terhapus');
            }
        }
    }, mounted() {
        // Initialize DataTables
        $('#dataTable').DataTable({
            // DataTables configuration options
        });
    }
}
</script>
