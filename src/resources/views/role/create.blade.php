@extends('layouts.admin')

@section('content')
<form id="form" role="form" method="POST" action="{{ route('admin.roles.store') }}">
	@csrf
	@method('PUT')

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<strong>Crear grupo de usuario</strong>
				</div>
				<div class="card-body">
					<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group row">
							<label class="col-md-3 col-lg-2 col-form-label" for="name">Nombre</label>
							<div class="col-md-9 col-lg-10">
								<input type="text" id="name" name="name" class="form-control" placeholder="Nombre" value="{{ old('name') }}">
							</div>
						</div>

						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr class="header">
									<th>Nombre permiso</th>
									<th>Permitir</th>
								</tr>
							</thead>

							<tbody role="alert" aria-live="polite" aria-relevant="all">
								@foreach ($permissions as $permission)
								<tr>
									<td>{{ $permission->name }}</td>
									<td><input type="checkbox" name="permissions[]" value="{{ $permission->id }}" /></td>
								</tr>
								@endforeach
							</tbody>
						</table>
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
