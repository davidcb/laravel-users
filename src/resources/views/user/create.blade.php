@extends('layouts.admin')

@section('content')
<form id="form" role="form" method="POST" action="{{ route('admin.users.store') }}">
	@csrf

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Crear usuario</strong>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group row">
							<label class="col-md-3 col-lg-2 col-form-label" for="name">Nombre</label>
							<div class="col-md-9 col-lg-10">
								<input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-lg-2 col-form-label" for="email">Email</label>
							<div class="col-md-9 col-lg-10">
								<input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-lg-2 col-form-label" for="password">Contraseña</label>
							<div class="col-md-9 col-lg-10">
								<input type="password" id="password" name="password" class="form-control" placeholder="Contraseña">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-lg-2 col-form-label" for="password_confirmation">Confirmar contraseña</label>
							<div class="col-md-9 col-lg-10">
								<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar contraseña">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-md-3 col-lg-2 col-form-label" for="role_id">Grupo de usuario</label>
							<div class="col-md-9 col-lg-10">
								<select id="role_id" name="role_id" class="form-control" >
									<option value="">Seleccionar...</option>
									@foreach ($roles as $role)
										<option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
					</form>
				</div>
				<div class="card-footer">
					<button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Guardar</button>
					<a href="{{ URL::previous() }}" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Cancelar</a>
				</div>
			</div>
		</div>
	</div>
</form>

@endsection
