<div class="form-group" style ='display:grid'>
<label for ="Nombre" class="control-label">{{'Nombre'}}</label>
<input type = "text" name="Nombre" id="Nombre" value = "{{	isset($empleado->Nombre) ? 	$empleado->Nombre: old('Nombre')}}" class="from-control {{ $errors->has('Nombre')? 'is-invalid' : '' }}">


{!! $errors->first('Nombre', '<div class="invalid-feedback">:message</div>') !!}
	
</div>

<div class="form-group" style ='display:grid'>
<label for ="Apellido" class="control-label">{{'Apellido'}}</label>
<input type = "text" name="Apellido" id="Apellido" value = "{{	isset($empleado->Apellido) ? 	$empleado->Apellido: old('Apellido')}}" class="from-control {{ $errors->has('Apellido')? 'is-invalid' : '' }}">

{!! $errors->first('Apellido', '<div class="invalid-feedback">:message</div>') !!}

</div>

<div class="form-group" style ='display:grid'>
<label for ="Email" class="control-label">{{'Email'}}</label>
<input type = "email" name="Email" id="Email" value = "{{	isset($empleado->Email) ? 	$empleado->Email: old('Email')}}" class="from-control {{ $errors->has('Email')? 'is-invalid' : '' }}">

{!! $errors->first('Email', '<div class="invalid-feedback">:message</div>') !!}

</div>

<div class="form-group" style ='display:grid'>
<label for ="Foto" class="control-label">{{'Foto'}}</label>
@if(isset($empleado->Foto))
<br>
<img src="{{ asset('storage') .'/'. $empleado->Foto}}" alt="" width="100" class="img-thumbnail img-fluid">
<br>
@endif
<input type = "file" name="Foto" id="Foto" value = "" class="from-control {{ $errors->has('Foto')? 'is-invalid' : '' }}">

{!! $errors->first('Foto', '<div class="invalid-feedback">:message</div>') !!}


</div>

<div class="form-group"  >
<input type="submit" class="btn btn-success" value="{{	$Modo=='crear' ? 'Agregar' : 'Modificar'	}}">
<a href="{{ url('empleados')}}" class="btn btn-primary" >Regresar</a> 
</div>


