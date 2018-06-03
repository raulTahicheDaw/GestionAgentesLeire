<template>
    <div class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-control-label">Desde:</div>
                            <input type="date" class="form-control" v-model="desde">
                        </div>
                        <div class="col-3 offset-2">
                            <div class="form-control-label">Hasta:</div>
                            <input type="date" class="form-control" v-model="hasta">
                        </div>
                        <div class="col-2 align-self-end">
                            <button @click="verVencimientos()" type="button" class="btn btn-secondary">
                                <i class="icon-eyeglass"></i>&nbsp; Mostrar
                            </button>
                        </div>
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
            };
        },
        methods:{
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
        }
    }
</script>

<style scoped>

</style>