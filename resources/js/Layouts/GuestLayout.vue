<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <!-- Outer Row -->
    <div class="row justify-content-center login-wrapper">

        <div class="col-xl-12 col-lg-12 col-md-12">


            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-7 d-none d-lg-block ilustration">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-center align-items-center flex-column text-white ">
                                <!-- <img src="/assets/img/register.gif" alt="Example Image" width="400"> -->
                                <div class="lottie-container">
                                    <div ref="lottieContainer"></div>
                                </div>
                                <div class="capt px-5 text-center">
                                    <Link href="/" as="h1" class="cursor-pointer">
                                    <h2>Viracun id</h2>
                                    </Link>
                                    <p>Yakin udah siap menghadapi tes seleksi? Sini belajar bareng,
                                        biar
                                        kamu makin
                                        paham dan
                                        pede menghadapi tes ujian
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 d-flex flex-column justify-content-center login-form-wrapper">
                    <div class="text-center">
                        <img src="/assets/img/logo.png" alt="Example Image" width="200" class="mb-3">
                        <!-- <h1 class="h4 text-gray-900 mb-3">Viracun!</h1> -->
                        <p>Bimbel CPNS terbaik bersama pengajar profesional </p>
                    </div>
                    <slot />

                    <!-- <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                </div> -->
                </div>
            </div>


        </div>

    </div>
</template>

<style>
.lottie-container {
    width: 500px;
}

.login-form-wrapper {
    padding-left: 150px !important;
    padding-right: 150px !important;
}

@media (max-width: 480px) {
    .login-form-wrapper {
        padding-top: 50px !important;
        padding-bottom: 50px !important;
        padding-left: 65px !important;
        padding-right: 35px !important;
    }
}

.auth label {
    font-size: 12px;
}
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
            path: '/assets/lottie/lottiejson_learn.json',

        });
    }
}
</script>
