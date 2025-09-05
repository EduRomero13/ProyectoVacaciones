@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
	<h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Gestión de Horarios</h2>
	@if(session('success'))
		<div class="bg-green-500 text-black px-4 py-2 rounded mb-4 text-center">{{ session('success') }}</div>
	@endif
	@if($errors->any())
		<div class="bg-red-500 text-black px-4 py-2 rounded mb-4">
			<ul class="list-disc list-inside text-sm">
				@foreach($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

	<div class="bg-white shadow-soft-xl rounded-2xl p-6 mb-8">
		<h3 class="text-xl font-semibold mb-4">Asignar Curso a Aula</h3>
		<form method="POST" action="{{ route('admin.horarios.store') }}">
			@csrf
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
				<div>
					<label class="block font-semibold mb-1">Curso</label>
					<select name="idCurso" class="border rounded px-2 py-1 w-full" required>
						<option value="">Seleccione un curso</option>
						@foreach($cursos as $curso)
							<option value="{{ $curso->idCurso }}">{{ $curso->getNombre() }}</option>
						@endforeach
					</select>
				</div>
				<div>
					<label class="block font-semibold mb-1">Aula</label>
					<select name="idAula" class="border rounded px-2 py-1 w-full" required>
						<option value="">Seleccione un aula</option>
						@foreach($aulas as $aula)
							@if($aula->disponibilidad)
								<option value="{{ $aula->idAula }}">{{ $aula->descripcion }}</option>
							@endif
						@endforeach
					</select>
				</div>
				<div>
					<label class="block font-semibold mb-1">Día de la semana</label>
					<select name="diaSemana" class="border rounded px-2 py-1 w-full" required>
						<option value="">Seleccione un día</option>
						<option value="Lunes">Lunes</option>
						<option value="Martes">Martes</option>
						<option value="Miércoles">Miércoles</option>
						<option value="Jueves">Jueves</option>
						<option value="Viernes">Viernes</option>
					</select>
				</div>
				<div class="flex gap-2">
					<div>
						<label class="block font-semibold mb-1">Hora inicio</label>
						<input type="time" name="horaInicio" class="border rounded px-2 py-1 w-full" required step="3600" min="07:00" max="19:00">
					</div>
					<div>
						<label class="block font-semibold  mb-1">Hora fin</label>
						<input type="time" name="horaFin" class="border rounded px-2 py-1 w-full" required step="3600" min="07:00" max="19:00">
					</div>
				</div>
			</div>
			<button type="submit" class="bg-purple-600 text-black px-6 py-2 rounded">Asignar horario</button>
		</form>
	</div>

	<div class="bg-white shadow-soft-xl rounded-2xl p-6">
		<h3 class="text-xl font-semibold mb-4">Horarios Asignados</h3>
		<table class="min-w-full table-auto border rounded-lg overflow-hidden">
			<thead>
				<tr class="bg-gray-100">
					<th class="px-4 py-2">Curso</th>
					<th class="px-4 py-2">Aula</th>
					<th class="px-4 py-2">Día</th>
					<th class="px-4 py-2">Hora inicio</th>
					<th class="px-4 py-2">Hora fin</th>
				</tr>
			</thead>
			<tbody>
				@forelse($horarios as $horario)
					<tr>
						<td class="border px-4 py-2">{{ $horario->curso->getNombre() }}</td>
						<td class="border px-4 py-2">{{ $horario->aula->descripcion }}</td>
						<td class="border px-4 py-2">{{ $horario->diaSemana }}</td>
						<td class="border px-4 py-2">{{ $horario->horaInicio }}</td>
						<td class="border px-4 py-2">{{ $horario->horaFin }}</td>
					</tr>
				@empty
					<tr>
						<td colspan="5" class="text-center py-4 text-gray-500">No hay horarios asignados.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
@endsection
