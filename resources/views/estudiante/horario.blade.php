
@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
	<h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Mi Horario de Clases</h2>
	<div class="flex overflow-x-auto justify-center">
		<table class="min-w-full table-auto border rounded-lg overflow-hidden">
			<thead>
				<tr class="bg-gray-100">
					<th class="px-2 py-1">Hora</th>
					@foreach(['Lunes','Martes','Miércoles','Jueves','Viernes'] as $dia)
						<th class="px-2 py-1">{{ $dia }}</th>
					@endforeach
				</tr>
			</thead>
			<tbody>
				@php
					$horaInicio = 7;
					$horaFin = 19;
					$dias = ['Lunes','Martes','Miércoles','Jueves','Viernes'];
					// Construir un grid con rowspan
					$horarioGrid = [];
					$rowspanMap = [];
					foreach ($horarios as $item) {
						$hIni = (int) \Carbon\Carbon::parse($item['horario']->horaInicio)->format('H');
						$hFin = (int) \Carbon\Carbon::parse($item['horario']->horaFin)->format('H');
						$dia = $item['horario']->diaSemana;
						$horarioGrid[$dia][$hIni] = [
							'item' => $item,
							'rowspan' => $hFin - $hIni
						];
						// Marcar las horas que serán cubiertas por rowspan para no renderizarlas
						for ($h = $hIni + 1; $h < $hFin; $h++) {
							$rowspanMap[$dia][$h] = true;
						}
					}
				@endphp
				@for($h = $horaInicio; $h < $horaFin; $h++)
					<tr>
						<td class="border px-2 py-1 font-semibold text-center">{{ sprintf('%02d:00', $h) }}</td>
						@foreach($dias as $dia)
							@if(isset($horarioGrid[$dia][$h]))
								@php $item = $horarioGrid[$dia][$h]['item']; $rowspan = $horarioGrid[$dia][$h]['rowspan']; @endphp
								<td class="border px-2 py-1 text-center align-middle" rowspan="{{ $rowspan }}">
									<div class="bg-purple-200 rounded p-1 text-xs">
										<div class="font-bold">{{ $item['curso']->getNombre() }}</div>
										<div>Docente: {{ $item['curso']->docente ? $item['curso']->docente->getNombre() : 'Sin docente' }}</div>
										<div>Aula: {{ $item['horario']->aula ? $item['horario']->aula->descripcion : 'Sin aula' }}</div>
									</div>
								</td>
							@elseif(empty($rowspanMap[$dia][$h]))
								<td class="border px-2 py-1"></td>
							@endif
						@endforeach
					</tr>
				@endfor
			</tbody>
		</table>
	</div>
</div>
@endsection
