@extends('layout.plantilla')

@section('contenido')
<div class="container mt-4">
	<h2>Administrar Matrículas</h2>
	<!-- Formulario para activar/desactivar plazo de matrículas -->
	<div class="card mb-4">
		<div class="card-header">Plazo de Matrículas</div>
		<div class="card-body">
			<form method="POST" action="{{ route('admin.matriculas.plazo') }}">
				@csrf
				<div class="row mb-3">
					<div class="col-md-4">
						<label for="fecha_inicio" class="form-label">Fecha de inicio</label>
						<input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $plazo->fecha_inicio ?? '') }}" required>
					</div>
					<div class="col-md-4">
						<label for="fecha_fin" class="form-label">Fecha de fin</label>
						<input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $plazo->fecha_fin ?? '') }}" required>
					</div>
					<div class="col-md-4 d-flex align-items-end">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="activo" name="activo" {{ old('activo', $plazo->activo ?? false) ? 'checked' : '' }}>
							<label class="form-check-label" for="activo">Activar plazo</label>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-primary">Guardar plazo</button>
			</form>
		</div>
	</div>

	<!-- Tabla de matrículas de alumnos -->
	<div class="card">
		<div class="card-header">Matrículas de Alumnos</div>
		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th class="text-center">Alumno</th>
                        <th class="text-center">Numero de cursos</th>
						<th class="text-center">Estado</th>
						<th class="text-center">Acciones</th>
					</tr>
				</thead>
				<tbody>
					@foreach($matriculas as $matricula)
					<tr>
						<td class="text-center">{{ $matricula->estudiante->user->name }}</td>
                        <td class="text-center">{{ $matricula->cursos->count() }}</td>
						<td class="text-center">
							<form method="POST" action="{{ route('admin.matriculas.estado', $matricula->idMatricula) }}">
								@csrf
								@method('PUT')
								<select name="estado" class="form-select form-select-sm">
									<option value="pendiente" {{ $matricula->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
									<option value="aprobada" {{ $matricula->estado == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
									<option value="rechazada" {{ $matricula->estado == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
								</select>
								<button type="submit" class="btn btn-sm btn-success mt-1">Actualizar</button>
							</form>
						</td>
						<td>
							<!-- Aquí puedes agregar más acciones si lo deseas -->
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection
