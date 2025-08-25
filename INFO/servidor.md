
/*
 * ===== FUNCIONAMIENTO PROFUNDO DEL SERVIDOR WEB =====
 * 
 * Un servidor web es un programa que escucha en un puerto específico (80/443) 
 * esperando peticiones HTTP de clientes. Su función principal es recibir, 
 * procesar y responder a estas peticiones.
 * 
 * ===== TIPOS DE SERVIDORES WEB PRINCIPALES =====
 * 
 * 1. APACHE HTTP SERVER
 *    - Arquitectura: Multi-proceso/Multi-hilo
 *    - Módulos: mod_php, mod_rewrite, mod_ssl
 *    - Configuración: .htaccess, httpd.conf
 *    - Ventajas: Flexible, muchos módulos, compatible
 *    - Desventajas: Consume más memoria, menos eficiente con muchas conexiones
 * 
 * 2. NGINX
 *    - Arquitectura: Event-driven, asíncrono
 *    - Configuración: nginx.conf
 *    - Ventajas: Alto rendimiento, bajo consumo memoria, proxy reverso
 *    - Desventajas: Menos módulos, configuración más compleja
 * 
 * 3. LIGHTTPD, IIS, LiteSpeed, etc.
 * 
 * ===== FUNCIONAMIENTO INTERNO PASO A PASO =====
 * 
 * NIVEL 1: SISTEMA OPERATIVO
 * ┌─────────────────────────────────────────────────┐
 * │ 1. Cliente envía petición TCP/IP                │
 * │ 2. SO recibe en puerto 80/443                   │
 * │ 3. SO notifica al servidor web (Apache/Nginx)   │
 * │ 4. Servidor web acepta conexión                 │
 * └─────────────────────────────────────────────────┘
 * 
 * NIVEL 2: SERVIDOR WEB
 * ┌─────────────────────────────────────────────────┐
 * │ 1. Parse petición HTTP (method, URI, headers)   │
 * │ 2. Verificar host virtual (dominio)             │
 * │ 3. Aplicar reglas de reescritura (mod_rewrite)  │
 * │ 4. Determinar tipo de contenido                 │
 * │ 5. Verificar permisos de archivo/directorio     │
 * └─────────────────────────────────────────────────┘
 * 
 * NIVEL 3: PROCESAMIENTO PHP (para Laravel)
 * ┌─────────────────────────────────────────────────┐
 * │ 1. Servidor web invoca PHP (mod_php/PHP-FPM)    │
 * │ 2. PHP carga e interpreta public/index.php      │
 * │ 3. Laravel bootstrap se ejecuta                 │
 * │ 4. Se crea instancia de Application             │
 * │ 5. Se registran service providers               │
 * └─────────────────────────────────────────────────┘
 * 
 * ===== TRAZA DETALLADA: GET /admin/users =====
 * 
 * 🌐 CLIENTE (Navegador)
 * ├─ Usuario hace clic en enlace
 * ├─ Browser crea petición HTTP:
 * │  GET /admin/users HTTP/1.1
 * │  Host: miapp.com
 * │  Cookie: laravel_session=abc123
 * │  User-Agent: Mozilla/5.0...
 * └─ Envía via TCP socket al servidor
 * 
 * 🖥️ SERVIDOR WEB (Apache/Nginx)
 * ├─ Recibe conexión TCP en puerto 80
 * ├─ Parse petición HTTP completa
 * ├─ Identifica virtual host (miapp.com)
 * ├─ Aplicar reglas .htaccess/nginx.conf:
 * │  RewriteRule ^(.*)$ /public/index.php [QSA,L]
 * ├─ Traducir /admin/users → /public/index.php
 * ├─ Verificar que index.php existe y es legible
 * └─ Decidir: ¿Archivo estático o PHP? → PHP
 * 
 * ⚙️ MOTOR PHP (mod_php o PHP-FPM)
 * ├─ Servidor web invoca PHP
 * ├─ PHP carga public/index.php en memoria
 * ├─ Inicializar opcodes cache (OPcache)
 * ├─ Ejecutar código PHP línea por línea
 * └─ Crear variables superglobales ($_GET, $_POST, $_SERVER)
 * 
 * 🚀 LARAVEL BOOTSTRAP (public/index.php)
 * ├─ require_once __DIR__.'/../vendor/autoload.php';
 * │  └─ Carga Composer autoloader (mapeo clases)
 * ├─ $app = require_once __DIR__.'/../bootstrap/app.php';
 * │  ├─ Crea instancia Illuminate\Foundation\Application
 * │  ├─ Registra service providers básicos
 * │  ├─ Registra exception handler
 * │  └─ Retorna instancia $app
 * ├─ $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
 * │  └─ Crea instancia Http\Kernel (maneja peticiones HTTP)
 * └─ $response = $kernel->handle($request = Illuminate\Http\Request::capture());
 * 
 * 🔧 HTTP KERNEL (Illuminate\Foundation\Http\Kernel)
 * ├─ Request::capture() → Crea objeto Request desde $_SERVER, $_GET, etc.
 * ├─ sendRequestThroughRouter($request)
 * │  ├─ bootstrap() → Carga configuración, providers, facades
 * │  ├─ Pipeline de middleware globales:
 * │  │  ├─ TrustHosts (valida host header)
 * │  │  ├─ TrustProxies (maneja proxies reversos) 
 * │  │  ├─ HandleCors (headers CORS)
 * │  │  ├─ PreventRequestsDuringMaintenance (modo mantenimiento)
 * │  │  ├─ ValidatePostSize (tamaño POST)
 * │  │  ├─ TrimStrings (trim espacios)
 * │  │  └─ ConvertEmptyStringsToNull
 * │  └─ dispatchToRouter($request)
 * └─ Router encuentra ruta y ejecuta pipeline específico
 * 
 * 🛣️ ROUTER (Illuminate\Routing\Router)
 * ├─ Buscar ruta que coincida con /admin/users
 * ├─ Encontrada: Route::get('/admin/users', [AdminController::class, 'users'])
 * │              ->middleware(['auth', 'role:admin', 'throttle:60,1'])
 * ├─ Crear Route match object
 * ├─ Resolver middleware de la ruta:
 * │  ├─ 'auth' → App\Http\Middleware\Authenticate
 * │  ├─ 'role:admin' → App\Http\Middleware\CheckRole
 * │  └─ 'throttle:60,1' → Illuminate\Routing\Middleware\ThrottleRequests
 * └─ Crear pipeline con middleware + controlador
 * 
 * 🔐 PIPELINE DE MIDDLEWARE
 * ├─ Pipeline::through([middleware1, middleware2, ...])
 * ├─ Pipeline usa patrón Chain of Responsibility
 * ├─ Cada middleware recibe: ($request, Closure $next)
 * └─ Ejecución anidada con closures:
 * 
 *    function pipeline() {
 *        return middleware1($request, function($request) {
 *            return middleware2($request, function($request) {
 *                return middleware3($request, function($request) {
 *                    return CONTROLADOR($request);
 *                });
 *            });
 *        });
 *    }
 * 
 * MIDDLEWARE 1: 'auth' (Authenticate)
 * ├─ Verificar session: $_SESSION['login_web_...'] 
 * ├─ Deserializar usuario desde ID en sesión
 * ├─ Auth::user() → Cargar User model desde DB
 * ├─ ¿Autenticado? ✓ SÍ
 * └─ return $next($request); // Continúa al siguiente
 * 
 * MIDDLEWARE 2: 'role:admin' (CheckRole)  
 * ├─ $user = Auth::user();
 * ├─ $user->hasRole('admin') → Consulta DB roles
 * ├─ ¿Tiene rol admin? ✓ SÍ  
 * └─ return $next($request); // Continúa al siguiente
 * 
 * MIDDLEWARE 3: 'throttle:60,1' (ThrottleRequests)
 * ├─ Generar key: "throttle:127.0.0.1:admin/users"
 * ├─ Redis/Cache::get($key) → Verificar contador actual
 * ├─ ¿Menos de 60 peticiones en 1 minuto? ✓ SÍ
 * ├─ Cache::increment($key, 1, 60) → Incrementar contador
 * └─ return $next($request); // Continúa al controlador
 * 
 * 🎯 CONTROLADOR (AdminController@users)
 * ├─ Laravel resuelve AdminController desde container
 * ├─ Inyección de dependencias en constructor
 * ├─ Ejecutar método users()
 * ├─ Lógica de negocio:
 * │  ├─ $users = User::with('roles')->paginate(15);
 * │  │  └─ Eloquent genera SQL, ejecuta query en DB
 * │  ├─ Procesar datos, aplicar business logic
 * │  └─ return response()->json($users);
 * └─ Retorna Response object
 * 
 * 🔄 RESPUESTA A TRAVÉS DEL PIPELINE (reversa)
 * ├─ Response pasa por middleware en orden INVERSO
 * ├─ throttle: Middleware ya incrementó contador (no hace nada)
 * ├─ role: No tiene lógica post-respuesta
 * ├─ auth: No tiene lógica post-respuesta  
 * └─ Response llega de vuelta al Kernel
 * 
 * 📤 HTTP KERNEL (envío de respuesta)
 * ├─ $response->send()
 * │  ├─ Enviar headers HTTP (Content-Type, Status, etc.)
 * │  ├─ Enviar body (JSON con lista usuarios)
 * │  └─ flush() → Forzar envío inmediato
 * ├─ $kernel->terminate($request, $response)
 * │  └─ Ejecutar tareas post-respuesta (logs, cleanup)
 * └─ Finalizar script PHP
 * 
 * 🖥️ SERVIDOR WEB (finalización)  
 * ├─ Recibe respuesta completa de PHP
 * ├─ Agrega headers propios del servidor
 * ├─ Calcula Content-Length si es necesario
 * ├─ Envía respuesta completa al cliente via TCP
 * ├─ Logging de acceso (access.log)
 * └─ Cierra conexión o la mantiene (Keep-Alive)
 * 
 * 🌐 CLIENTE (Navegador)
 * ├─ Recibe respuesta HTTP completa
 * ├─ Parse JSON response
 * ├─ Renderiza tabla de usuarios en DOM
 * └─ Usuario ve la página completamente cargada
 * 
 * ===== GESTIÓN DE MEMORIA Y RECURSOS =====
 * 
 * APACHE (mod_php):
 * - Cada proceso Apache tiene su propia instancia PHP
 * - PHP se carga en memoria con cada proceso hijo
 * - Variables PHP se almacenan en memoria del proceso
 * - Al finalizar petición: garbage collection + memory cleanup
 * 
 * NGINX + PHP-FPM:
 * - Nginx maneja conexiones, PHP-FPM procesa PHP
 * - Pool de procesos PHP reutilizables
 * - Comunicación via FastCGI (socket/TCP)
 * - Mejor aislamiento y escalabilidad
 * 
 * ===== OPTIMIZACIONES COMUNES =====
 * 
 * 1. OPcache: Cache de opcodes PHP compilados
 * 2. Redis/Memcached: Cache de sesiones y datos
 * 3. CDN: Archivos estáticos servidos desde CDN  
 * 4. Gzip: Compresión de respuestas HTTP
 * 5. HTTP/2: Multiplexing de conexiones
 * 6. Load Balancer: Distribución entre múltiples servidores
 * 
 * ===== MONITOREO Y DEBUGGING =====
 * 
 * Logs importantes:
 * - access.log: Todas las peticiones HTTP
 * - error.log: Errores del servidor web
 * - laravel.log: Logs de la aplicación
 * - php-fpm.log: Logs del pool PHP
 * 
 * Métricas clave:
 * - Tiempo de respuesta promedio
 * - Requests per second (RPS)
 * - Uso de CPU y memoria
 * - Conexiones concurrentes
 * - Error rate (4xx/5xx)
 * 
 * HERRAMIENTAS:
 * - New Relic, Datadog: APM
 * - htop, top: Monitor sistema
 * - Apache Bench (ab): Load testing
 * - Xdebug: Profiling PHP
 * 
 * ===== PATRONES DE DISEÑO INVOLUCRADOS =====
 * 
 * 1. FRONT CONTROLLER: public/index.php maneja todas las peticiones
 * 2. CHAIN OF RESPONSIBILITY: Pipeline de middleware  
 * 3. SERVICE LOCATOR: Laravel Container para resolver dependencias
 * 4. FACADE: Interfaces estáticas para acceder a servicios
 * 5. OBSERVER: Event system de Laravel
 * 6. STRATEGY: Diferentes drivers (database, cache, queue)
 * 7. FACTORY: Creación de objetos via Container
 * 8. SINGLETON: Muchos servicios de Laravel son singleton
 * 
 * El servidor web actúa como el director de orquesta que coordina todos 
 * estos componentes para procesar cada petición HTTP de manera eficiente.
 */

// Ejemplo de configuración Apache Virtual Host para Laravel
/*
<VirtualHost *:80>
    ServerName miapp.com
    DocumentRoot /var/www/miapp/public
    
    <Directory /var/www/miapp/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    # Logs
    CustomLog ${APACHE_LOG_DIR}/miapp_access.log combined
    ErrorLog ${APACHE_LOG_DIR}/miapp_error.log
</VirtualHost>
*/

// Ejemplo de configuración Nginx para Laravel  
/*
server {
    listen 80;
    server_name miapp.com;
    root /var/www/miapp/public;
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    # Logs
    access_log /var/log/nginx/miapp_access.log;
    error_log /var/log/nginx/miapp_error.log;
}
*/