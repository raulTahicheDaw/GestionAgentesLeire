@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <div><h1>Contenido de menu 0</h1></div>
    </template>
    <template v-if="menu==1">
        <cliente-component></cliente-component>
    </template>
    <template v-if="menu==2">
        <h1>Contenido de menu 2</h1>
    </template>
    <template v-if="menu==3">
        <h1>Contenido de menu 3</h1>
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
        <h1>Contenido de menu 8</h1>
    </template>
    <template v-if="menu==9">
        <h1>Contenido de menu 9</h1>
    </template>
    <template v-if="menu==10">
        <h1>Contenido de menu 10</h1>
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