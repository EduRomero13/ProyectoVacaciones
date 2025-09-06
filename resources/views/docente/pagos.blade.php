@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
	<h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Pagos por Cursos Dictados</h2>
	<div class="bg-white shadow-soft-xl rounded-2xl p-6 mb-8">
		<h3 class="text-xl font-semibold mb-4">Cursos asignados</h3>
		<table class="min-w-full table-auto border rounded-lg overflow-hidden mb-4">
			<thead>
				<tr class="bg-gray-100">
					<th class="px-4 py-2">Curso</th>
					<th class="px-4 py-2">Monto a pagar</th>
				</tr>
			</thead>
			<tbody>
				@php $total = 0; @endphp
				@foreach($cursos as $curso)
					<tr>
						<td class="border px-4 py-2">{{ $curso->getNombre() }}</td>
						<td class="border px-4 py-2">S/ 500.00</td>
					</tr>
					@php $total += 500; @endphp
				@endforeach
			</tbody>
		</table>
		<div class="text-right font-bold text-lg mt-4">
			Total a pagar: <span class="text-green-700">S/ {{ number_format($total, 2) }}</span>
		</div>
	</div>
</div>
@endsection
