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
                        <a class="nav-link" href="#">Cara Daftar</a>
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
                    <h1>Sukses CPNS <br> Bersama Viracun</h1>
                    <p class="my-4">Yakin udah siap menghadapi tes seleksi?
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

    <section id="hero" class="full-height  secondary">
        <div class="container text-black">
            <div class="row  mb-5 pb-5">
                <div class="col-sm-12 text-center">
                    <h1>Paket Kelas</h1>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-4" v-for="item in paket">
                    <div class="card border-0 p-5">
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
    border-radius: 10px !important;
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
