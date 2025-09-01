<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;
use App\Models\Pago;
use App\Models\HistorialPago;

class PagoController extends Controller
{
    public function showPago()
    {
        // Obtener la matrícula activa del estudiante autenticado
        $idEstudiante = Auth::user()->id;
        $matricula = Matricula::where('idEstudiante', $idEstudiante)
            ->latest('fechaMatricula')
            ->first();

        if (!$matricula) {
            return redirect()->back()->withErrors(['No tienes matrícula pendiente de pago.']);
        }

        $pagoExistente = Pago::where('idMatricula', $matricula->idMatricula)->exists();// Pasar el valor booleano para comprobar si la matricula ya tiene pago o no

        return view('estudiante.pago', compact('matricula','pagoExistente'));
    }

    public function realizarPago(Request $request)
    {
        $idEstudiante = Auth::user()->id;
        $matricula = Matricula::where('idEstudiante', $idEstudiante)
            ->latest('fechaMatricula')
            ->first();

        if (!$matricula) {
            return redirect()->back()->withErrors(['No tienes matrícula para realizar el pago.']);
        }

        $total = $matricula->cursos->count() * 7;

        // Crear registro de pago
        $pago = Pago::create([
            'idMatricula' => $matricula->idMatricula,
            'cronogramaPago' => now()->toDateString(),
            'cuota' => $total,
            'descuento' => 0,
            'comprobante' => '', // Puedes agregar lógica para subir comprobante si lo necesitas
            'estado' => 'pendiente',
            'fechaCreacion' => now(),
        ]);

        // Crear historial de pago
        HistorialPago::create([
            'idPago' => $pago->idPago,
            'fechaRegistro' => now(),
            'estadoPago' => 'pendiente',
            'observaciones' => 'Pago registrado por el estudiante',
        ]);

        return redirect()->route('perfil')->with('success', 'Pago registrado correctamente. Total: $' . $total . '. Espera la validación del administrador.');
    }
}
