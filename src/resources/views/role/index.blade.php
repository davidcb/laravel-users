@extends('admin.layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<div class="row justify-content-between">
					<div class="col-2">
						<i class="fa fa-align-justify"></i> Grupos de usuario
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-responsive-sm table-striped">
					<thead>
						<tr class="header">
							<th>Nombre</th>
							<th>Usuarios</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($roles as $role)
						<tr>
							<td>{{ $role->name }}</td>
							<td>{{ $role->users->count() }}</td>
							<td class="actions">
								<a class="edit" href="{{ route('admin.roles.edit', $role->id) }}"><i class="fa fa-edit"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

				{!! $pagination->render() !!}
			</div>
		</div>
	</div>
</div>

@endsection