@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
	<h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Gestión de Pagos</h2>

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

	<div class="relative overflow-x-auto shadow-md rounded-lg bg-white p-4">
		<table class="w-full text-sm text-left text-gray-700">
			<thead class="text-xs uppercase bg-purple-600 text-black">
				<tr>
					<th class="px-4 py-3 text-center">Alumno</th>
					<th class="px-4 py-3 text-center">DNI</th>
					<th class="px-4 py-3 text-center">Email</th>
					<th class="px-4 py-3 text-center">Cursos</th>
					<th class="px-4 py-3 text-center">Cuota</th>
					<th class="px-4 py-3 text-center">Descuento</th>
					<th class="px-4 py-3 text-center">Total</th>
					<th class="px-4 py-3 text-center">Estado</th>
					<th class="px-4 py-3 text-center">Acciones</th>
				</tr>
			</thead>
			<tbody>
				@forelse($pagos as $pago)
					<tr class="border-b hover:bg-purple-50">
						<td class="px-4 py-2 text-center font-semibold">{{ $pago->getNombreEstudiante() }}</td>
						<td class="px-4 py-2 text-center">{{ $pago->matricula?->estudiante?->getDni() }}</td>
						<td class="px-4 py-2 text-center">{{ $pago->matricula?->estudiante?->getEmail() }}</td>
						<td class="px-4 py-2 text-center">{{ $pago->matricula?->cursos->count() }}</td>
						<td class="px-4 py-2 text-center">S/ {{ number_format($pago->cuota,2) }}</td>
						<td class="px-4 py-2 text-center">S/ {{ number_format($pago->descuento,2) }}</td>
						<td class="px-4 py-2 text-center font-bold">S/ {{ number_format($pago->getMontoTotal(),2) }}</td>
						<td class="px-4 py-2 text-center">
							@php
								$color = match($pago->estado){
									'pendiente' => 'bg-yellow-200 text-yellow-800',
									'validado' => 'bg-green-200 text-green-800',
									'rechazado' => 'bg-red-200 text-red-800',
									default => 'bg-gray-200 text-gray-800'
								};
							@endphp
							<span class="px-2 py-1 rounded text-xs font-semibold {{ $color }}">{{ ucfirst($pago->estado) }}</span>
						</td>
						<td class="px-4 py-2 text-center">
							<form method="POST" action="{{ route('admin.pagos.estado', $pago->idPago) }}" class="flex flex-col gap-1 items-center">
								@csrf
								@method('PUT')
								<select name="estado" class="border rounded px-2 py-1 text-xs">
									<option value="pendiente" @selected($pago->estado=='pendiente')>Pendiente</option>
									<option value="validado" @selected($pago->estado=='validado')>Validado</option>
									<option value="rechazado" @selected($pago->estado=='rechazado')>Rechazado</option>
								</select>
								<button type="submit" class="bg-purple-600 hover:bg-purple-700 text-black text-xs font-semibold px-3 py-1 rounded">Actualizar</button>
							</form>
						</td>
					</tr>
				@empty
					<tr>
						<td colspan="9" class="px-4 py-6 text-center text-gray-500">No hay pagos registrados.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>
@endsection
