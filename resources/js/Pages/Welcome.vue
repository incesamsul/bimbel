<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
    paket: {
        type: Object,
        required: true,
    },

});
</script>

<template>
    <Head title="Welcome" />


    <nav class="navbar navbar-expand-sm navbar-light p-4 fixed-top">
        <div class="container">
            <!-- <a class="navbar-brand " href="#"><strong>Viracun</strong></a> -->
            <img src="/assets/img/logo.png" alt="Example Image" width="100" class="navbar-brand">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end " id="navbarSupportedContent">
                <ul class="navbar-nav ">
                    <li class="nav-item mx-3">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Keunggulan</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Paket</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Faq</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#" id="toggleMode">
                            <i class="fa-regular fa-moon"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="hero" class="full-height d-flex justify-content-center flex-column">
        <div class="container text-main">
            <div class="row  ">
                <div class="col-sm-6 pe-5 d-flex justify-content-center align-items-start flex-column">
                    <h1><span class="text-black">Sukses CPNS <br> Bersama</span> Viracun</h1>
                    <p class="my-4 text-black">Yakin udah siap menghadapi tes seleksi?
                        Sini belajar bareng, biar kamu makin paham dan pede menghadapi tes ujian</p>
                    <Link href="/register" class="btn secondary-bg text-white main-radius py-2 px-3">Daftar Sekarang
                    !</Link>
                </div>
                <div class="col-sm-6 ">
                    <!-- <img src="/assets/img/learning.gif" alt="Example Image" width="540"> -->
                    <div ref="lottieContainer"></div>


                </div>
            </div>
        </div>
    </section>

    <section class="full-height  mt-5 d-flex justify-content-center align-items-center">
        <div class="container-fluid text-black">
            <div class="row mt-5">
                <div class="col-sm-6">
                    <img src="/assets/img/bgviracun.png" alt="" width="600">
                </div>
                <div class="col-sm-4 d-flex flex-column justify-content-center pr-5">
                    <h2><strong>Tentang <span class="text-main">Viracun</span></strong></h2>
                    <p class="mt-3 ">Viracun telah banyak membantu calon ASN untuk lulus ujian sejak 2019.
                        Kami memahami
                        masalah dan
                        kendala belajar yang dialami pejuang ASN selama ini.</p>
                    <p>Kami ingin membantu calon ASN untuk lulus seleksi dan meraih mimpinya. Berkomitmen memberikan
                        fasilitas belajar yang terbaik untuk meningkatkan pemahaman dan kesiapan calon ASN menghadapi tes
                        seleksi.</p>
                </div>
            </div>
        </div>
    </section>

    <section class=" pb-5 mb-5 ">
        <div class="container text-black">
            <div class="row mt-5">
                <div class="col-sm-6">
                    <h1 class="mt-5 pt-5"><strong>Keunggulan Bimbel <br>Bersama<span
                                class="text-main">Viracun</span></strong>
                    </h1>
                    <div class="d-flex flex-column mt-5 alert shadow-sm  main-radius">
                        <div class="d-flex ">
                            <h4 class="fas fa-book mr-3"></h4>
                            <h5><strong>Materi Terstruktir</strong></h5>
                        </div>
                        <p class="mb-0"><small>Materi dan soal di susun dari basic hingga expert (HOTS) sesuai dengan
                                kisi-kisi resmi
                                dari
                                PermenpanRB yang terbaru</small></p>
                    </div>
                    <div class="d-flex flex-column mt-2 alert shadow-sm  main-radius">
                        <div class="d-flex ">
                            <h4 class="fas fa-user-graduate mr-3"></h4>
                            <h5><strong>Pelajar Profesional</strong></h5>
                        </div>
                        <p class="mb-0"><small>Pengajar di BIMBEL VIRACUN merupakan PNS 100% yang sudah terbukti lolos tes
                                CPNS sehingga selain menjelaskan materi bisa juga berbagi pengalaman sewaktu menjalani
                                tes</small></p>
                    </div>
                    <div class="d-flex flex-column mt-2 alert shadow-sm  main-radius">
                        <div class="d-flex ">
                            <h4 class="fas fa-book-reader mr-3"></h4>
                            <h5><strong>Tips & Trick</strong></h5>
                        </div>
                        <p class="mb-0"><small>Setiap pertemuan akan dibagikan tips dan trik jitu dalam menjawab setiap soal
                                dan bagaimana memanajemen waktu sehingga bisa menjawab semua soal dengan maksimal</small>
                        </p>
                    </div>
                    <div class="d-flex flex-column mt-2 alert shadow-sm  main-radius">
                        <div class="d-flex ">
                            <h4 class="fas fa-laptop-code mr-3"></h4>
                            <h5><strong>Sistem CAT</strong></h5>
                        </div>
                        <p class="mb-0"><small>Sistem latihan dan Tryout berbasis CAT sehingga peserta akan terbiasa dalam
                                menghadapi test terutama manajemen waktu</small></p>
                    </div>
                    <div class="d-flex flex-column mt-2 alert shadow-sm  main-radius">
                        <div class="d-flex ">
                            <h4 class="fas fa-chalkboard mr-3"></h4>
                            <h5><strong>Video Eksklusif</strong></h5>
                        </div>
                        <p class="mb-0"><small>Di sediakan video belajar khusus member yang bisa diakses kapan saja</small>
                        </p>
                    </div>
                    <div class="d-flex flex-column mt-2 alert shadow-sm  main-radius">
                        <div class="d-flex ">
                            <h4 class="fas fa-chalkboard-teacher mr-3"></h4>
                            <h5><strong>Group Diskusi</strong></h5>
                        </div>
                        <p class="mb-0"><small>Di sediakan grup telegram untuk membahas materi dan soal-soal yang ada di
                                Bimbel</small></p>
                    </div>
                </div>
                <div class="col-sm-6 d-flex  justify-content-center align-items-center">
                    <img src="/assets/img/keunggulan_viracun.png" alt="" width="100%">
                </div>
            </div>
        </div>
    </section>


    <section class="full-height mt-5 pt-5">
        <div class="container text-black">
            <div class="row  mb-5 pb-5">
                <div class="col-sm-12 text-center">
                    <h1><strong>#Cerita<span class="text-main">Alumni</span></strong></h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-6 offset-sm-3">
                    <div class="card p-0 overflow-hidden">
                        <div class="card-body p-0 overflow-hidden">
                            <div class="video-container">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/pOcLi_3lr6A"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class=" mt-5 pt-5">
        <div class="container text-black">
            <div class="row  mb-5 pb-5">
                <div class="col-sm-12 text-center">
                    <h1><strong>Fitur Unggulan<span class="text-main"> Viracun</span></strong></h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card border-0 gradient-1">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <div class="d-flex flex-column  p-5 justify-content-center">
                                        <h5><strong>Materi Text & Video</strong></h5>
                                        <p><small>Materi dalam bentuk paket teks dan juga paket video sudah kami siapkan
                                                untuk
                                                dipelajari.</small></p>
                                    </div>
                                    <img src="assets/img/tm2.png" alt="" width="44%">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card border-0 gradient-2">
                                <div class="card-body d-flex flex-column ">
                                    <img src="assets/img/tm1.png" alt="" width="100%">
                                    <div class="d-flex flex-column mt-5">
                                        <h5><strong>Video Series</strong></h5>
                                        <p class="p"><small>Tonton video series untuk memahami materi mulai dari dasar
                                                hingga
                                                lanjutan. Dijamin paham deh!</small></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-4">
                            <div class="card border-0 gradient-3">
                                <div class="card-body d-flex flex-column ">
                                    <img src="assets/img/tm4.png" alt="" width="60%">
                                    <div class="d-flex flex-column mt-5">
                                        <h5><strong>Event Tryout</strong></h5>
                                        <p class="p"><small>Berpartisipasi dalam event try out untuk mengukur kemampuan kamu
                                                bersaing dengan pengguna lain.</small></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card border-0 gradient-4">
                                <div class="card-body d-flex justify-content-center align-items-center">
                                    <div class="d-flex flex-column  p-5 justify-content-center">
                                        <h5><strong>Tryout dan latihan soal</strong></h5>
                                        <p><small>Kerjakan try out dan latihan soal untuk mengasah kemampuan kamu menjawab
                                                soal ujian.</small></p>
                                    </div>
                                    <img src="assets/img/tm3.png" alt="" width="44%">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card border-0 gradient-5">
                        <div class="card-body d-flex flex-column ">
                            <img src="assets/img/tm5.png" alt="" width="170%">
                            <div class="d-flex flex-column mt-5">
                                <h5><strong>Kelas bimbel</strong></h5>
                                <p class="p"><small>Gabung bersama kelas bimbel untuk belajar secara interaktif bersama para
                                        coach profesional</small></p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="full-height mt-5 pt-5 ">
        <div class="container text-black">
            <div class="row  mb-5 pb-5">
                <div class="col-sm-12 text-center">
                    <h1><strong>Paket Kelas</strong></h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-4" v-for="item in paket">
                    <div class="card border-0 p-5 shadow">
                        <h2><strong>{{ item.nama_paket }}</strong></h2>
                        <h4 class="main-color"><strong>Rp. {{ Number(item.harga).toLocaleString() }}</strong></h4>
                        <div class="list mt-3">
                            <p v-for="paket in listPaket(item.list_paket)"><i class="fas fa-check text-success"></i> {{
                                paket }}
                            </p>
                        </div>
                        <div>
                            <Link :href="'/register'" class="btn bg-main text-white cursor-pointer ">
                            <i class="fas fa-credit-card"></i>
                            Beli Paket
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer class="p-5 mt-5 bg-second">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <h4>Viracun</h4>
                    <p class="text-secondary"><small>
                            Viracun adalah jasa pembuatan website yang berlokasi di makassar. </small></p>
                </div>
                <div class="col-sm-3">
                    <ul>
                        <li><strong>Jasa web</strong></li>
                        <li class="text-secondary"><small>
                                <a href="">Website</a>
                            </small></li>
                        <li class="text-secondary"><small>
                                <a href="">Landing page</a>
                            </small></li>
                        <li class="text-secondary"><small>
                                <a href="">Mobile</a>
                            </small></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul>
                        <li><strong>Related</strong></li>
                        <li class="text-secondary"><small>
                                <a href="">sistem informasi</a>
                            </small></li>
                        <li class="text-secondary"><small>
                                <a href="">Pos</a>
                            </small></li>
                        <li class="text-secondary"><small>
                                <a href="">It </a>
                            </small></li>
                    </ul>
                </div>
                <div class="col-sm-3">
                    <ul>
                        <li><strong>Contact</strong></li>
                        <li class="text-secondary"><small>
                                <a href="">6285756187433</a>
                            </small></li>
                        <li class="text-secondary"><small>
                                <a href="">info@samtam.tech</a>
                            </small></li>
                        <li class="text-secondary"><small>
                                <a href="">Makassar, Indonesia</a>
                            </small></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>


<style>
@import url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

/* @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap'); */
@import url('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i');

body {
    /* font-family: 'Poppins', sans-serif; */
    font-family: 'Nunito' !important;
    overflow-x: hidden;
    transition: 1s;
}

.gradient-1 {
    background: linear-gradient(to right, #d69595, #ef95b3);
    color: white !important;
    height: 360px;
}

.gradient-4 {
    background: linear-gradient(to right, #95cad6, #95efbc);
    color: white !important;
    height: 360px;
}

.gradient-2 {
    background: linear-gradient(to right, #95a0d6, #959bef);
    color: white !important;
    height: 360px;
}

.gradient-5 {
    background: linear-gradient(to right, #d695a6, #efdd95);
    color: white !important;
    height: 735px;
}

.gradient-3 {
    background: linear-gradient(to right, #d495d6, #ef95e6);
    color: white !important;
    height: 360px;
}

.gradient-2 img {
    object-fit: cover;
}

.gradient-1 img {
    object-fit: cover !important;
}

.overflow-hidden {
    overflow: hidden !important;
}

.bg-main {
    background-color: #ef95b3;
}

.bg-main:hover {
    background-color: #ef95b3;
}

.text-main {
    color: #E03268;
}

.secondary-bg {
    background-color: #FEB546 !important;
}


.nav-item a {
    color: #E03268 !important;
}

.navbar a.navbar-brand {
    color: #E03268 !important;
}

.dark-mode {
    background-color: #1B1B1D;
}

.dark-mode .box-shadow {
    box-shadow: -1px 2px 20px rgba(255, 255, 255, 0.6),
        0 0 50px rgba(255, 255, 255, 0.1);
}

.dark-mode .secondary {
    /* background: #F3F3F5 !important; */
    background: linear-gradient(to bottom, transparent, #000000, transparent);
}

.dark-mode p small {
    color: #bbb;
}

.dark-mode li.nav-item a.active {
    color: #bebebe;
}

.dark-mode footer {
    background-color: #151516;
}

.dark-mode,
.dark-mode li a,
.dark-mode li a i,
.dark-mode nav a {
    color: white;
}





.full-height {
    height: 100vh;
}

nav.navbar {
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
}

.bg-second {
    background-color: #F3F3F5;
}

footer ul li {
    list-style-type: none;
}

footer ul {
    margin: 0;
    padding: 0;
}

footer ul li a {
    text-decoration: none;
    color: inherit;
}

.secondary {
    /* background: #F3F3F5 !important; */
    background: linear-gradient(to bottom, transparent, #ccc, transparent);
}

#hero h1 {
    font-size: 46px;
    letter-spacing: 2px;
    font-weight: 700;
}

.main-radius {
    border-radius: 14px !important;
}

.img-card-mobile {
    height: 500px;
    width: 250px;
    object-fit: cover;
    object-position: top left;
}

.img-card {
    width: 424px;
    height: 333px;
    object-fit: cover;
    object-position: top left;
}

#portfolio-mobile {
    height: auto;
}

.bg-diagonal {
    position: absolute;
    background-image: linear-gradient(to right, #ffffff, #C1834D);
    z-index: -1;
    transform: translateX(10px) rotate(5deg);
    transition: 1s;
}

.bg-diagonal.secondary {
    background-image: linear-gradient(to right, #E0E0E0, #C1834D);
}

.dark-mode .bg-diagonal {
    background-image: linear-gradient(to right, #1b1b1b, #00AA95);
}

.dark-mode .bg-diagonal.secondary {
    background-image: linear-gradient(to right, #000000, #00AA95);
}

.img-card-wrapper,
.img-card-mobile-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
}

.box-shadow {
    box-shadow:
        12.5px 12.5px 10px rgba(0, 0, 0, 0.035),
        100px 100px 80px rgba(0, 0, 0, 0.07);
}

#hubungi_kami {
    height: 100vh !important;
    display: flex;
    align-items: center;
}

@media (min-width: 1200px) {
    .container {
        max-width: 1120px;
    }
}



@media (max-width: 480px) {

    #hero {
        margin-top: 200px;
    }

    #hero img {
        transform: perspective(0px) rotateY(0deg) skew(0deg, 0deg);
        margin-top: 20px;
        width: 350px;
    }

    .full-height {
        height: auto;
    }

    .img-card {
        margin-top: 100px;
        width: 324px;
        height: 233px;
    }

    .img-card-mobile {
        margin-top: 120px !important;
        height: 400px;
        width: 200px;
        object-fit: cover;
        object-position: top left;
    }



    #hubungi_kami {
        height: 100vh !important;
        display: flex;
        align-items: center;
    }



}
</style>
<script>
import * as lottie from 'lottie-web';

export default {
    methods: {
        listPaket(paket) {
            return paket.split(',');
        },
    },
    mounted() {
        const container = this.$refs.lottieContainer;
        const animation = lottie.loadAnimation({
            container,
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: '/assets/lottie/lottiejson_learn2.json',
        });
    }
}
</script>
