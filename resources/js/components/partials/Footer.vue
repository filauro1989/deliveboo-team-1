<template>
    <div
        class="my_container d-flex justify-content-center align-items-center text-white position-fixed fixed-bottom"
    >
        <ul class="list-inline">
            <li class="list-inline-item me-5">
                <a
                    href="https://www.linkedin.com/in/nicol%C3%B2-fantini/"
                    target="_blank"
                    ><i class="fs-4 fa-brands fa-linkedin me-1"></i
                ></a>
                <a href="https://github.com/Gozzissimo" target="_blank"
                    ><i class="fs-4 fa-brands fa-github me-2"></i
                ></a>
                Nicolò Fantini
            </li>
            <li class="list-inline-item me-5">
                <a
                    href="https://www.linkedin.com/in/francesco-filauro-4b1123197/"
                    target="_blank"
                    ><i class="fs-4 fa-brands fa-linkedin me-1"></i
                ></a>
                <a href="https://github.com/filauro1989" target="_blank"
                    ><i class="fs-4 fa-brands fa-github me-2"></i
                ></a>
                Francesco Filauro
            </li>
            <li class="list-inline-item me-5">
                <a
                    href="https://www.linkedin.com/in/matteo-giuseppe-gallitano-421402b5/"
                    target="_blank"
                    ><i class="fs-4 fa-brands fa-linkedin me-1"></i
                ></a>
                <a href="https://github.com/Matt0105" target="_blank"
                    ><i class="fs-4 fa-brands fa-github me-2"></i
                ></a>
                Matteo Giuseppe Gallitano
            </li>
            <li class="list-inline-item">
                <a
                    href="https://www.linkedin.com/in/fabio-giannitrapani/"
                    target="_blank"
                    ><i class="fs-4 fa-brands fa-linkedin me-1"></i
                ></a>
                <a href="https://github.com/Gtp87" target="_blank"
                    ><i class="fs-4 fa-brands fa-github me-2"></i
                ></a>
                Fabio Giannitrapani
            </li>
        </ul>
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
    height: 150px;

    a:hover,
    a:active,
    a:focus {
        color: #ff9999;
    }
}
</style>
