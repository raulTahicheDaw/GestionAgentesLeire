<template>
    <div class="main">
        <h1>Informes</h1>
    </div>
</template>

<script>
    export default {
        name: "Informes",
        data() {
            return {

            }
        },
        methods: {
            informes() {
                let me = this;
                axios
                    .get("/clientesproductos/informes")
                    .then(function (response) {
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        mounted(){
            this.informes();
        }
    }
</script>

<style scoped>

</style>