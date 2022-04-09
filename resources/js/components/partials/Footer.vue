<template>
    <div
        v-if="$route.name != 'paymentaccepted'"
        class="my_container d-flex justify-content-center align-items-center text-white mt-4"
    >
        <div class="w-75">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                <div
                    class="col d-flex justify-content-center align-items-center p-0"
                >
                    <a
                        class="d-flex align-items-center"
                        href="https://www.linkedin.com/in/nicol%C3%B2-fantini/"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-linkedin me-2"></i
                    ></a>
                    <a
                        class="d-flex align-items-center"
                        href="https://github.com/Gozzissimo"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-github me-2"></i
                    ></a>
                    <div>Nicolò Fantini</div>
                </div>
                <div
                    class="col justify-content-center d-flex align-items-center p-0"
                >
                    <a
                        class="d-flex align-items-center"
                        href="https://www.linkedin.com/in/francesco-filauro-4b1123197/"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-linkedin me-2"></i
                    ></a>
                    <a
                        class="d-flex align-items-center"
                        href="https://github.com/filauro1989"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-github me-2"></i
                    ></a>
                    <div>Francesco Filauro</div>
                </div>
                <div
                    class="col justify-content-center d-flex align-items-center p-0"
                >
                    <a
                        class="d-flex align-items-center"
                        href="https://www.linkedin.com/in/matteo-giuseppe-gallitano-421402b5/"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-linkedin me-2"></i
                    ></a>
                    <a
                        class="d-flex align-items-center"
                        href="https://github.com/Matt0105"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-github me-2"></i
                    ></a>
                    <div>Matteo Giuseppe Gallitano</div>
                </div>
                <div
                    class="col d-flex justify-content-center align-items-center p-0"
                >
                    <a
                        class="d-flex align-items-center"
                        href="https://www.linkedin.com/in/fabio-giannitrapani/"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-linkedin me-2"></i
                    ></a>
                    <a
                        class="d-flex align-items-center"
                        href="https://github.com/Gtp87"
                        target="_blank"
                        ><i class="fs-4 fa-brands fa-github me-2"></i
                    ></a>
                    <div>Fabio Giannitrapani</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Footer",
};
</script>

<style lang="scss" scoped>
.my_container {
    background-color: #7f282f;
    height: 120px;

    a:hover,
    a:active,
    a:focus {
        color: #ff9999;
    }
}
</style>
