@extends('layouts.app')

@section('content')
<div class="container">
                                                                    <!-- Encriptación para enviar fotografia o archivos -->
    <form action=" {{ url('/empleado/'.$empleado->id ) }}" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Convertimos el metodo post a patch -->
        {{ method_field('PATCH') }}
                                <!-- inclusión modo editar -->
        @include('empleado.form', ['modo'=>'Editar'])

    </form>

</div>
@endsection