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
});
</script>

<template>
    <Head title="Welcome" />


    <nav class="navbar navbar-expand-sm navbar-light p-4 fixed-top">
        <div class="container">
            <a class="navbar-brand " href="#"><strong>Viracun</strong></a>
            <!-- <img src="/assets/img/logo.png" alt="Example Image" width="200" class="navbar-brand"> -->
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
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Portfolio</a>
                    </li>
                    <li class="nav-item mx-3">
                        <a class="nav-link" href="#">Contact</a>
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
@import url('./../../css/home.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');
</style>
<script>
import * as lottie from 'lottie-web';

export default {
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
