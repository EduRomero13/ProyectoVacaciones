
@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 mx-auto flex flex-col gap-6">
	<div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
		<h2 class="text-2xl font-bold mb-6">Administración de Usuarios</h2>
		<div class="flex flex-wrap -mx-3">
			<div class="w-full max-w-full px-3">
				<div class="relative flex flex-col h-full w-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
					<div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
						<h3 class="mb-0">Registrar nuevo usuario</h3>
					</div>
					<div class="flex-auto p-4">
						<form id="adminRegistrationForm" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
							@csrf
							<div class="mb-4">
								<label class="block font-semibold mb-2">Tipo de usuario</label>
								<div class="flex gap-4">
									<label><input type="radio" name="user_type" value="estudiante" checked> Estudiante</label>
									<label><input type="radio" name="user_type" value="padre"> Padre</label>
									<label><input type="radio" name="user_type" value="docente"> Docente</label>
								</div>
							</div>
							<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
								<div>
									<label class="block text-sm font-semibold mb-1">Nombre</label>
									<input type="text" name="name" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">DNI</label>
									<input type="text" name="dni" maxlength="8" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Fecha de nacimiento</label>
									<input type="date" name="fechaNacimiento" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Email</label>
									<input type="email" name="email" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Contraseña</label>
									<input type="password" name="password" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
								<div>
									<label class="block text-sm font-semibold mb-1">Confirmar contraseña</label>
									<input type="password" name="password_confirmation" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
								</div>
							</div>
							<!-- Campos específicos para estudiante -->
							<div id="estudiante-fields" class="role-specific-fields mb-4">
								<h6 class="font-semibold mb-2">Documentos de Estudiante</h6>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Partida de nacimiento</label>
									<input type="file" name="partida_nacimiento" accept=".pdf,.jpg,.jpeg,.png" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Constancia de estudios</label>
									<input type="file" name="constancia_estudios" accept=".pdf,.jpg,.jpeg,.png" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
							</div>
							<!-- Campos específicos para padre -->
							<div id="padre-fields" class="role-specific-fields mb-4" style="display:none;">
								<h6 class="font-semibold mb-2">Información del Hijo</h6>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Nombre del hijo</label>
									<input type="text" name="nombre_hijo" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">DNI del hijo</label>
									<input type="text" name="dni_hijo" maxlength="8" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Partida de nacimiento del hijo</label>
									<input type="file" name="partida_nacimiento_hijo" accept=".pdf,.jpg,.jpeg,.png" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Últimos 4 dígitos de tarjeta</label>
									<input type="text" name="ultimos_digitos_tarjeta" maxlength="4" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
							</div>
							<!-- Campos específicos para docente -->
							<div id="docente-fields" class="role-specific-fields mb-4" style="display:none;">
								<h6 class="font-semibold mb-2">Documentos Profesionales</h6>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Especialidad</label>
									<input type="text" name="especialidad" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Título profesional</label>
									<input type="file" name="titulo_profesional" accept=".pdf,.jpg,.jpeg,.png" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
								<div class="mb-2">
									<label class="block text-sm font-semibold mb-1">Curriculum Vitae (PDF)</label>
									<input type="file" name="curriculum_vitae" accept=".pdf" class="block w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
								</div>
							</div>
							<div class="mb-4">
								<label class="block text-sm font-semibold mb-1"><input type="checkbox" name="terms" required> Acepto los términos y condiciones</label>
							</div>
							<button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded-lg">Registrar usuario</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="w-full p-6 mx-auto">
		<div class="flex flex-wrap -mx-3">
			<div class="relative flex flex-col h-full w-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
				<div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
					<h3 class="mb-0">Usuarios registrados</h3>
				</div>
				<div class="flex-auto p-4">
					<table class="min-w-full table-auto border rounded-lg overflow-hidden">
						<thead>
							<tr class="bg-gray-100">
								<th class="px-4 py-2">ID</th>
								<th class="px-4 py-2">Nombre</th>
								<th class="px-4 py-2">Email</th>
								<th class="px-4 py-2">Tipo</th>
								<th class="px-4 py-2">Documentos</th>
								<th class="px-4 py-2">Estado</th>
								<th class="px-4 py-2">Acciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach($users as $user)
							<tr>
								<td class="border px-4 py-2">{{ $user->id }}</td>
								<td class="border px-4 py-2">{{ $user->name }}</td>
								<td class="border px-4 py-2">{{ $user->email }}</td>
								<td class="border px-4 py-2">{{ $user->role->nombreRol ?? '-' }}</td>
								<td class="text-center">
									@if($user->esDocente() && $user->docente && $user->docente->tituloProfesional)
										<button class="btn btn-info btn-sm" onclick="showDocumentModal('{{ asset('storage/' . $user->docente->tituloProfesional) }}')">Ver título</button>
									@elseif($user->esEstudiante() && $user->estudiante && $user->estudiante->constanciaEstudios)
										<button class="btn btn-info btn-sm" onclick="showDocumentModal('{{ asset('storage/' . $user->estudiante->constanciaEstudios) }}')">Ver constancia</button>
									@elseif($user->esPadreFamilia() && $user->padre && $user->padre->partidaNacimientoHijo)
										<button class="btn btn-info btn-sm" onclick="showDocumentModal('{{ asset('storage/' . $user->padre->partidaNacimientoHijo) }}')">Ver partida</button>
									@else
										<span class="text-muted">No disponible</span>
									@endif
								</td>
								<td class="border px-4 py-2">
									@if($user->estadoCuenta === 'pendiente')
										<span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800">Pendiente</span>
									@elseif($user->estadoCuenta === 'verificado')
										<span class="px-2 py-1 rounded bg-green-100 text-green-800">Verificado</span>
									@elseif($user->estadoCuenta === 'bloqueado')
										<span class="px-2 py-1 rounded bg-red-100 text-red-800">Bloqueado</span>
									@else
										<span class="px-2 py-1 rounded bg-gray-100 text-gray-800">{{ $user->estadoCuenta }}</span>
									@endif
								</td>
								<td class="border px-4 py-2">
									@if($user->estadoCuenta === 'pendiente')
										<form method="POST" action="{{ route('admin.users.verify', $user->id) }}" style="display:inline-block;">
											@csrf
											<button type="submit" class="bg-green-500 text-black px-2 py-1 rounded-lg">Verificar</button>
										</form>
										<form method="POST" action="{{ route('admin.users.block', $user->id) }}" style="display:inline-block;">
											@csrf
											<button type="submit" class="bg-red-500 text-black px-2 py-1 rounded-lg">Bloquear</button>
										</form>
									@elseif($user->estadoCuenta === 'verificado')
										<form method="POST" action="{{ route('admin.users.block', $user->id) }}" style="display:inline-block;">
											@csrf
											<button type="submit" class="bg-red-500 text-black px-2 py-1 rounded-lg">Bloquear</button>
										</form>
									@elseif($user->estadoCuenta === 'bloqueado')
										<form method="POST" action="{{ route('admin.users.verify', $user->id) }}" style="display:inline-block;">
											@csrf
											<button type="submit" class="bg-green-500 text-black px-2 py-1 rounded-lg">Verificar</button>
										</form>
									@endif
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="documentModal" class="modal" tabindex="-1" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100vw; height:100vh; background:rgba(0,0,0,0.6);">
    <div style="position:relative; margin:5% auto; background:#fff; padding:20px; border-radius:8px; max-width:600px;">
        <span style="position:absolute; top:10px; right:20px; font-size:24px; cursor:pointer;" onclick="closeDocumentModal()">&times;</span>
        <div id="documentContent"></div>
    </div>
</div>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const radios = document.querySelectorAll('input[name="user_type"]');
		const estudianteFields = document.getElementById('estudiante-fields');
		const padreFields = document.getElementById('padre-fields');
		const docenteFields = document.getElementById('docente-fields');
		function toggleFields() {
			estudianteFields.style.display = 'none';
			padreFields.style.display = 'none';
			docenteFields.style.display = 'none';
			if (document.querySelector('input[name="user_type"]:checked').value === 'estudiante') {
				estudianteFields.style.display = 'block';
			} else if (document.querySelector('input[name="user_type"]:checked').value === 'padre') {
				padreFields.style.display = 'block';
			} else {
				docenteFields.style.display = 'block';
			}
		}
		radios.forEach(radio => {
			radio.addEventListener('change', toggleFields);
		});
		toggleFields();
	});
	function showDocumentModal(url) {
        var ext = url.split('.').pop().toLowerCase();
        var content = '';
        if(['pdf'].includes(ext)) {
            content = '<iframe src="' + url + '" width="100%" height="500px"></iframe>';
        } else if(['jpg','jpeg','png'].includes(ext)) {
            content = '<img src="' + url + '" style="max-width:100%; max-height:500px;" />';
        } else {
            content = '<p>No se puede mostrar este tipo de archivo.</p>';
        }
        document.getElementById('documentContent').innerHTML = content;
        document.getElementById('documentModal').style.display = 'block';
    }
    function closeDocumentModal() {
        document.getElementById('documentModal').style.display = 'none';
        document.getElementById('documentContent').innerHTML = '';
    }
</script>
@endsection
