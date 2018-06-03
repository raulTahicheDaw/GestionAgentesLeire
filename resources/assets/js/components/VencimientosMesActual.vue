<template>
    <div class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center"></div>
                    <label class="form-control-label"> Vencimientos: </label>
                    <div class="col-6">
                        <h5 v-text="mesActual"></h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Fecha de Vencimiento</th>
                            <th>Producto</th>
                            <th>Cliente</th>
                            <th>Número de Póliza</th>
                            <th>Fecha de Inicio</th>
                            <th>Observaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="vencimiento in arrayVencimientos" :key="vencimiento.id">
                            <td v-text="vencimiento.vencimiento"></td>
                            <td v-text="vencimiento.id_producto"></td>
                            <td v-text="vencimiento.id_cliente"></td>
                            <td v-text="vencimiento.numero_poliza"></td>
                            <td v-text="vencimiento.fecha_efecto"></td>
                            <td v-text="vencimiento.observaciones"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Vencimientos",
        data() {
            return {
                arrayVencimientos: [],
                desde: '',
                hasta: '',
                mesActual: ''
            };
        },
        methods:{
            obtieneMes(){
                let f = new Date();
                var meses = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                this.mesActual = meses[f.getMonth()] + " de " + f.getFullYear();
            },
            verVencimientos(){
                let url = "vencimiento/" + this.desde + "/" + this.hasta;
                let me = this
                axios
                    .get(url)
                    .then(function (response) {
                        me.arrayVencimientos = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        mounted(){
            this.obtieneMes();
        }
    }
</script>

<style scoped>

</style>