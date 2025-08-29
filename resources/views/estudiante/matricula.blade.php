@extends('layout.plantilla')
@section('contenido')
<div class="flex flex-wrap -mx-3 justify-center mt-8">
    <div class="w-full max-w-full px-3 mb-6 sm:w-2/3 sm:flex-none xl:mb-0 xl:w-1/2">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-6">
                <h2 class="font-bold text-xl mb-4 text-center text-slate-700">Registrar Matrícula</h2>
                <form id="matriculaForm" method="POST" action="">
                    @csrf
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full max-w-full px-3">
                            <label for="fechaMatricula" class="block font-semibold mb-2 text-slate-700">Fecha de Matrícula</label>
                            <input type="date" name="fechaMatricula" id="fechaMatricula" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500" required>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4">
                        <div class="w-full max-w-full px-3">
                            <label class="block font-semibold mb-2 text-slate-700">Cursos</label>
                            <div id="cursosContainer">
                                <div class="flex items-center mb-2 curso-row">
                                    <input type="text" name="cursos[]" class="px-3 py-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-purple-700" placeholder="Nombre del curso" required>
                                    <button type="button" class="ml-2 px-3 py-2 bg-gradient-to-tl from-purple-700 to-pink-500 text-white rounded-lg remove-curso" onclick="removeCurso(this)">Eliminar</button>
                                </div>
                            </div>
                            <button type="button" id="addCursoBtn" class="mt-2 px-4 py-2 bg-gradient-to-tl from-purple-700 to-pink-500 text-white rounded-lg shadow-soft-xl">Agregar curso</button>
                            <p id="maxCursosMsg" class="text-red-500 mt-2 hidden">Solo puedes registrar hasta 7 cursos.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-4 justify-center">
                        <button type="submit" class="px-6 py-2 bg-gradient-to-tl from-green-600 to-lime-400 text-white rounded-lg shadow-soft-xl font-semibold">Registrar Matrícula</button>
                    </div>
                </form>
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
            newRow.innerHTML = `<input type="text" name="cursos[]" class="px-3 py-2 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-purple-700" placeholder="Nombre del curso" required>
                <button type="button" class="ml-2 px-3 py-2 bg-gradient-to-tl from-purple-700 to-pink-500 text-white rounded-lg remove-curso" onclick="removeCurso(this)">Eliminar</button>`;
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