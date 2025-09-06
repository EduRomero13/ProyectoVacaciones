@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
	<h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Pagos de Matrículas de mis Hijos</h2>
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
			@forelse($hijo->estudiante->matriculas as $matricula)
				<div class="mb-4 border-b pb-4">
					<div class="font-bold mb-2">Matrícula #{{ $matricula->idMatricula }} - Estado: {{ ucfirst($matricula->estado) }}</div>
					<table class="min-w-full table-auto border rounded-lg overflow-hidden mb-2">
						<thead>
							<tr class="bg-gray-100">
								<th class="px-4 py-2">Curso</th>
								<th class="px-4 py-2">Cuota</th>
								<th class="px-4 py-2">Descuento</th>
								<th class="px-4 py-2">Total</th>
								<th class="px-4 py-2">Estado</th>
								<th class="px-4 py-2">Acción</th>
							</tr>
						</thead>
						<tbody>
							@if($matricula->pagos->isEmpty())
								@php
									$cuota = $matricula->cursos->count() * 7;
								@endphp
								<tr>
									<td class="border px-4 py-2">@foreach($matricula->cursos as $curso){{ $curso->getNombre() }}@if(!$loop->last), @endif @endforeach</td>
									<td class="border px-4 py-2">S/ {{ number_format($cuota, 2) }}</td>
									<td class="border px-4 py-2">S/ 0.00</td>
									<td class="border px-4 py-2 font-bold">S/ {{ number_format($cuota, 2) }}</td>
									<td class="border px-4 py-2">Sin pago</td>
									<td class="border px-4 py-2">
										<form method="POST" action="{{ route('padre.pagar', $matricula->idMatricula) }}" enctype="multipart/form-data">
											@csrf
											<input type="file" name="comprobante" accept=".pdf,.jpg,.jpeg,.png" class="mb-2">
											<button type="submit" class="bg-green-600 text-black px-3 py-1 rounded">Pagar</button>
										</form>
									</td>
								</tr>
							@else
								@foreach($matricula->pagos as $pago)
									<tr>
										<td class="border px-4 py-2">@foreach($matricula->cursos as $curso){{ $curso->getNombre() }}@if(!$loop->last), @endif @endforeach</td>
										<td class="border px-4 py-2">S/ {{ number_format($pago->cuota, 2) }}</td>
										<td class="border px-4 py-2">S/ {{ number_format($pago->descuento, 2) }}</td>
										<td class="border px-4 py-2 font-bold">S/ {{ number_format($pago->getMontoTotal(), 2) }}</td>
										<td class="border px-4 py-2">{{ ucfirst($pago->estado) }}</td>
										<td class="border px-4 py-2">
											@if($pago->estado === 'pendiente')
												<form method="POST" action="{{ route('padre.pagar', $pago->idPago) }}" enctype="multipart/form-data">
													@csrf
													<input type="file" name="comprobante" accept=".pdf,.jpg,.jpeg,.png" class="mb-2">
													<button type="submit" class="bg-green-600 text-black px-3 py-1 rounded">Pagar</button>
												</form>
											@else
												<span class="text-green-700 font-semibold">Pagado</span>
											@endif
										</td>
									</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				</div>
			@empty
				<div class="text-gray-500">No hay matrículas para este hijo.</div>
			@endforelse
		</div>
	@empty
		<div class="text-center text-gray-500">No tienes hijos registrados.</div>
	@endforelse
</div>
@endsection
