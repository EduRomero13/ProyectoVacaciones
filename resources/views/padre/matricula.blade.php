@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
	<h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Matricular a mis hijos</h2>
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

	@forelse($hijos as $hijo)
		<div class="bg-white shadow-soft-xl rounded-2xl p-6 mb-8">
			<h3 class="text-xl font-semibold mb-4">{{ $hijo->estudiante->getNombre() }} (DNI: {{ $hijo->estudiante->getDni() }})</h3>
			<form method="POST" action="{{ route('padre.matricularHijo', $hijo->estudiante->id) }}">
				@csrf
				<div class="mb-4">
					<label class="block font-semibold mb-1">Fecha de matrícula</label>
					<input type="date" name="fechaMatricula" class="border rounded px-2 py-1 w-full" required value="{{ date('Y-m-d') }}">
				</div>
				<div class="mb-4">
					<label class="block font-semibold mb-1">Selecciona los cursos</label>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						@foreach($cursos as $especialidad => $lista)
							<div>
								<div class="font-bold text-purple-700 mb-1">{{ ucfirst($especialidad) }}</div>
								@foreach($lista as $curso)
									<label class="block mb-1">
										<input type="checkbox" name="cursos[]" value="{{ $curso->idCurso }}">
										{{ $curso->getNombre() }}
									</label>
								@endforeach
							</div>
						@endforeach
					</div>
				</div>
				<button type="submit" class="bg-purple-600 text-black px-6 py-2 rounded">Matricular hijo</button>
			</form>
		</div>
	@empty
		<div class="text-center text-gray-500">No tienes hijos registrados.</div>
	@endforelse
</div>
@endsection
