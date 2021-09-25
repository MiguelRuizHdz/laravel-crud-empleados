@extends('layouts.app')

@section('content')
<div class="container">
                                                        <!-- Enviar fotografia o archivos -->
    <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
    <!-- llave de seguridad - control de seguridad (token) -->
    @csrf 
    <!-- inclusión modo editar -->
    @include('empleado.form', ['modo'=>'Crear'])

    </form>

</div>
@endsection