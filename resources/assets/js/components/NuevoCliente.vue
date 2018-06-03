<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="icon-plus"></i> Nuevo Cliente
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label"
                                       :class="{'text-error' : errorMostrarMsgCliente.includes('Nombre')}">Nombre<sup>*</sup></label>
                                <input type="text" v-model="nombre" class="form-control"
                                       :class="{'is-invalid' : errorMostrarMsgCliente.includes('Nombre')}"
                                       placeholder="Introduzca el nombre">
                            </div>
                            <div class="col-md-5">
                                <label class=" form-control-label"
                                       :class="{'text-error' : errorMostrarMsgCliente.includes('Apellidos')}">Apellidos<sup>*</sup></label>
                                <input type="text" v-model="apellidos" class="form-control"
                                       :class="{'is-invalid' : errorMostrarMsgCliente.includes('Apellidos')}"
                                       placeholder="Introduzca los apellidos">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label"
                                       :class="{'text-error' : errorMostrarMsgCliente.includes('DNI')}">DNI/NIE<sup>*</sup></label>
                                <input type="text" v-model="dni" class="form-control"
                                       pattern="(([X-Zx-z]{1})([-]?)(\d{7})([-]?)([A-Za-z]{1}))|((\d{8})([-]?)([A-Za-z]{1}))"
                                       :class="{'is-invalid' : errorMostrarMsgCliente.includes('DNI')}"
                                       placeholder="Introduzca el DNI/CIF">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label"
                                       :class="{'text-error' : errorMostrarMsgCliente.includes('Teléfono')}">Teléfono<sup>*</sup></label>
                                <input type="text" v-model="telefono" class="form-control"
                                       :class="{'is-invalid' : errorMostrarMsgCliente.includes('Teléfono')}"
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
                            <div class="col-md-5">
                                <label class="form-control-label">Cuenta</label>
                                <input type="text" v-model="cuentaBancaria" class="form-control"
                                       placeholder="Introduzca IBAN o número de cuenta">
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Sexo</label>
                                <select class="form-control" v-model="sexo">
                                    <option value="Hombre" selected>Hombre</option>
                                    <option value="Mujer">Mujer</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label">Contacto</label>
                                <input type="text" v-model="contacto" class="form-control"
                                       placeholder="Persona contacto">
                            </div>
                            <div class="col-md-5">
                                <label class="form-control-label">Observac.</label>
                                <textarea class="form-control" rows="3" v-model="observaciones"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label class="form-control-label">Categoría</label>
                                <select v-model="id_categoria" class="form-control">
                                    <option v-for="categoria in arrayCategorias" :key="categoria.id"
                                            :value="categoria.id"
                                            v-text="categoria.nombre">
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div v-show="errorCliente" class="form-group row div-error">
                            <div class="text-center text-error">
                                <p>Los siguientes campos no pueden estar vacíos o son incorrectos:</p>
                                <span v-for="error in errorMostrarMsgCliente" :key="error"
                                      v-text="error + ', '"> </span>
                            </div>
                        </div>
                        <div v-show="errorFormatoDni" class="text-error text-center">
                            <p>DNI/NIE (12345678A o X1234567A)</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="limpiar()">Reset</button>
                            <button type="button" class="btn btn-primary"
                                    @click="registrarCliente()">Guardar
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
        name: "NuevoCliente",
        data(){
            return{
                cliente_id: 0, nombre: "", apellidos: "", dni: "", email: "", telefono: "", fechaNacimiento: "",
                sexo: "Hombre", domicilio: "", localidad: "", codigoPostal: "", provincia: "", cuentaBancaria: "",
                profesion: "", contacto: "", id_categoria: 1, observaciones: "",
                errorCliente: 0, errorMostrarMsgCliente: [], errorFormatoDni: 0,
                arrayCategorias:[]
            };
        },
        methods: {
            listarCategoria() {
                let me = this;
                axios
                    .get("/categoria/selectcategoria")
                    .then(function (response) {
                        me.arrayCategorias = response.data.categorias;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            limpiar(){
                this.cliente_id=0;
                this.nombre='';
                this.apellidos='';
                this.dni='';
                this.email='';
                this.telefono='';
                this.fechaNacimiento='';
                this.sexo='Hombre';
                this.domicilio='';
                this.localidad='';
                this.codigoPostal='';
                this.provincia='';
                this.cuentaBancaria='';
                this.profesion='';
                this.contacto='';
                this.id_categoria=1;
                this.observaciones='';
                this.errorCliente=0;
                this.errorMostrarMsgCliente=[];
                this.errorFormatoDni=0;
            },
            registrarCliente() {
                if (this.validarCliente()) {
                    return;
                }
                let me = this;
                axios
                    .post("/cliente/registrar", {
                        nombre: this.nombre,
                        apellidos: this.apellidos,
                        dni: this.dni,
                        email: this.email,
                        telefono: this.telefono,
                        fechaNacimiento: this.fechaNacimiento,
                        sexo: this.sexo,
                        domicilio: this.domicilio,
                        codigoPostal: this.codigoPostal,
                        provincia: this.provincia,
                        cuentaBancaria: this.cuentaBancaria,
                        contacto: this.contacto,
                        id_categoria: this.id_categoria,
                        observaciones: this.observaciones,
                        localidad: this.localidad,
                        profesion: this.profesion
                    })
                    .then(function (response) {
                        me.limpiar();
                        swal({
                            type: 'succes',
                            title: 'Creado',
                            text: 'Cliente creado con éxito',
                        })
                    })
                    .catch(function (error) {
                        if(error.code)
                        swal({
                            type: 'error',
                            title: 'Oops...',
                            text: 'No se ha podido crear el cliente',
                        });
                        console.log(error);
                    });
            },
            validarCliente() {
                this.errorCliente = 0;
                this.errorMostrarMsgCliente = [];
                if (!this.nombre) this.errorMostrarMsgCliente.push("Nombre");
                if (!this.apellidos) this.errorMostrarMsgCliente.push("Apellidos");
                if (!this.dni) this.errorMostrarMsgCliente.push("DNI");
                if (!this.telefono) this.errorMostrarMsgCliente.push("Teléfono");
                if (!this.id_categoria) this.errorMostrarMsgCliente.push("Categoría");
                if (!this.validarDni(this.dni)) {
                    this.errorFormatoDni = 1;
                    this.errorCliente = 1;
                }
                if (this.errorMostrarMsgCliente.length > 0) this.errorCliente = 1;
                return this.errorCliente;
            },
            validarDni(value) {
                let validChars = "TRWAGMYFPDXBNJZSQVHLCKET";
                let nifRexp = /^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
                let nieRexp = /^[XYZ]{1}[0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i;
                let str = value.toString().toUpperCase();

                if (!nifRexp.test(str) && !nieRexp.test(str)) return false;

                let nie = str
                    .replace(/^[X]/, "0")
                    .replace(/^[Y]/, "1")
                    .replace(/^[Z]/, "2");

                let letter = str.substr(-1);
                let charIndex = parseInt(nie.substr(0, 8)) % 23;

                if (validChars.charAt(charIndex) === letter) return true;
                return false;
            },

        },
        mounted(){
            this.listarCategoria();
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