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
                        <label class="form-control-label col-auto justify-content-end"><h5>Ir a dia: </h5></label>
                        <input type="date" class="form-control col-3" @change="cambio()" v-model="fecha">
                    </div>
                </div>
                <div class="card-body">
                    <div class="row align-items-center"></div>
                        <div class="col-6">
                            <h5  v-text="today"></h5>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Hora</th>
                            <th>Cliente</th>
                            <th>Lugar</th>
                            <th>Motivo</th>
                            <th>Observaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="citas in arrayCitasHoy" :key="citas.id">
                            <td v-text="citas.hora"></td>
                            <td v-text="citas.nombre"></td>
                            <td v-text="citas.lugar"></td>
                            <td v-text="citas.motivo"></td>
                            <td v-text="citas.observaciones"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</template>

<script>
    export default {
        name: "CitasDia",
        data() {
            return {
                arrayCitasHoy: [],
                fecha: '',
                today: '',
            };
        },
        methods: {
            hoy() {
                let hoy = new Date();
                let yy = hoy.getFullYear();
                let mm = hoy.getMonth() + 1;
                let dd = hoy.getDate();
                if(dd<10){
                    dd='0'+dd;
                }
                if(mm<10){
                    mm='0'+mm;
                }
                hoy = yy + '-' + mm + '-' + dd;
                this.fecha = hoy;
                this.today = this.fechaFormateada(new Date(hoy));

            },
            fechaFormateada(today){
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                var f=today;
               return (diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
            },
            recuperaCitas() {
                let me = this;
                axios
                    .get("/agenda/citasdia")
                    .then(function (response) {
                        me.arrayCitasHoy = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            cambio() {
                let me = this;
                me.today = me.fechaFormateada(new Date(me.fecha));
                let url = "/agenda/citasdia/" + me.fecha;
                axios
                    .get(url)
                    .then(function (response) {
                        me.arrayCitasHoy = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        },
        mounted() {
            this.hoy();
            this.cambio();
        }
    }
</script>

<style scoped>
    .mifecha {
        background-color: #999;
        padding: 3px;
        width: 110px;
        text-align: center;
        font-family:verdana, arial;
        font-size: 12pt;
    }
    .mifecha .ano{
        background-color: #339;
        padding: 2px;
        font-size: 100%;
        margin-bottom: 3px;
        color: #fff;
        letter-spacing: 3px;
        font-weight: bold;
    }
    .mifecha .dia{
        background-color: #99f;
        font-size: 300%;
        padding: 5px 8px;
        margin-bottom: 3px;
        font-weight: bold;
    }
    .mifecha .mes{
        background-color: #339;
        font-size: 80%;
        padding: 2px;
        color: #fff;
        font-weight: bold;
    }
</style>