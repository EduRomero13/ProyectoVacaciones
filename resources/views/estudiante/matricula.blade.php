
@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
    <div class="flex flex-wrap -mx-3 justify-center">
        <div class="w-full max-w-full px-3 lg:w-2/3 lg:flex-none">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-4 xl:mb-0 xl:w-1/2 xl:flex-none">
                    <div class="relative flex flex-col min-w-0 break-words bg-gradient-to-tl from-purple-700 to-pink-500 shadow-xl rounded-2xl bg-clip-border">
                        <div class="relative overflow-hidden rounded-2xl">
                            <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-80"></span>
                            <div class="relative z-10 flex-auto p-6">
                                <h2 class="pb-2 mt-6 mb-6 text-white text-2xl font-bold text-center">Registrar Matrícula</h2>
                                @php
                                    $cursosDisponibles = [
                                        'Matemáticas',
                                        'Comunicación',
                                        'Ciencias',
                                        'Historia',
                                        'Educación Física',
                                        'Arte',
                                        'Inglés',
                                        'Computación',
                                        'Filosofía'
                                    ];
                                @endphp
                                <form id="matriculaForm" method="POST" action="{{ route('matricular') }}">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="fechaMatricula" class="block font-semibold mb-2 text-white">Fecha de Matrícula</label>
                                        <input type="date" name="fechaMatricula" id="fechaMatricula" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                                    </div>
                                    <div class="mb-4">
                                            <label class="block font-semibold mb-2 text-white">Cursos por especialidad</label>
                                            <div style="display: flex; gap: 2rem; margin-bottom: 2rem; flex-wrap: wrap;">
                                                <div>
                                                    <label for="formales">Ciencias Formales</label>
                                                    <div style="display: flex; gap: 0.5rem;">
                                                        <select id="formales" class="form-select">
                                                            <option value="">Seleccione un curso</option>
                                                            @foreach ($formales as $curso)
                                                                <option value="{{ $curso->idCurso }}">{{ $curso->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="agregar-curso bg-purple-700 text-white px-2 py-1 rounded" data-select="formales">Agregar</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="naturales">Ciencias Naturales</label>
                                                    <div style="display: flex; gap: 0.5rem;">
                                                        <select id="naturales" class="form-select">
                                                            <option value="">Seleccione un curso</option>
                                                            @foreach ($naturales as $curso)
                                                                <option value="{{ $curso->idCurso }}">{{ $curso->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="agregar-curso bg-green-700 text-white px-2 py-1 rounded" data-select="naturales">Agregar</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="sociales">Ciencias Sociales</label>
                                                    <div style="display: flex; gap: 0.5rem;">
                                                        <select id="sociales" class="form-select">
                                                            <option value="">Seleccione un curso</option>
                                                            @foreach ($sociales as $curso)
                                                                <option value="{{ $curso->idCurso }}">{{ $curso->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="agregar-curso bg-blue-700 text-white px-2 py-1 rounded" data-select="sociales">Agregar</button>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="aplicadas">Ciencias Aplicadas</label>
                                                    <div style="display: flex; gap: 0.5rem;">
                                                        <select id="aplicadas" class="form-select">
                                                            <option value="">Seleccione un curso</option>
                                                            @foreach ($aplicadas as $curso)
                                                                <option value="{{ $curso->idCurso }}">{{ $curso->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                        <button type="button" class="agregar-curso bg-pink-700 text-white px-2 py-1 rounded" data-select="aplicadas">Agregar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Lista de cursos seleccionados -->
                                            <div class="mb-4">
                                                <label class="block font-semibold mb-2 text-white">Cursos seleccionados</label>
                                                <ul id="cursosSeleccionados" class="mb-2"></ul>
                                            </div>
                                            <!-- Los cursos seleccionados se agregan como inputs ocultos -->
                                            <div id="inputsCursos"></div>
                                            <p id="maxCursosMsg" class="text-red-500 mt-2 hidden">Solo puedes registrar hasta 7 cursos.</p>
                                    </div>
                                    <div class="flex flex-wrap -mx-3 mb-4 justify-center">
                                        <button type="submit" class="px-6 py-2 bg-gradient-to-tl from-green-600 to-lime-400 text-white rounded-lg shadow-soft-xl font-semibold">Registrar Matrícula</button>
                                    </div>
                                </form>
    <script>
        const selects = ['formales', 'naturales', 'sociales', 'aplicadas'];
        const cursosSeleccionados = [];
        const cursosSeleccionadosList = document.getElementById('cursosSeleccionados');
        const inputsCursos = document.getElementById('inputsCursos');
        const maxCursosMsg = document.getElementById('maxCursosMsg');
        const MAX_CURSOS = 7;

        document.querySelectorAll('.agregar-curso').forEach(btn => {
            btn.addEventListener('click', function() {
                if (cursosSeleccionados.length >= MAX_CURSOS) {
                    maxCursosMsg.classList.remove('hidden');
                    return;
                } else {
                    maxCursosMsg.classList.add('hidden');
                }
                const selectId = this.getAttribute('data-select');
                const select = document.getElementById(selectId);
                const cursoId = select.value;
                const cursoNombre = select.options[select.selectedIndex].text;
                if (!cursoId || cursosSeleccionados.some(c => c.id === cursoId)) return;
                cursosSeleccionados.push({id: cursoId, nombre: cursoNombre});
                renderCursosSeleccionados();
            });
        });

        function renderCursosSeleccionados() {
            cursosSeleccionadosList.innerHTML = '';
            inputsCursos.innerHTML = '';
            cursosSeleccionados.forEach((curso, idx) => {
                const li = document.createElement('li');
                li.className = 'flex items-center mb-2';
                li.innerHTML = `<span class=\"mr-2\">${curso.nombre}</span>
                    <button type=\"button\" class=\"eliminar-curso bg-red-500 text-white px-2 py-1 rounded\" data-idx=\"${idx}\">Eliminar</button>`;
                cursosSeleccionadosList.appendChild(li);
                // input oculto para enviar el id del curso
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'cursos[]';
                input.value = curso.id;
                inputsCursos.appendChild(input);
            });
            // listeners para eliminar
            document.querySelectorAll('.eliminar-curso').forEach(btn => {
                btn.onclick = function() {
                    const idx = this.getAttribute('data-idx');
                    cursosSeleccionados.splice(idx, 1);
                    renderCursosSeleccionados();
                    maxCursosMsg.classList.add('hidden');
                };
            });
        }
    </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 xl:w-1/2 xl:flex-none">
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                                <div class="p-4 mx-6 mb-0 text-center bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                    <div class="w-16 h-16 text-center bg-center icon bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl rounded-xl mx-auto flex items-center justify-center">
                                        <i class="relative text-white opacity-100 fas fa-book text-2xl"></i>
                                    </div>
                                </div>
                                <div class="flex-auto p-4 pt-0 text-center">
                                    <h6 class="mb-0 text-center">Tus cursos</h6>
                                    <span class="leading-tight text-xs">Puedes registrar hasta 7 cursos</span>
                                    <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                                    <h5 class="mb-0 text-purple-700 font-bold">¡Aprovecha tus estudios!</h5>
                                </div>
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 mt-6 md:mt-0 md:w-1/2 md:flex-none">
                            <div class="relative flex flex-col min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                                <div class="p-4 mx-6 mb-0 text-center bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                                    <div class="w-16 h-16 text-center bg-center icon bg-gradient-to-tl from-green-600 to-lime-400 shadow-soft-2xl rounded-xl mx-auto flex items-center justify-center">
                                        <i class="relative text-white opacity-100 fas fa-calendar-alt text-2xl"></i>
                                    </div>
                                </div>
                                <div class="flex-auto p-4 pt-0 text-center">
                                    <h6 class="mb-0 text-center">Fechas importantes</h6>
                                    <span class="leading-tight text-xs">No olvides tu fecha de matrícula</span>
                                    <hr class="h-px my-4 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />
                                    <h5 class="mb-0 text-green-600 font-bold">¡Organízate bien!</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-full px-3 mb-4 lg:mb-0 lg:w-full lg:flex-none">
                    <div class="relative flex flex-col min-w-0 mt-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                        <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <div class="flex flex-wrap -mx-3">
                                <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                                    <h6 class="mb-0">Información</h6>
                                </div>
                                <div class="flex-none w-1/2 max-w-full px-3 text-right">
                                    <a class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-gradient-to-tl from-gray-900 to-slate-800 rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25" href="javascript:;">Ayuda</a>
                                </div>
                            </div>
                        </div>
                        <div class="flex-auto p-4">
                            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                                <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">¿Cómo registrar?</h6>
                                        <span class="leading-tight text-xs">Ingresa la fecha y los cursos</span>
                                    </div>
                                </li>
                                <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">¿Cuántos cursos?</h6>
                                        <span class="leading-tight text-xs">Máximo 7 cursos por matrícula</span>
                                    </div>
                                </li>
                                <li class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-xl text-inherit">
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 font-semibold leading-normal text-sm text-slate-700">¿Dudas?</h6>
                                        <span class="leading-tight text-xs">Contacta a tu asesor académico</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const maxCursos = 7;
    const cursosContainer = document.getElementById('cursosContainer');
    const addCursoBtn = document.getElementById('addCursoBtn');
    const maxCursosMsg = document.getElementById('maxCursosMsg');

    addCursoBtn.addEventListener('click', function() {
        const cursoRows = cursosContainer.querySelectorAll('.curso-row');
        if (cursoRows.length < maxCursos) {
            const newRow = document.createElement('div');
            newRow.className = 'flex items-center mb-2 curso-row';
            let selectHtml = `<select name="cursos[]" class="px-3 py-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-purple-700" required>`;
            selectHtml += `<option value="" disabled selected>Selecciona un curso</option>`;
            @foreach($cursosDisponibles as $curso)
                selectHtml += `<option value="{{ $curso }}">{{ $curso }}</option>`;
            @endforeach
            selectHtml += `</select>`;
            newRow.innerHTML = selectHtml + `<button type="button" class="ml-2 px-3 py-2 bg-gradient-to-tl from-purple-700 to-pink-500 text-white rounded-lg remove-curso" onclick="removeCurso(this)">Eliminar</button>`;
            cursosContainer.appendChild(newRow);
            maxCursosMsg.classList.add('hidden');
        } else {
            maxCursosMsg.classList.remove('hidden');
        }
    });

    window.removeCurso = function(btn) {
        btn.parentElement.remove();
        const cursoRows = cursosContainer.querySelectorAll('.curso-row');
        if (cursoRows.length < maxCursos) {
            maxCursosMsg.classList.add('hidden');
        }
    }
</script>
@endsection