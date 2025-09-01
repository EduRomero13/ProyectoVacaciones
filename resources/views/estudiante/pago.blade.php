@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 py-6 mx-auto">
    <h2 class="text-3xl font-bold mb-8 text-center text-purple-700">Pago de Matrícula</h2>
    @if(session('success'))
        <div class="bg-gradient-to-tl from-green-400 to-green-600 text-white px-4 py-2 rounded mb-4 text-center shadow-soft-xl">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="bg-gradient-to-tl from-red-400 to-pink-500 text-white px-4 py-2 rounded mb-4 text-center shadow-soft-xl">
            <ul class="list-none">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="flex flex-wrap -mx-3 justify-center">
        <div class="w-full max-w-full px-3 lg:w-2/3 lg:flex-none">
            <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="relative overflow-hidden rounded-2xl">
                    <div class="relative z-10 flex-auto p-6">
                        <form method="POST" action="{{ route('realizarPago') }}">
                            @csrf
                            <div class="mb-6">
                                <label class="block font-semibold mb-2 text-purple-700 text-lg">Cursos matriculados:</label>
                                <div class="flex flex-wrap gap-4">
                                    @foreach($matricula->cursos as $curso)
                                        <div class="bg-gradient-to-tl from-purple-700 to-pink-500 text-white px-4 py-2 rounded-xl shadow-soft-xl flex items-center">
                                            <i class="ni ni-book-bookmark mr-2"></i>
                                            <span class="font-bold">{{ $curso->getNombre() }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-6">
                                <label class="block font-semibold mb-2 text-purple-700 text-lg">Total a pagar:</label>
                                <div class="flex items-center gap-2">
                                    <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 flex items-center justify-center">
                                        <i class="ni ni-money-coins text-lg text-white"></i>
                                    </div>
                                    <input type="text" class="w-32 px-3 py-2 border-2 border-purple-700 rounded-lg bg-gray-100 text-center font-bold text-xl" value="$ {{ $matricula->cursos->count() * 7 }}" readonly>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <!-- isset($pagoExistente): Comprueba si la variable $pagoExistente está definida y no es null. -->
                                @if(isset($pagoExistente) && !$pagoExistente) 
                                    <button type="submit" class="bg-gradient-to-tl from-purple-700 to-pink-500 text-white px-8 py-3 rounded-xl font-bold text-lg shadow-soft-xl hover:scale-105 transition-transform duration-200">Pagar</button>
                                @else
                                    <button type="button" class="bg-gray-400 text-black px-8 py-3 rounded-xl font-bold text-lg shadow-soft-xl cursor-not-allowed" disabled>Pagar</button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
