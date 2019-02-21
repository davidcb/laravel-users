@extends('admin.layouts.app')

@section('content')

<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<div class="row justify-content-between">
					<div class="col-2">
						<i class="fa fa-align-justify"></i> Usuarios
					</div>
					<div class="col-4 text-right actions">
						<a href="{{ route('admin.users.create') }}"><i class="fa fa-plus"></i></a>
						<a class="delete_selected" href="#"><i class="fa fa-trash"></i></a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-responsive-sm table-striped">
					<thead>
						<tr class="header">
							<th class="checkbox2"><input type="checkbox" id="selectAll" name="selectAll" value="1" /></th>
							<th>Nombre</th>
							<th>Email</th>
							<th>Grupo de usuario</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($users as $user)
						<tr>
							<td class="checkbox2"><input type="checkbox" name="selected[]" value="{{ $user->id }}" class="check" /></td>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>{{ $user->role->name }}</td>
							<td class="actions">
								<a class="edit" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-edit"></i></a>
								<a class="delete" href="{{ route('admin.users.destroy', $user->id) }}"><i class="fa fa-trash"></i></a>
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

@section('scripts')
@parent

<script>
	$(function() {
		$('.delete_selected').click(function(e) {
			e.preventDefault();
			if (confirm('¿Estás seguro de que deseas eliminar los usuarios seleccionados?')) {
				$('.checkbox2 input:checked').each(function() {
					clicked = $(this).parent().parent();
					deleteFromList(clicked);
				});
			}
		});

		$('tbody .delete').click(function(e) {
			e.preventDefault();
			if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
				clicked = $(this).parent().parent();
				deleteFromList(clicked);
			}
		});

		$('.reset').click(function(e) {
			e.preventDefault();
			window.location.replace($('#form').attr('action'));
		});
	});
</script>

@endsection
