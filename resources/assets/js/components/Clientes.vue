<template>
    <main class="main">
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
        </ol>
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Listado de Clientes
                    <button @click="abrirModal('cliente','registrar')" type="button" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterio">
                                    <option value="nombre">Nombre</option>
                                    <option value="apellidos">Apellidos</option>
                                    <option value="dni">DNI</option>
                                </select>
                                <input type="text" v-model="buscar" @keyup.enter="listarCliente(1,buscar,criterio)"
                                       class="form-control"
                                       placeholder="Texto a buscar">
                                <button type="submit" @click="listarCliente(1,buscar,criterio)" class="btn btn-primary">
                                    <i class="fa fa-search"></i> Buscar
                                </button>
                                <button style="margin-left: 10px;" type="submit" @click="mostarTodos()" class="btn btn-primary">
                                    <i class="fa fa-align-justify"></i>Mostrar todos
                                </button>
                            </div>
                        </div>
                    </div>
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
                            <th>Provincia</th>
                            <th>Profesión</th>
                            <th>Contacto</th>
                            <th>Categoría</th>
                            <th>Estado</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="cliente in arrayCliente" :key="cliente.id">
                            <td>
                                <button type="button" class="btn btn-primary btn-sm">
                                    <i class="icon-magnifier-add"></i>
                                </button> &nbsp;
                                <button @click="abrirModal('cliente','actualizar', cliente)" type="button"
                                        class="btn btn-warning btn-sm">
                                    <i class="icon-pencil"></i>
                                </button> &nbsp;
                                <template v-if="cliente.activo">
                                    <button type="button" class="btn btn-danger btn-sm"
                                            @click="desactivarCliente(cliente.id)">
                                        <i class="icon-trash"></i>
                                    </button>
                                </template>
                                <template v-else>
                                    <button type="button" class="btn btn-success btn-sm"
                                            @click="activarCliente(cliente.id)">
                                        <i class="icon-check"></i>
                                    </button>
                                </template>


                            </td>
                            <td v-text="cliente.nombre"></td>
                            <td v-text="cliente.apellidos"></td>
                            <td v-text="cliente.dni"></td>
                            <td v-text="cliente.email"></td>
                            <td v-text="cliente.telefono"></td>
                            <td v-text="cliente.domicilio"></td>
                            <td v-text="cliente.localidad"></td>
                            <td v-text="cliente.provincia"></td>
                            <td v-text="cliente.profesion"></td>
                            <td v-text="cliente.contacto"></td>
                            <td v-text="cliente.nombre_categoria"></td>

                            <td>
                                <div v-if="cliente.activo">
                                    <span class="badge badge-success">Activo</span>
                                </div>
                                <div v-else>
                                    <span class="badge badge-danger">Desactivado</span>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
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
        <!--Inicio del modal agregar/actualizar-->
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
                                           placeholder="Introduzca teléfono"
                                           :class="{'is-invalid' : errorMostrarMsgCliente.includes('Teléfono')}">
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

                                    <input type="text" v-model="provicia" class="form-control"
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
                                    <label class="form-control-label col-md-4">Contacto</label>
                                    <input type="text" v-model="contacto" class="form-control col-md-8"
                                           placeholder="Persona contacto">
                                </div>
                                <div class="col-md-5">
                                    <label class="col-md-1 form-control-label">Observac.</label>
                                    <textarea class="form-control" rows="5" v-model="observaciones"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-control-label">Categoría</label>
                                    <select v-model="id_categoria" class="form-control">
                                        <option v-for="categoria in arrayCategorias" :key="categoria.id" :value="categoria.id"
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
                                <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                <button type="button" v-if="tipoAccion==1" class="btn btn-primary"
                                        @click="registrarCliente()">Guardar
                                </button>
                                <button type="button" v-if="tipoAccion==2" class="btn btn-primary"
                                        @click="actualizarCliente()">Actualizar
                                </button>
                            </div>

                        </form>
                    </div>
                </div>    <!-- /.modal-content -->
                <!-- /.modal-dialog -->
                <!--Fin del modal-->
                <!-- Inicio del modal Eliminar -->
            </div><!-- Fin del modal Eliminar -->
        </div>
    </main>
</template>

<script>
    export default {
        data() {
            return {
                cliente_id: 0, nombre: '', apellidos: '', dni: '', email: '', telefono: '', fechaNacimiento: '',
                sexo: 'Hombre', domicilio: '', localidad: '', codigoPostal: '', provicia: '', cuentaBancaria: '',
                profesion: '', contacto: '', id_categoria: 1, observaciones: '',
                arrayCliente: [],
                arrayCategorias: [],
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                errorCliente: 0,
                errorMostrarMsgCliente: [],
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
            listarCategoria() {
                let me = this;
                axios.get('/categoria/selectcategoria').then(function (response) {
                    me.arrayCategorias = response.data.categorias;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            listarCliente(page, buscar, criterio) {
                let me = this;
                var url = '/cliente?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                axios.get(url).then(function (response) {
                    var respuesta = response.data;
                    me.arrayCliente = respuesta.clientes.data;
                    me.pagination = respuesta.pagination;
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            mostarTodos(){
              this.listarCliente(1,'','nombre');
              this.buscar='';
            },
            cambiarPagina(page, buscar, criterio) {
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                me.listarCliente(page, buscar, criterio);
            },
            registrarCliente() {
                if (this.validarCliente()) {
                    return;
                }
                let me = this;
                axios.post('/cliente/registrar', {
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'dni': this.dni,
                    'email': this.email,
                    'telefono': this.telefono,
                    'fechaNacimiento': this.fechaNacimiento,
                    'sexo': this.sexo,
                    'domicilio': this.domicilio,
                    'codigoPostal': this.codigoPostal,
                    'provincia': this.provicia,
                    'cuentaBancaria': this.cuentaBancaria,
                    'contacto': this.contacto,
                    'id_categoria': this.id_categoria,
                    'observaciones': this.observaciones,
                    'localidad': this.localidad,
                    'profesion': this.profesion
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCliente(1, '', 'nombre');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            actualizarCliente() {
                if (this.validarCliente()) {
                    return;
                }
                let me = this;
                axios.put('/cliente/actualizar', {
                    'nombre': this.nombre,
                    'apellidos': this.apellidos,
                    'dni': this.dni,
                    'email': this.email,
                    'telefono': this.telefono,
                    'fechaNacimiento': this.fechaNacimiento,
                    'sexo': this.sexo,
                    'domicilio': this.domicilio,
                    'codigoPostal': this.codigoPostal,
                    'provincia': this.provicia,
                    'cuentaBancaria': this.cuentaBancaria,
                    'contacto': this.contacto,
                    'id_categoria': this.id_categoria,
                    'observaciones': this.observaciones,
                    'localidad': this.localidad,
                    'profesion': this.profesion,
                    'id': this.cliente_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarCliente(1, '', 'nombre');
                })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            desactivarCliente(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de desactivar este Cliente?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/cliente/desactivar', {
                            'id': id
                        }).then(function (response) {
                            me.listarCliente(1, '', 'nombre');
                            swalWithBootstrapButtons(
                                'Desactivado!',
                                'El Cliente ha sido desactivado con éxito.',
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
                            'No se ha desactivado el Cliente.',
                            'error'
                        )
                    }
                })
            },
            activarCliente(id) {
                const swalWithBootstrapButtons = swal.mixin({
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: true,
                });
                swalWithBootstrapButtons({
                    title: '¿Está seguro de activar este Cliente?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.value) {
                        let me = this;
                        axios.put('/cliente/activar', {
                            'id': id
                        }).then(function (response) {
                            me.listarCliente(1, '', 'nombre');
                            swalWithBootstrapButtons(
                                'Activado!',
                                'El Cliente ha sido activado con éxito.',
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
                            'No se ha activado el Cliente.',
                            'error'
                        )
                    }
                })
            },
            validarCliente() {
                this.errorCliente = 0;
                this.errorMostrarMsgCliente = [];
                if (!this.nombre) this.errorMostrarMsgCliente.push('Nombre');
                if (!this.apellidos) this.errorMostrarMsgCliente.push('Apellidos');
                if (!this.dni) this.errorMostrarMsgCliente.push('DNI');
                if (!this.telefono) this.errorMostrarMsgCliente.push('Teléfono');
                if (!this.id_categoria) this.errorMostrarMsgCliente.push('Categoría');
                if (!this.validarDni(this.dni)) {
                    this.errorFormatoDni = 1;
                    this.errorCliente = 1;
                }
                if (this.errorMostrarMsgCliente.length > 0) this.errorCliente = 1;
                return this.errorCliente;
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
                this.modal = 0;
                this.tituloModal = '';
                this.nombre = '';
                this.apellidos = '';
                this.dni = '';
                this.email = '';
                this.telefono = '';
                this.fechaNacimiento = '';
                this.sexo = '';
                this.domicilio = '';
                this.codigoPostal = '';
                this.localidad = '';
                this.provicia = '';
                this.cuentaBancaria = '';
                this.contacto = '';
                this.id_categoria = '';
                this.observaciones = '';
                this.profesion = '';
            },
            abrirModal(modelo, accion, data = []) {
                this.errorMostrarMsgCliente = [];
                this.errorCliente = 0;
                this.errorFormatoDni = 0;
                switch (modelo) {
                    case "cliente": {
                        switch (accion) {
                            case 'registrar': {
                                this.modal = 1;
                                this.nombre = '';
                                this.apellidos = '';
                                this.dni = '';
                                this.email = '';
                                this.telefono = '';
                                this.fechaNacimiento = '';
                                this.domicilio = '';
                                this.codigoPostal = '';
                                this.provicia = '';
                                this.cuentaBancaria = '';
                                this.contacto = '';
                                this.observaciones = '';
                                this.profesion = '';
                                this.localidad = '';
                                this.tituloModal = 'Registrar Nuevo Cliente';
                                this.tipoAccion = 1;
                                this.sexo = "Hombre";
                                this.id_categoria = 1;
                                break;
                            }
                            case 'actualizar': {
                                //console.log(data);
                                this.modal = 1;
                                this.tituloModal = "Actualizar Cliente";
                                this.tipoAccion = 2;
                                this.nombre = data['nombre'];
                                this.apellidos = data['apellidos'];
                                this.dni = data['dni'];
                                this.email = data['email'];
                                this.telefono = data['telefono'];
                                this.fechaNacimiento = data['fechaNacimiento'];
                                this.sexo = data['sexo'];
                                this.domicilio = data['domicilio'];
                                this.localidad = data['localidad'];
                                this.codigoPostal = data['codigoPostal'];
                                this.provicia = data['provicia'];
                                this.cuentaBancaria = data['cuentaBancaria'];
                                this.profesion = data['profesion'];
                                this.contacto = data['cuentaBancaria'];
                                this.id_categoria = data['id_categoria'];
                                this.observaciones = data['observaciones'];
                                this.cliente_id = data['id'];
                                break;
                            }
                        }
                    }
                }
                this.listarCategoria();
            }
        },
        mounted() {
            this.listarCliente(1, this.buscar, this.criterio);
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