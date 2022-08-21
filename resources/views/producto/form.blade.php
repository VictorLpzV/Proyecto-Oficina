<h1>{{ $modo }} producto</h1>

@if(count($errors)>0)

    <div class="alert alert-primary" role="alert">
<ul> 
    @foreach( $errors->all() as $error)
          <li> {{ $error }} </li>
    @endforeach
</ul>    
    </div>  

@endif

<div class="form-group">
<label for="Producto"> Producto</label>
<input type="text" class="form-control" name="Producto" 
value="{{ isset($producto->Producto)?$producto->Producto:old('Producto')}}" id="Producto"> 
<br>
</div>


<div class="form-group">
<label for="Cantidad"> Cantidad</label>
<input type="text" class="form-control" name="Cantidad" 
value="{{isset($producto->Cantidad)?$producto->Cantidad:old('Cantidad')}}" id="Cantidad">
<br>
</div>


<div class="form-group">
<label for="Caducidad"> Caducidad</label>
<input type="text" class="form-control" name="Caducidad" 
value="{{isset($producto->Caducidad)?$producto->Caducidad:old('Caducidad')}}" id="Caducidad">
<br>
</div>

<div class="form-group">
<label for="Precio"> Precio</label>
<input type="text" class="form-control" name="Precio" 
value="{{isset($producto->Precio)?$producto->Precio:old('Precio')}}" id="Precio">
<br>
</div>

<div class="form-group">
<label for="Foto"> </label>
@if(isset($producto->Foto))
<img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$producto->Foto}}" width="100" alt="">
@endif
<input type="file" class="form-control" name="Foto" value="" id="Foto">
<br>
</div>

<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{url('/producto')}}"> Regresar</a>
<br>