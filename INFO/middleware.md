/*
 * ===== MIDDLEWARE EN LARAVEL - GUÍA COMPLETA =====
 * 
 * ¿QUÉ ES?
 * El middleware es un filtro que intercepta peticiones HTTP antes de llegar a los controladores.
 * Actúa como guardias de seguridad que validan, modifican o bloquean peticiones.
 * 
 * ===== FLUJO DE PETICIÓN HTTP =====
 * 
 * 1. Cliente/Navegador → Petición HTTP (GET /admin/users)
 * 2. Servidor Web (Apache/Nginx) → Recibe petición
 * 3. Laravel → public/index.php toma control
 * 4. Router → Encuentra ruta que coincide
 * 5. Middleware Stack → Se ejecuta en orden:
 *    ├─ Middleware Global (todos las peticiones)
 *    ├─ Middleware de Grupo ('web', 'api')
 *    └─ Middleware de Ruta (específicos)
 * 6. Controlador → Procesa lógica de negocio
 * 7. Respuesta → Regresa por el mismo camino
 * 
 * ===== EJEMPLO DE TRAZA COMPLETA =====
 * 
 * Petición: GET /admin/users con middleware ['auth', 'role:admin', 'throttle:60,1']
 * 
 * PETICIÓN →
 * ┌─ Middleware 'auth'
 * │  ├─ ¿Usuario autenticado? ✓ SÍ → Continúa
 * │  
 * ├─ Middleware 'role:admin' 
 * │  ├─ ¿Tiene rol admin? ✓ SÍ → Continúa
 * │  
 * ├─ Middleware 'throttle:60,1'
 * │  ├─ ¿Menos de 60 peticiones/minuto? ✓ SÍ → Continúa
 * │  
 * ├─ CONTROLADOR AdminController@users
 * │  ├─ Consulta base de datos
 * │  ├─ Procesa lógica
 * │  └─ Retorna Response con lista de usuarios
 * │
 * RESPUESTA ←
 * ├─ Middleware 'throttle' ← Actualiza contador de peticiones
 * ├─ Middleware 'role' ← No hace nada en respuesta  
 * ├─ Middleware 'auth' ← No hace nada en respuesta
 * └─ Cliente recibe JSON con usuarios
 * 
 * ===== ESTRUCTURA BÁSICA =====
 * 
 * public function handle(Request $request, Closure $next, $param = null)
 * {
 *     // PRE-PROCESAMIENTO: Antes de llegar al controlador
 *     if (!$this->isValid($request)) {
 *         return response('Acceso denegado', 403); // BLOQUEA
 *     }
 * 
 *     // PASAR AL SIGUIENTE: Controlador o siguiente middleware
 *     $response = $next($request);
 * 
 *     // POST-PROCESAMIENTO: Después de generar respuesta
 *     $response->header('X-Processed-By', 'MiMiddleware');
 * 
 *     return $response;
 * }
 * 
 * ===== TIPOS DE MIDDLEWARE =====
 * 
 * 1. GLOBAL (app/Http/Kernel.php → $middleware)
 *    - Se ejecuta en TODAS las peticiones HTTP
 *    - Ejemplo: TrustProxies, HandleCors
 * 
 * 2. GRUPO (app/Http/Kernel.php → $middlewareGroups)  
 *    - Se aplica a grupos de rutas ('web', 'api')
 *    - Ejemplo: 'web' → StartSession, VerifyCsrfToken
 * 
 * 3. RUTA (app/Http/Kernel.php → $routeMiddleware)
 *    - Se aplica a rutas específicas con alias
 *    - Ejemplo: 'auth' → Authenticate
 * 
 * ===== FORMAS DE USO =====
 * 
 * // En rutas individuales
 * Route::get('/admin', [Controller::class, 'method'])->middleware('auth');
 * Route::get('/panel', [Controller::class, 'method'])->middleware(['auth', 'verified']);
 * 
 * // En grupos de rutas
 * Route::middleware(['auth'])->group(function () {
 *     Route::get('/dashboard', [Controller::class, 'index']);
 * });
 * 
 * // En controladores
 * class AdminController extends Controller {
 *     public function __construct() {
 *         $this->middleware('auth');
 *         $this->middleware('role:admin')->only(['create', 'destroy']);
 *     }
 * }
 * 
 * ===== MIDDLEWARE COMUNES INCLUIDOS =====
 * 
 * 'auth'       → Verifica que usuario esté autenticado
 * 'guest'      → Solo usuarios NO autenticados  
 * 'verified'   → Email del usuario verificado
 * 'throttle'   → Limita peticiones por tiempo
 * 'can:accion' → Verifica permisos específicos
 * 
 * ===== CREAR MIDDLEWARE PERSONALIZADO =====
 * 
 * php artisan make:middleware NombreMiddleware
 * 
 * 1. Se crea en app/Http/Middleware/
 * 2. Registrar en app/Http/Kernel.php
 * 3. Usar en rutas con su alias
 * 
 * ===== CASOS DE USO REALES =====
 * 
 * - Autenticación y autorización
 * - Rate limiting (límite de peticiones)
 * - Logging de peticiones
 * - Transformación de datos
 * - Headers CORS
 * - Validación de API keys
 * - Redirects condicionales
 * - Cache de respuestas
 * 
 * RECUERDA: El middleware es tu primera línea de defensa y control sobre las peticiones HTTP.
 * Úsalo para lógica transversal que se aplique a múltiples rutas o controladores.
 * Analogía simple:
 * Usuario → Middleware (¿Puede pasar?) → Controlador → Vista
 */

// Ejemplo práctico de middleware personalizado
class ApiKeyMiddleware
{
    public function handle($request, Closure $next)
    {
        // Pre-filtro: Validar API key
        if ($request->header('X-API-Key') !== config('app.api_key')) {
            return response()->json(['error' => 'API Key inválida'], 401);
        }
        
        // Continuar al controlador
        $response = $next($request);
        
        // Post-filtro: Agregar header de respuesta
        $response->header('X-API-Version', '1.0');
        
        return $response;
    }
}