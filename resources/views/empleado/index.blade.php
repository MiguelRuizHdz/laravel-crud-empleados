@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Si hay una session o una variable llamada mensaje -->
    @if(Session::has('mensaje'))
        <div class="alert alert-success alert-dismissable" fade show" role="alert">
            <!-- Mostramos el mensaje -->
            {{ Session::get('mensaje') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <strong></strong> 
        </div>
        
        <script>
          $(".alert").alert();
        </script>
    @endif  

    <a href="{{ url('empleado/create') }}" class="btn btn-success">Registar nuevo empleado</a>
    <br>
    <br>

    <table class="table">

        <thead>
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach( $empleados as $empleado )
            <tr>
                <td>{{ $empleado-> id}}</td>
                <td>
                    <!-- asset Nos da acceso al deposito storage -->
                    <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" width="100" alt="">
                </td>

                <td>{{ $empleado-> Nombre}}</td>
                <td>{{ $empleado-> ApellidoPaterno}}</td>
                <td>{{ $empleado-> ApellidoMaterno}}</td>
                <td>{{ $empleado-> Correo}}</td>
                <td>
                    
                <a href="{{ url('/empleado/'.$empleado->id.'/edit' ) }}" class="btn btn-primary">
                    Editar
                </a>
                | 
                    <form action="{{ url('/empleado/'.$empleado->id ) }}" class="d-inline" method="post">
                    <!-- Laravel siempre ocupa la llave de seguridad para el borrado o inserción de datos-->
                        @csrf
                        <!-- Convertimos el metodo post a delete -->
                        {{ method_field('DELETE') }}
                        <input type="submit" class="btn btn-danger" onclick="return confirm('¿Quieres borrar')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
    {!! $empleados->links() !!}

</div>
@endsection