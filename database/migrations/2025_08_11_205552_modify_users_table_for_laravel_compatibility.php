<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Renombrar columnas existentes si es necesario
            if (Schema::hasColumn('users', 'idUsuario')) {
                $table->renameColumn('idUsuario', 'id');
            }
            if (Schema::hasColumn('users', 'nombre')) {
                $table->renameColumn('nombre', 'name');
            }
            if (Schema::hasColumn('users', 'contraseña')) {
                $table->renameColumn('contraseña', 'password');
            }
            if (Schema::hasColumn('users', 'fechaRegistro')) {
                $table->renameColumn('fechaRegistro', 'created_at');
            }

            // Agregar columnas requeridas por Laravel si no existen
            if (!Schema::hasColumn('users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('email');
            }
            if (!Schema::hasColumn('users', 'remember_token')) {
                $table->string('remember_token', 100)->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revertir los cambios
            if (Schema::hasColumn('users', 'id')) {
                $table->renameColumn('id', 'idUsuario');
            }
            if (Schema::hasColumn('users', 'name')) {
                $table->renameColumn('name', 'nombre');
            }
            if (Schema::hasColumn('users', 'password')) {
                $table->renameColumn('password', 'contraseña');
            }
            if (Schema::hasColumn('users', 'created_at')) {
                $table->renameColumn('created_at', 'fechaRegistro');
            }

            // Eliminar columnas de Laravel
            $table->dropColumn(['email_verified_at', 'remember_token', 'updated_at']);
        });
    }
};