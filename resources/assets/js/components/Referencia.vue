<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Listado de Referencias
                    <button @click="abrirModal('referencia','registrar')" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nueva
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="apellidos">Apellidos</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="(1,buscar,criterio)"
                                       class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" @click="listarReferencias(1,buscar,criterio)"
                                        class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <button style="margin-left: 10px;" type="submit" @click="mostarTodos()"
                                        class="btn btn-primary">
                                    <i class="fa fa-align-justify"></i>Mostrar todas
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Dni</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Domicilio</th>
                            <th>Localidad</th>
                            <th>Profesión</th>
                            <th>Contacto</th>
                            <th>Intereses</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="referencia in arrayReferencias" :key="referencia.id">
                            <td width="120px">
                                <button type="button" class="btn btn-primary btn-sm" @click="verResumen(referencia)">
                                    <i class="icon-magnifier-add"></i>
                                </button>
                                <button @click="abrirModal('referencia','actualizar', referencia)" type="button"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button>
                                <button v-if="referencia.activo" type="button" class="btn btn-danger btn-sm"
                                        @click="desactivarReferencia(referencia.id)">
                                    <i class="icon-trash"></i>
                                </button>
                                <button v-else type="button" class="btn btn-success btn-sm"
                                        @click="activarReferencia(referencia.id)">
                                    <i class="icon-check"></i>
                                </button>
                            </td>
                            <td v-text="referencia.nombre"></td>
                            <td v-text="referencia.apellidos"></td>
                            <td v-text="referencia.dni"></td>
                            <td v-text="referencia.email"></td>
                            <td v-text="referencia.telefono"></td>
                            <td v-text="referencia.domicilio"></td>
                            <td v-text="referencia.localidad"></td>
                            <td v-text="referencia.profesion"></td>
                            <td v-text="referencia.contacto"></td>
                            <td v-text="referencia.intereses"></td>
                            <td>
                                <div v-if="referencia.activo">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    </div>

                    <nav>
                        <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page >1 ">
                                <a class="page-link" href="#"
                                   @click.prevent="cambiarPagina(pagination.current_page - 1, buscar, criterio)">Ant</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumbers" :key="page"
                                :class="[page== isActive ? 'active' : '']">
                                <a class="page-link" href="#" @click.prevent="cambiarPagina(page, buscar, criterio)"
                                   v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                <a class="page-link" href="#"
                                   @click.prevent="cambiarPagina(pagination.current_page + 1, buscar, criterio)">Sig</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>

        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-primary modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" v-text="tituloModal"></h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
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
                                    <label class=" form-control-label"
                                           :class="{'text-error' : errorMostrarMsgReferencia.includes('Apellidos')}">Apellidos</label>
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
                                           placeholder="Introduzca teléfono"
                                           :class="{'is-invalid' : errorMostrarMsgReferencia.includes('Teléfono')}">
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
                                    <label class="form-control-label">Sexo</label>
                                    <select class="form-control" v-model="sexo">
                                        <option value="Hombre" selected>Hombre</option>
                                        <option value="Mujer">Mujer</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-control-label">Nacionalidad</label>
                                    <input type="text" v-model="nacionalidad" class="form-control"
                                           placeholder="Nacionalidad">
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="form-control-label">Contacto</label>
                                    <input type="text" v-model="contacto" class="form-control"
                                           placeholder="Persona contacto">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-control-label">Comp. Orígen</label>
                                    <input type="text" v-model="compañia_origen" class="form-control"
                                           placeholder="Compañía de orígen">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-control-label">Intereses</label>
                                    <textarea class="form-control" rows="3" v-model="intereses"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="form-control-label">Observaciones</label>
                                    <textarea class="form-control" rows="4" v-model="observaciones"></textarea>
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
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                                        @click="registrarReferencia()">Guardar
                                </button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                                        @click="actualizarReferencia()">Actualizar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" tabindex="-1" :class="{'mostrar' : modalResumen}" role="dialog"
             aria-labelledby="myModalLabel"
             style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-success modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ficha de la Referencia</h4>
                        <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-content-center">
                            <table class="table">
                                <tr>
                                    <th>Nombre:</th>
                                    <td>{{nombre}}</td>
                                    <th>Apellidos:</th>
                                    <td>{{apellidos}}</td>
                                </tr>
                                <tr>
                                    <th>Télefono:</th>
                                    <td>{{telefono}}</td>
                                    <th>Contacto:</th>
                                    <td>{{contacto}}</td>
                                </tr>
                                <tr>
                                    <th>Dirección:</th>
                                    <td>{{domicilio}}</td>
                                    <th>Localidad:</th>
                                    <td>{{localidad}}</td>
                                </tr>
                                <tr>
                                    <th>Provincia:</th>
                                    <td>{{provincia}}</td>
                                    <th>Código Postal:</th>
                                    <td>{{codigoPostal}}</td>
                                </tr>
                                <tr>
                                    <th>Profesion</th>
                                    <td>{{profesion}}</td>
                                    <th>Email:</th>
                                    <td>{{email}}</td>
                                </tr>
                                <tr>
                                    <th>DNI/NIF/NIE</th>
                                    <td>{{dni}}</td>
                                    <th>Fec. Nacimiento: </th>
                                    <td>{{fechaNacimiento}}</td>
                                </tr>
                                <tr>
                                    <th>Nacionalidad:</th>
                                    <td>{{nacionalidad}}</td>
                                    <th>Profesión: </th>
                                    <td>{{profesion}}</td>
                                </tr>
                                <tr>
                                    <th>Compañía Origen</th>
                                    <td>{{compañia_origen}}</td>
                                    <th>Intereses: </th>
                                    <td>{{intereses}}</td>
                                </tr>
                                <tr>
                                    <th>Sexo: </th>
                                    <td>{{sexo}}</td>
                                    <th>Estado: </th>
                                    <td v-if="activo" class="text-success">Activo</td>
                                    <td v-else class="text-error">No Activo</td>
                                </tr>
                                <tr>
                                    <th>Observaciones:</th>
                                    <td colspan="3">{{observaciones}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
    export default {
        data() {
            return {
                referencia_id: 0, nombre: '', apellidos: '', domicilio: '', localidad: '', codigoPostal: '',
                provincia: '', email: '', sexo: '', dni: '', telefono: '', fechaNacimiento: '', nacionalidad: '',
                intereses: '', compañia_origen: '', observaciones: '', contacto: '', profesion: '',
                arrayReferencias: [],activo:1,
                modal: 0,
                modalResumen: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorReferencia: 0,
                errorMostrarMsgReferencia: [],
                errorFormatoDni: 0,
                pagination: {
                    'total': 0,
                    'current_page': 0,
                    'per_page': 0,
                    'last_page': 0,
                    'from': 0,
                    'to': 0,
                },
                offset: 3,
                criterio: 'nombre',
                buscar: ''
            }
        },
        computed: {
            isActive: function () {
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumbers: function () {
                if (!this.pagination.to) {
                    return []
                }
                var from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while (from < to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods: {
            cargarPdf(){
                window.open('/referencia/listarpdf','blank');
            },
            listarReferencias(page, buscar, criterio) {
                let me = this;
                var url = '/referencia?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayReferencias = respuesta.referencias.data;
                    me.pagination = respuesta.pagination;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            verResumen(data = []) {
                this.modalResumen=1;
                this.nombre = data['nombre'];
                this.apellidos = data['apellidos'];
                this.domicilio = data['domicilio'];
                this.localidad = data['localidad'];
                this.codigoPostal = data['codigoPostal'];
                this.provincia = data['provincia'];
                this.email = data['email'];
                this.dni = data['dni'];
                this.telefono = data['telefono'];
                this.fechaNacimiento = data['fechaNacimiento'];
                this.nacionalidad = data['nacionalidad'];
                this.intereses = data['intereses'];
                this.compañia_origen = data['compañia_origen'];
                this.observaciones = data['observaciones'];
                this.contacto = data['contacto'];
                this.profesion = data['profesion'];
                this.sexo = data['sexo'];
                this.activo = data['activo'];
            },
            mostarTodos() {
                this.listarReferencias(1, '', 'nombre');
                this.buscar = '';
            },
            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                me.listarReferencias(page, buscar, criterio);
            },
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
                    me.cerrarModal();
                    me.listarReferencias(1, '', 'nombre');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            actualizarReferencia() {
                if (this.validarReferencia()) {
                    return;
                }
                let me = this;
                axios.put('/referencia/actualizar', {
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
                    'id': this.referencia_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarReferencias(1, '', 'nombre');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            desactivarReferencia(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de desactivar esta Referencia?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/referencia/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarReferencias(1, '', 'nombre');
                            swalWithBootstrapButtons(
                                'Desactivada!',
                                'La Referencia ha sido desactivada con éxito.',
                                'success'
                            )
                        })
                            .catch(function (error) {
                                console.log(error);
                            });

                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelado',
                            'No se ha desactivado la Referencia.',
                            'error'
                        )
                    }
                })
            },
            activarReferencia(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de activar esta Referencia?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/referencia/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarReferencias(1, '', 'nombre');
                            swalWithBootstrapButtons(
                                'Activada!',
                                'La Referencia ha sido activada con éxito.',
                                'success'
                            )
                        })
                            .catch(function (error) {
                                console.log(error);
                            });

                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons(
                            'Cancelado',
                            'No se ha activado la Referencia.',
                            'error'
                        )
                    }
                })
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
            cerrarModal() {
                this.modalResumen=0;
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.apellidos = '';
                this.domicilio = '';
                this.localidad = '';
                this.codigoPostal = '';
                this.provincia = '';
                this.email = '';
                this.sexo = '';
                this.dni = '';
                this.telefono = '';
                this.fechaNacimiento = '';
                this.nacionalidad = '';
                this.intereses = '';
                this.compañia_origen = '';
                this.observaciones = '';
                this.contacto = '';
                this.profesion = '';
            },
            abrirModal(modelo, accion, data = []) {
                this.errorMostrarMsgReferencia = [];
                this.errorReferencia = 0;
                this.errorFormatoDni = 0;
                switch (modelo) {
                    case "referencia": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.nombre = '';
                                this.apellidos = '';
                                this.domicilio = '';
                                this.localidad = '';
                                this.codigoPostal = '';
                                this.provincia = '';
                                this.email = '';
                                this.dni = '';
                                this.telefono = '';
                                this.fechaNacimiento = '';
                                this.nacionalidad = '';
                                this.intereses = '';
                                this.compañia_origen = '';
                                this.observaciones = '';
                                this.contacto = '';
                                this.profesion = '';
                                this.tituloModal = 'Registrar Nueva Referencia';
                                this.tipoAccion = 1;
                                this.sexo = "Hombre";
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Referencia";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.apellidos = data['apellidos'];
                                this.domicilio = data['domicilio'];
                                this.localidad = data['localidad'];
                                this.codigoPostal = data['codigoPostal'];
                                this.provincia = data['provincia'];
                                this.email = data['email'];
                                this.dni = data['dni'];
                                this.telefono = data['telefono'];
                                this.fechaNacimiento = data['fechaNacimiento'];
                                this.nacionalidad = data['nacionalidad'];
                                this.intereses = data['intereses'];
                                this.compañia_origen = data['compañia_origen'];
                                this.observaciones = data['observaciones'];
                                this.contacto = data['contacto'];
                                this.profesion = data['profesion'];
                                this.sexo = data['sexo'];
                                this.referencia_id = data['id'];
                                break;
                            }
                        }
                    }
                }
            }
        },
        mounted() {
            this.listarReferencias(1, this.buscar, this.criterio);
        }
    }
</script>

<style>
    .modal-content {
        width: 100% !important;
        position: absolute !important;
    }

    .mostrar {
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }

    .div-error {
        display: flex;
        justify-content: center;
    }

    .text-error {
        color: red !important;
        font-weight: bold;
    }
</style>