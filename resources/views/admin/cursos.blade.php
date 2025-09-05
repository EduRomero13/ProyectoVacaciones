@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 mx-auto flex flex-col gap-6">
	<div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
		<h2 class="text-2xl font-bold mb-6">Administración de Cursos</h2>
		<div class="flex flex-wrap -mx-3">
			<div class="w-full max-w-full px-3">
				<div class="relative flex flex-col h-full w-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
					<div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
						<h3 class="mb-0">Crear/Editar Curso</h3>
					</div>
					<div class="flex-auto p-4">
						<form id="cursoForm" method="POST" action="{{ route('admin.cursos.store') }}">
							@csrf
							<input type="hidden" name="idCurso" id="idCurso" value="">
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
								<div>
									<label class="block text-sm font-semibold mb-1">Nombre</label>
									<input type="text" name="nombre" id="nombre" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Especialidad</label>
									<input type="text" name="especialidad" id="especialidad" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Duración</label>
									<input type="text" name="duracion" id="duracion" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Cupo máximo</label>
									<input type="number" name="cupoMaximo" id="cupoMaximo" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div class="md:col-span-2">
									<label class="block text-sm font-semibold mb-1">Descripción</label>
									<textarea name="descripcion" id="descripcion" rows="2" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
								</div>
								<div class="md:col-span-2">
									<label class="block text-sm font-semibold mb-1">Asignar Docente</label>
									<select name="idDocente" id="idDocente" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
										<option value="">Sin docente</option>
										@foreach($docentes as $docente)
											<option value="{{ $docente->id }}">{{ $docente->getNombre() }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-lg">Guardar curso</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="w-full p-6 mx-auto">
		<form method="GET" action="" class="mb-4 flex flex-wrap items-center gap-3">
			<label for="especialidad" class="font-semibold">Especialidad:</label>
			<select name="especialidad" id="especialidad" class="border rounded px-2 py-1" onchange="this.form.submit()">
				<option value="">Todas</option>
				@foreach($especialidades as $esp)
					<option value="{{ $esp }}" @if(isset($filtro) && $filtro == $esp) selected @endif>{{ ucfirst($esp) }}</option>
				@endforeach
			</select>

			<label for="nombre_curso" class="font-semibold">Curso:</label>
			<input type="text" name="nombre_curso" id="nombre_curso" value="{{ $nombreCurso ?? '' }}" placeholder="Nombre del curso" class="border rounded px-2 py-1" onchange="this.form.submit()">

			<label for="nombre_docente" class="font-semibold">Docente:</label>
			<input type="text" name="nombre_docente" id="nombre_docente" value="{{ $nombreDocente ?? '' }}" placeholder="Nombre del docente" class="border rounded px-2 py-1" onchange="this.form.submit()">

			<button type="submit" class="bg-blue-600 text-black px-3 py-1 rounded">Buscar</button>
		</form>
		<div class="flex flex-wrap -mx-3">
			<div class="relative flex flex-col h-full w-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
				<div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
					<h3 class="mb-0">Cursos existentes</h3>
				</div>
				<div class="flex-auto p-4">
					<table class="min-w-full table-auto border rounded-lg overflow-hidden">
						<thead>
							<tr class="bg-gray-100">
								<th class="px-4 py-2">ID</th>
								<th class="px-4 py-2">Nombre</th>
								<th class="px-4 py-2">Especialidad</th>
								<th class="px-4 py-2">Duración</th>
								<th class="px-4 py-2">Cupo</th>
								<th class="px-4 py-2">Docente</th>
								<th class="px-4 py-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($cursos as $curso)
							<tr>
								<td class="border px-4 py-2">{{ $curso->idCurso }}</td>
								<td class="border px-4 py-2">{{ $curso->nombre }}</td>
								<td class="border px-4 py-2">{{ $curso->especialidad }}</td>
								<td class="border px-4 py-2">{{ $curso->duracion }}</td>
								<td class="border px-4 py-2">{{ $curso->cupoMaximo }}</td>
								<td class="border px-4 py-2">{{ $curso->docente ? $curso->docente->getNombre() : 'Sin docente' }}</td>
								<td class="border px-4 py-2">
									<form method="POST" action="{{ route('admin.cursos.delete', $curso->idCurso) }}" style="display:inline-block;">
										@csrf
										<button type="submit" class="bg-red-500 text-black px-2 py-1 rounded-lg" onclick="return confirm('¿Seguro que deseas eliminar este curso?')">Eliminar</button>
									</form>
									<button type="button" class="bg-yellow-500 text-black px-2 py-1 rounded-lg" onclick="editarCurso({{ $curso->idCurso }}, '{{ addslashes($curso->nombre) }}', '{{ addslashes($curso->especialidad) }}', '{{ addslashes($curso->duracion) }}', '{{ addslashes($curso->cupoMaximo) }}', '{{ addslashes($curso->descripcion) }}', '{{ $curso->idDocente }}')">Editar</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="mt-4">
						{{ $cursos->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function editarCurso(id, nombre, especialidad, duracion, cupoMaximo, descripcion, idDocente) {
	document.getElementById('idCurso').value = id;
	document.getElementById('nombre').value = nombre;
	document.getElementById('especialidad').value = especialidad;
	document.getElementById('duracion').value = duracion;
	document.getElementById('cupoMaximo').value = cupoMaximo;
	document.getElementById('descripcion').value = descripcion;
	document.getElementById('idDocente').value = idDocente;
	window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
@endsection
