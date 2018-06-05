<template>
    <div class="main">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="icon-graph"></i>Estadísticas
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col">
                            <div class="input-group">
                                <select class="form-control col-3" v-model="criterio">
                                    <option value="productos">Productos más contratados por fecha</option>
                                    <option value="clientes">Total de Clientes por meses</option>
                                    <option value="referencias">Total de Referencias por meses</option>
                                    <option value="clientesReferencias">Clientes y Referencias por meses</option>
                                </select>
                                <input type="date" v-model="desde"
                                       class="form-control col-2"
                                       placeholder="Desde" style="margin-left: 10px">

                                <input type="date" v-model="hasta"
                                       class="form-control col-2"
                                       placeholder="Hasta">

                                <button v-if="criterio=='productos'" type="submit" @click="productosFecha()"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Filtrar
                                </button>
                                <button v-else-if="criterio=='clientes'" type="submit" @click="clientesFecha()"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Filtrar
                                </button>
                                <button v-else type="submit" @click="clientesReferenciasFecha()"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Filtrar
                                </button>

                                <button v-if="criterio=='productos'" type="submit" @click="productosTotal()"
                                        class="btn btn-warning" style="margin-left: 10px">
                                    <i class="fa fa-area-chart"></i> Ver Total
                                </button>
                                <button v-else-if="criterio=='clientes'" type="submit" @click="clientesTotal()"
                                        class="btn btn-warning" style="margin-left: 10px">
                                    <i class="fa fa-area-chart"></i> Ver Total
                                </button>
                                <button v-else type="submit" @click="clientesReferenciasTotal()"
                                        class="btn btn-warning" style="margin-left: 10px">
                                    <i class="fa fa-area-chart"></i> Ver Total
                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="small">
                        <div v-if="criterio=='productos'" class="chartjs-caption">
                            <h6 class="chartjs-title">Porcentajes de contratación</h6>
                            <pie :chart-data="productosCollection"
                                 :options="{responsive: true, maintainAspectRatio: true}"
                                 :width="300"
                                 :height="150">
                            </pie>
                        </div>
                        <div v-else-if="criterio=='clientes'" class="chartjs-caption">
                            <h6 class="chartjs-title">Altas Totales de Clientes</h6>
                            <bar :chart-data="clientesCollection"
                                 :options="{responsive: true, maintainAspectRatio: true}"
                                 :width="300"
                                 :height="150">
                            </bar>
                        </div>
                        <div v-else-if="criterio=='referencias'" class="chartjs-caption">
                            <h6 class="chartjs-title">Altas Totales de Referencias</h6>
                            <bar :chart-data="referenciasCollection"
                                 :options="{responsive: true, maintainAspectRatio: true}"
                                 :width="300"
                                 :height="150">
                            </bar>
                        </div>
                        <div v-else class="chartjs-caption">
                            <h6 class="chartjs-title">Altas Totales de Referencias</h6>
                            <bar :chart-data="clientesReferenciasCollection"
                                 :options="{responsive: true, maintainAspectRatio: true}"
                                 :width="300"
                                 :height="150">
                            </bar>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Pie from './PieCharts.js'
    import Bar from './BarChart.js'

    export default {
        components: {
            Pie, Bar
        },
        data() {
            return {
                productosCollection: null,
                criterio: 'productos',
                clientesCollection: null,
                referenciasCollection:null,
                clientesReferenciasCollection:null,
                desde: '',
                hasta: ''
            }
        },
        mounted() {
            this.productosTotal();
            this.clientesTotal();
            this.referenciasTotal();
            this.clientesReferenciasTotal();
        },
        methods: {
            productosTotal() {
                let nombres = [];
                let datos = [];
                let bground = [];
                let me = this;
                let colores = ['SKYBLUE','CRIMSON','GOLD','ORCHID','SANDYBROWN','CHOCOLATE','AQUA','BROWN','SALMON',
                    'DARKSLATEGRAY','RED','PLUM','MISTYROSE','AZURE','GOLDENROD','MEDIUMBLUE','LIGHTBLUE','OLIVE',
                    'PAPAYAWHIP','STEELBLUE'];
                axios
                    .get("clientesproductos/informes")
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            nombres.push(response.data[i].nombre);
                            datos.push((response.data[i].total * 100) / 4);
                            bground.push(colores[i]);

                            me.productosCollection = {
                                labels: nombres,
                                datasets: [
                                    {
                                        label: '% del Total',
                                        backgroundColor: bground,
                                        data: datos
                                    }]
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            productosFecha() {
                let nombres = [];
                let datos = [];
                let me = this;
                let url = "clientesproductos/informes/" + this.desde + "/" + this.hasta;
                axios
                    .get(url)
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            nombres.push(response.data[i].nombre);
                            datos.push((response.data[i].total * 100) / 4);
                            me.datacollection = {
                                labels: nombres,
                                datasets: [
                                    {
                                        label: 'Porcentajes de contratación de cada Prod.',
                                        backgroundColor: ['red', 'blue', 'yellow'],
                                        data: datos
                                    }]
                            }
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            clientesTotal() {
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                axios
                    .get("cliente/informecliente")
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            datos[response.data[i].mes] = response.data[i].total;
                        }
                        me.clientesCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Total Clientes',
                                    backgroundColor: 'CRIMSON',
                                    data: datos
                                }]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            clientesFecha() {
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let url = "cliente/informecliente/" + this.desde + '/' + this.hasta;
                axios
                    .get(url)
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            datos[response.data[i].mes] = response.data[i].total;
                        }
                        me.clientesCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Clientes por meses',
                                    backgroundColor: 'CRIMSON',
                                    data: datos
                                }]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            referenciasTotal() {
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                axios
                    .get("referencia/informereferencia")
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            datos[response.data[i].mes] = response.data[i].total;
                        }
                        me.referenciasCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Total Referencias',
                                    backgroundColor: 'SKYBLUE',
                                    data: datos
                                }]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            referenciasFecha() {
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datos = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let url = "referencia/informereferencia/" + this.desde + '/' + this.hasta;
                axios
                    .get(url)
                    .then(function (response) {
                        for (var i = 0; i < response.data.length; i++) {
                            datos[response.data[i].mes] = response.data[i].total;
                        }
                        me.referenciasCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Referencias por meses',
                                    backgroundColor: 'SKYBLUE',
                                    data: datos
                                }]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            clientesReferenciasTotal(){
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datosReferencias = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let datosClientes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let urlRef = "referencia/informereferencia";
                let urlCli = "cliente/informecliente";
                function getReferencias(){
                    return axios.get(urlRef);
                }
                function getClientes(){
                    return axios.get(urlCli);
                }
                axios.all([getReferencias(),getClientes()])
                    .then(function (response) {
                        for (var i = 0; i < response[0].data.length; i++) {
                            datosReferencias[response[0].data[i].mes] = response[0].data[i].total;
                        }
                        for (var j = 0; j < response[1].data.length; j++) {
                            datosClientes[response[1].data[j].mes] = response[1].data[j].total;
                        }
                        me.clientesReferenciasCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Total Referencias',
                                    backgroundColor: 'SKYBLUE',
                                    data: datosReferencias
                                },
                                {
                                    label: 'Total Clientes',
                                    backgroundColor: 'CRIMSON',
                                    data: datosClientes
                                },
                            ]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            },
            clientesReferenciasFecha(){
                let me = this;
                let meses = ['', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic', ''];
                let datosReferencias = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let datosClientes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                let urlRef = "referencia/informereferencia/" + this.desde + "/" + this.hasta;
                let urlCli = "cliente/informecliente/" + this.desde + "/" + this.hasta;
                function getReferencias(){
                    return axios.get(urlRef);
                }
                function getClientes(){
                    return axios.get(urlCli);
                }
                axios.all([getReferencias(),getClientes()])
                    .then(function (response) {
                        for (var i = 0; i < response[0].data.length; i++) {
                            datosReferencias[response[0].data[i].mes] = response[0].data[i].total;
                            datosClientes[response[1].data[i].mes] = response[1].data[i].total;
                        }
                        me.clientesReferenciasCollection = {
                            labels: meses,
                            datasets: [
                                {
                                    label: 'Total Referencias',
                                    backgroundColor: 'blue',
                                    data: datosReferencias
                                },
                                {
                                    label: 'Total Clientes',
                                    backgroundColor: 'red',
                                    data: datosClientes
                                },
                            ]
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },


    }

</script>

<style>
    .small {
        max-width: 600px;
        margin: 50px auto;
    }
</style>