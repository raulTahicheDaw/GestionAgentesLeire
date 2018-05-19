@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <div class="container-fluid text-center">
            <h1 style="color: #CF9FE2">Bienvenido a: </h1>
            <br>
            <img src="img/logoGrande" class="img-fluid" alt="Responsive image" style="width: 60%;">
        </div>
    </template>
    <template v-if="menu==1">
        <cliente-component></cliente-component>
    </template>
    <template v-if="menu==2">
        <h1>Contenido de menu 2</h1>
    </template>
    <template v-if="menu==3">
        <referencia-component></referencia-component>
    </template>
    <template v-if="menu==4">
        <h1>Contenido de menu 4</h1>
    </template>
    <template v-if="menu==5">
        <h1>Contenido de menu 5</h1>
    </template>
    <template v-if="menu==6">
        <h1>Contenido de menu 6</h1>
    </template>
    <template v-if="menu==7">
        <h1>Contenido de menu 7</h1>
    </template>
    <template v-if="menu==8">
        <calendario-component></calendario-component>
    </template>
    <template v-if="menu==9">
        <h1>Contenido de menu 9</h1>
    </template>
    <template v-if="menu==10">
        <categoria-component></categoria-component>
    </template>
    <template v-if="menu==11">
        <h1>Contenido de menu 11</h1>
    </template>
    <template v-if="menu==12">
        <h1>Contenido de menu 12</h1>
    </template>
    <template v-if="menu==13">
        <h1>Contenido de menu 13</h1>
    </template>

@endsection