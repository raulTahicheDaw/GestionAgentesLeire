<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="icon-plus"></i> Nueva Referencia
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label"
                                       :class="{'text-error' : errorMostrarMsgReferencia.includes('Nombre')}">Nombre<sup>*</sup></label>
                                <input type="text" v-model="nombre" class="form-control"
                                       :class="{'is-invalid' : errorMostrarMsgReferencia.includes('Nombre')}"
                                       placeholder="Introduzca el nombre">
                            </div>
                            <div class="col-md-5">
                                <label class=" form-control-label">Apellidos</label>
                                <input type="text" v-model="apellidos" class="form-control"
                                       placeholder="Introduzca los apellidos">
                            </div>

                            <div class="col-md-3">
                                <label class="form-control-label"
                                       :class="{'text-error' : errorMostrarMsgReferencia.includes('DNI')}">DNI/NIE</label>
                                <input type="text" v-model="dni" class="form-control"
                                       pattern="(([X-Zx-z]{1})([-]?)(\d{7})([-]?)([A-Za-z]{1}))|((\d{8})([-]?)([A-Za-z]{1}))"
                                       :class="{'is-invalid' : errorMostrarMsgReferencia.includes('DNI')}"
                                       placeholder="Introduzca el DNI/CIF">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label"
                                       :class="{'text-error' : errorMostrarMsgReferencia.includes('Teléfono')}">Teléfono<sup>*</sup></label>
                                <input type="text" v-model="telefono" class="form-control"
                                       :class="{'is-invalid' : errorMostrarMsgReferencia.includes('Teléfono')}"
                                       placeholder="Introduzca teléfono">
                            </div>
                            <div class="col-md-5">
                                <label class="form-control-label">Email</label>
                                <input type="email" v-model="email" class="form-control"
                                       placeholder="Introduzca un email válido">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Fec. Nacim.</label>
                                <input type="date" v-model="fechaNacimiento" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label">Domicilio</label>
                                <input type="text" v-model="domicilio" class="form-control"
                                       placeholder="Introduzca Dirección">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Localidad</label>
                                <input type="text" v-model="localidad" class="form-control"
                                       placeholder="Localidad">
                            </div>
                            <div class="col-md-2">
                                <label class="form-control-label">C.Postal</label>
                                <input type="text" v-model="codigoPostal" class="form-control"
                                       placeholder="C.Postal">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Provincia</label>

                                <input type="text" v-model="provincia" class="form-control"
                                       placeholder="Provincia">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label">Profesion</label>
                                <input type="text" v-model="profesion" class="form-control"
                                       placeholder="Profesión">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Nacionalidad</label>
                                <input type="text" v-model="nacionalidad" class="form-control"
                                       placeholder="Nacionalidad">
                            </div>
                            <div class="col-md-2">
                                <label class="form-control-label">Sexo</label>
                                <select class="form-control" v-model="sexo">
                                    <option value="Hombre" selected>Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Contacto</label>
                                <input type="text" v-model="contacto" class="form-control"
                                       placeholder="Persona contacto">
                            </div>

                        </div>

                        <div class="form-group row">

                            <div class="col-md-4">
                                <label class="form-control-label">Comp. Orígen</label>
                                <input type="text" v-model="compañia_origen" class="form-control"
                                       placeholder="Compañía de orígen">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Intereses</label>
                                <textarea class="form-control" rows="3" v-model="intereses"></textarea>
                            </div>
                            <div class="col-md-5">
                                <label class="form-control-label">Observaciones</label>
                                <textarea class="form-control" rows="3" v-model="observaciones"></textarea>
                            </div>
                        </div>
                        <div v-show="errorReferencia" class="form-group row div-error">
                            <div class="text-center text-error">
                                <p>Los siguientes campos no pueden estar vacíos o son incorrectos:</p>
                                <span v-for="error in errorMostrarMsgReferencia" :key="error"
                                      v-text="error + ', '"> </span>
                            </div>
                        </div>
                        <div v-show="errorFormatoDni" class="text-error text-center">
                            <p>DNI/NIE (12345678A o X1234567A)</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary"
                                    @click="registrarReferencia()">Guardar
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        name: "NuevaReferencia",
        data(){
            return{
                referencia_id: 0, nombre: '', apellidos: '', domicilio: '', localidad: '', codigoPostal: '',
                provincia: '', email: '', sexo: 'Hombre', dni: '', telefono: '', fechaNacimiento: '', nacionalidad: '',
                intereses: '', compañia_origen: '', observaciones: '', contacto: '', profesion: '', activo: 1,
                errorReferencia: 0,
                errorMostrarMsgReferencia: [],
                errorFormatoDni: 0,
            }
        },
        methods:{
            registrarReferencia() {
                if (this.validarReferencia()) {
                    return;
                }
                let me = this;
                axios.post('/referencia/registrar', {
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'domicilio': this.domicilio,
                    'localidad': this.localidad,
                    'codigoPostal': this.codigoPostal,
                    'provincia': this.provincia,
                    'email': this.email,
                    'dni': this.dni,
                    'telefono': this.telefono,
                    'fechaNacimiento': this.fechaNacimiento,
                    'sexo': this.sexo,
                    'nacionalidad': this.nacionalidad,
                    'intereses': this.intereses,
                    'compañia_origen': this.compañia_origen,
                    'contacto': this.contacto,
                    'observaciones': this.observaciones,
                    'profesion': this.profesion,

                }).then(function (response) {
                    me.limpiar();
                    swal({
                        type: 'success',
                        title: 'Creado',
                        text: 'Referencia creada con éxito',
                    })
                })
                    .catch(function (error) {
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'No se ha podido crear la referencia',
                        });
                        console.log(error);
                    });
            },
            validarReferencia() {
                this.errorReferencia = 0;
                this.errorMostrarMsgReferencia = [];
                if (!this.nombre) this.errorMostrarMsgReferencia.push('Nombre');
                if (!this.telefono) this.errorMostrarMsgReferencia.push('Teléfono');
                if (this.dni && !this.validarDni(this.dni)) {
                    this.errorFormatoDni = 1;
                    this.errorReferencia = 1;
                }
                if (this.errorMostrarMsgReferencia.length > 0) this.errorReferencia = 1;
                return this.errorReferencia;
            },
            validarDni(value) {
                let validChars = 'TRWAGMYFPDXBNJZSQVHLCKET';
                let nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
                let nieRexp = /^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
                let str = value.toString().toUpperCase();

                if (!nifRexp.test(str) && !nieRexp.test(str)) return false;

                let nie = str
                    .replace(/^[X]/, '0')
                    .replace(/^[Y]/, '1')
                    .replace(/^[Z]/, '2');

                let letter = str.substr(-1);
                let charIndex = parseInt(nie.substr(0, 8)) % 23;

                if (validChars.charAt(charIndex) === letter) return true;
                return false;
            },
            limpiar(){
                this.referencia_id = 0;
                this.nombre='';
                this.apellidos='';
                this.domicilio='';
                this.localidad='';
                this.codigoPostal='';
                this.provincia='';
                this.email='';
                this.sexo='Hombre';
                this.dni='';
                this.telefono='';
                this.fechaNacimiento='';
                this.nacionalidad='';
                this.intereses='';
                this.compañia_origen='';
                this.observaciones='';
                this.contacto='';
                this.profesion='';
                this.errorReferencia=0;
                this.errorMostrarMsgReferencia=[];
                this.errorFormatoDni=0;
            }
        },
        mounted(){
            this.limpiar();
        }
    }
</script>

<style scoped>
    .div-error {
        display: flex;
        justify-content: center;
    }

    .text-error {
        color: red !important;
        font-weight: bold;
    }
</style>