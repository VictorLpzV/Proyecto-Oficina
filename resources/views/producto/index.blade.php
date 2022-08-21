@extends('layouts.app')

@section('content')
<div class="container">


@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
{{Session::get('mensaje')}}



<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
</div>
@endif




<div class="Productos de Oficina">
  <h1 class="display-4">Productos de Oficina</h1>
  <p class="lead">Página dedicada al registro de productos de oficina.</p>
  <hr class="my-4">
  <img src="https://filogb.com/wp-content/uploads/2020/08/Header_POst_BAcklist.jpg" class="img-fluid" alt="Responsive image">
  <hr class="my-4">
</div>



<br>
</br>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h3 class="display-4">Tabla de Productos</h3>
  </div>
</div>

<br>
</br>
<table class="table table-dark table table-striped ">


    <thead class="thead-light">
        <tr>      
            <th><h4>#</h4></th>
            <th><h4>Foto</h4></th>
            <th><h4>Producto</h4></th>
            <th><h4>Cantidad</h4></th>
            <th><h4>Caducidad</h4></th>
            <th><h4>Precio</h4></th>  
            <th><h4>Acciones</h4></th>
        </tr>
    </thead>

    <tbody>
        @foreach($productos as $producto)
        <tr>
            <td>{{$producto->id}}</td>

            <td>
                <img class="img-thumbnail img-fluid"  src="{{asset('storage').'/'.$producto->Foto}}" width="100" alt="">
                
            </td>


            <td>{{$producto->Producto}}</td>
            <td>{{$producto->Cantidad}}</td>
            <td>{{$producto->Caducidad}}</td>
            <td>{{$producto->Precio}}</td>
            <td>

            <a href="{{url('/producto/'.$producto->id.'/edit')}}" class="btn btn-warning"> 
                Editar 
            </a>  
            
            <form action="{{url('/producto/'.$producto->id)}}" class="d-inline" method="post">
            @csrf
            {{method_field('DELETE')}}
            <input class="btn btn-danger"  type="submit" onclick="return confirm('¿Quieres borrar?')" value="Borrar">
            </form>

            </td>
        </tr>
        @endforeach
    </tbody>

</table>
{!! $productos->links() !!}

<br>
</br>



<a href="{{url('/producto/create')}}" class="btn btn-success" > Registrar nuevo producto</a>


</div>
@endsection