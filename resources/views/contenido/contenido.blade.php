@extends('principal')
@section('contenido')
    @if(Auth::check())
        @if(Auth::user()->idrol==1)
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
                <nuevocliente-component></nuevocliente-component>
            </template>
            <template v-if="menu==3">
                <referencia-component></referencia-component>
            </template>
            <template v-if="menu==4">
                <nuevareferencia-component></nuevareferencia-component>
            </template>
            <template v-if="menu==5">
                <vencimientos-component></vencimientos-component>
            </template>
            <template v-if="menu==6">
                <citashoy-component></citashoy-component>
            </template>
            <template v-if="menu==7">
                <citasdia-component></citasdia-component>
            </template>
            <template v-if="menu==8">
                <calendario-component></calendario-component>
            </template>
            <template v-if="menu==9">
                <producto-component></producto-component>
            </template>
            <template v-if="menu==10">
                <categoria-component></categoria-component>
            </template>
            <template v-if="menu==11">
                <ramo-component></ramo-component>
            </template>
            <template v-if="menu==12">
                <vencimientosmesactual-component></vencimientosmesactual-component>
            </template>
            <template v-if="menu==13">
                <h1>Contenido de menu 12</h1>
            </template>
            <template v-if="menu==14">
                <h1>Contenido de menu 13</h1>
            </template>
            <template v-if="menu==15">
                <informes-component></informes-component>
            </template>
            <template v-if="menu==16">
                <rol-component></rol-component>
            </template>
            <template v-if="menu==17">
                <user-component></user-component>
            </template>
        @elseif(Auth::user()->idrol==2)
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
                <nuevocliente-component></nuevocliente-component>
            </template>
            <template v-if="menu==3">
                <referencia-component></referencia-component>
            </template>
            <template v-if="menu==4">
                <nuevareferencia-component></nuevareferencia-component>
            </template>
            <template v-if="menu==5">
                <vencimientos-component></vencimientos-component>
            </template>
            <template v-if="menu==6">
                <citashoy-component></citashoy-component>
            </template>
            <template v-if="menu==7">
                <citasdia-component></citasdia-component>
            </template>
            <template v-if="menu==8">
                <calendario-component></calendario-component>
            </template>
            <template v-if="menu==12">
                <vencimientosmesactual-component></vencimientosmesactual-component>
            </template>
            <template v-if="menu==13">
                <h1>Contenido de menu 12</h1>
            </template>
            <template v-if="menu==14">
                <h1>Contenido de menu 13</h1>
            </template>
            <template v-if="menu==15">
                <informes-component></informes-component>
            </template>

        @else
        @endif
    @endif

@endsection