@extends('layout.plantilla')
@section('contenido')
<div class="w-full max-w-lg mx-auto mt-8">
	<h2 class="text-2xl font-bold mb-6 text-center text-purple-700">Registrar Hijo como Estudiante</h2>
	<form method="POST" action="{{ route('padre.registrarHijo') }}" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
		@csrf
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Nombre completo</label>
			<input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">DNI</label>
			<input type="text" name="dni" maxlength="8" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Fecha de nacimiento</label>
			<input type="date" name="fechaNacimiento" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Correo electrónico</label>
			<input type="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Contraseña</label>
			<input type="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Confirmar contraseña</label>
			<input type="password" name="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Partida de nacimiento (PDF/JPG/PNG, máx 5MB)</label>
			<input type="file" name="partida_nacimiento" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm text-gray-700" required>
		</div>
		<div class="mb-4">
			<label class="block text-gray-700 text-sm font-bold mb-2">Constancia de estudios (PDF/JPG/PNG, máx 5MB)</label>
			<input type="file" name="constancia_estudios" accept=".pdf,.jpg,.jpeg,.png" class="block w-full text-sm text-gray-700" required>
		</div>
		<div class="flex items-center justify-between mb-2">
			<button type="submit" class="bg-purple-600 hover:bg-purple-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Registrar hijo</button>
		</div>
	</form>
</div>
@endsection
