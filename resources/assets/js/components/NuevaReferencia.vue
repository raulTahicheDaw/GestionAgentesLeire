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
                                <label class="form-control-label">Nombre<sup>*</sup></label>
                                <input type="text" v-model="nombre" class="form-control"
                                       placeholder="Introduzca el nombre">
                            </div>
                            <div class="col-md-5">
                                <label class=" form-control-label">Apellidos</label>
                                <input type="text" v-model="apellidos" class="form-control"
                                       placeholder="Introduzca los apellidos">
                            </div>

                            <div class="col-md-3">
                                <label class="form-control-label">DNI/NIE</label>
                                <input type="text" v-model="dni" class="form-control"
                                       pattern="(([X-Zx-z]{1})([-]?)(\d{7})([-]?)([A-Za-z]{1}))|((\d{8})([-]?)([A-Za-z]{1}))"
                                       placeholder="Introduzca el DNI/CIF">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label class="form-control-label">Teléfono<sup>*</sup></label>
                                <input type="text" v-model="telefono" class="form-control"
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
        name: "NuevaReferencia"
    }
</script>

<style scoped>

</style>