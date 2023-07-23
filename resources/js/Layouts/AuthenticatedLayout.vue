<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template class="authenticated">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mt-4" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-book main-color"></i> -->
                </div>
                <div class="sidebar-brand-text main-color mx-3">
                    <img src="/assets/img/logo.png" alt="" width="100" class="ml-0">
                    <!-- <sup>v2</sup> -->
                </div>
            </a>




            <li class="nav-item mt-3 " :class="{ 'active': isActive('/dashboard') }">
                <Link href="/dashboard" class="nav-link">
                <i class="far fa-fw fa-chart-bar"></i>

                <span>Dashboard</span></Link>
            </li>




            <li class="nav-item" :class="{ 'active': isActive('/profile') }">
                <Link class="nav-link" href="/profile">
                <i class="far fa-fw fa-user"></i>
                <span>Profile</span></Link>
            </li>

            <li class="nav-item" :class="{ 'active': isActive('/bantuan') }">
                <Link class="nav-link" href="/bantuan">
                <i class="far fa-fw fa-question-circle"></i>
                <span>Bantuan</span></Link>
            </li>

            <template v-if="user.role == 'admin'">
                <li class="nav-item" :class="{ 'active': isActive('/admin/pengguna') }">
                    <Link class="nav-link" href="/admin/pengguna">
                    <i class="far fa-fw fa-address-card"></i>
                    <span>Pengguna</span></Link>
                </li>


                <li class="nav-item" :class="{ 'active': isActive('/soal') }">
                    <Link class="nav-link" href="/soal">
                    <i class="far fa-fw fa-folder"></i>
                    <span>Data Soal</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/paket_soal') }">
                    <Link class="nav-link" href="/paket_soal">
                    <i class="far fa-fw fa-folder"></i>
                    <span>Paket Soal</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/kelas') }">
                    <Link class="nav-link" href="/kelas">
                    <i class="far fa-fw fa-folder-open"></i>
                    <span>Data Kelas</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/materi_video') }">
                    <Link class="nav-link" href="/materi_video">
                    <i class="far fa-fw fa-file-video"></i>
                    <span>Materi video</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/paket_video') }">
                    <Link class="nav-link" href="/paket_video">
                    <i class="far fa-fw fa-file-video"></i>
                    <span>Paket video</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/paket_text') }">
                    <Link class="nav-link" href="/paket_text">
                    <i class="far fa-fw fa-file"></i>
                    <span>Paket Text</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/materi_text') }">
                    <Link class="nav-link" href="/materi_text">
                    <i class="far fa-fw fa-file"></i>
                    <span>Materi Text</span></Link>
                </li>


                <li class="nav-item" :class="{ 'active': isActive('/kategori_soal') }">
                    <Link class="nav-link" href="/kategori_soal">
                    <i class="far fa-fw fa-list-alt"></i>
                    <span>Kategori Soal</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/sub_kategori_soal') }">
                    <Link class="nav-link" href="/sub_kategori_soal">
                    <i class="far fa-fw fa-list-alt"></i>
                    <span>SubKategori Soal</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/tryout') }">
                    <Link class="nav-link" href="/tryout">
                    <i class="far fa-fw fa-object-group"></i>
                    <span>Tryout</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/latihan') }">
                    <Link class="nav-link" href="/latihan">
                    <i class="far fa-fw fa-object-group"></i>
                    <span>Latihan</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/paket') }">
                    <Link class="nav-link" href="/paket">
                    <i class="far fa-fw fa-object-group"></i>
                    <span>Paket</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/pembayaran') }">
                    <Link class="nav-link" href="/pembayaran">
                    <i class="far fa-fw fa-credit-card"></i>
                    <span>Pembayaran</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/diskon') }">
                    <Link class="nav-link" href="/diskon">
                    <i class="far fa-fw fa-credit-card"></i>
                    <span>Diskon</span></Link>
                </li>


            </template>



            <template v-if="user.role == 'member'">
                <li class="nav-item" :class="{ 'active': isActive('/member/pembayaran') }">
                    <Link class="nav-link" href="/member/pembayaran">
                    <i class="far fa-fw fa-credit-card"></i>
                    <span>Pembayaran</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/member/pakets') }">
                    <Link class="nav-link" href="/member/paket">
                    <i class="far fa-fw fa-address-card"></i>
                    <span>Beli Paket</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/member/paket_aktif') }">
                    <Link class="nav-link" href="/member/paket_aktif">
                    <i class="far fa-fw fa-folder-open"></i>
                    <span>Paket Saya</span></Link>
                </li>

                <!-- <li class="nav-item" :class="{ 'active': isActive('/member/tryout') }">
                    <Link class="nav-link" href="/member/tryout">
                    <i class="far fa-fw fa-object-group"></i>
                    <span>Tryout</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/member/latihan') }">
                    <Link class="nav-link" href="/member/latihan">
                    <i class="far fa-fw fa-object-group"></i>
                    <span>Latihan</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/member/materi_video') }">
                    <Link class="nav-link" href="/member/materi_video">
                    <i class="far fa-fw fa-file-video"></i>
                    <span>Materi video</span></Link>
                </li>

                <li class="nav-item" :class="{ 'active': isActive('/member/materi_text') }">
                    <Link class="nav-link" href="/member/materi_text">
                    <i class="far fa-fw fa-file"></i>
                    <span>Materi Text</span></Link>
                </li> -->


            </template>

            <li class="nav-item">
                <Link :href="route('logout')" as="buttton" method="post" class="nav-link cursor-pointer" href="tables.html">
                <i class="far fa-fw fa-frown"></i>
                <span>Logout</span></Link>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-5">
                <button @click="toggleNav" class="rounded-circle border-0 bg-light" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top  ">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button @click="toggleNav" id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn bg-main text-white" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>




                        <div class="topbar-divider d-none d-sm-block"></div>


                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ user.name }}</span>
                                <img class="img-profile rounded-circle" src="/assets/img/images.png">

                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <slot />
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="footer border-0" style="background:#F3F3F3; ">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright &copy; Your Website 2020</span> -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">tekan tombol logout dibawah jika ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <Link class="btn btn-primary" href="/logout" method="post" as="button">Logout</Link>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.authenticated .row {
    height: auto !important;
}
</style>
<script>

export default {
    props: {
        user: Object
    },

    methods: {
        toggleNav() {

            // Use jQuery to toggle the 'toggled' class on the navbar element
            const navbar = document.querySelector('.navbar-nav');
            navbar.classList.toggle('toggled');
        },
        isActive(url) {
            return window.location.pathname.startsWith(url);
        },


    },

    mounted() {



        if (window.innerWidth <= 768) {
            this.toggleNav();
        }
    }


};
</script>


