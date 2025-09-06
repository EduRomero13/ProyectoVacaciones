<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}" />
    <title>Sunny Class</title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Main Styling -->
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css?v=1.0.5') }}" rel="stylesheet" />

    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
  </head>

  <body class="m-0 font-sans antialiased font-normal bg-white text-start text-base leading-default text-slate-500">

    <!-- Navbar -->
    <nav class="absolute top-0 z-30 flex flex-wrap items-center justify-between w-full px-4 py-2 mt-6 mb-4 shadow-none lg:flex-nowrap lg:justify-start">
      <div class="container flex items-center justify-between py-0 flex-wrap-inherit">
        <a class="py-2.375 text-sm mr-4 ml-4 whitespace-nowrap font-bold text-white lg:ml-0" href="../pages/dashboard.html"> Sunny Class </a>
        <button navbar-trigger class="px-3 py-1 ml-2 leading-none transition-all bg-transparent border border-transparent border-solid rounded-lg shadow-none cursor-pointer text-lg ease-soft-in-out lg:hidden" type="button" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
          <span class="inline-block mt-2 align-middle bg-center bg-no-repeat bg-cover w-6 h-6 bg-none">
            <span bar1 class="w-5.5 rounded-xs duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar2 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
            <span bar3 class="w-5.5 rounded-xs mt-1.75 duration-350 relative my-0 mx-auto block h-px bg-white transition-all"></span>
          </span>
        </button>
        <div navbar-menu class="items-center flex-grow transition-all ease-soft duration-350 lg-max:bg-white lg-max:max-h-0 lg-max:overflow-hidden basis-full rounded-xl lg:flex lg:basis-auto">
          <ul class="flex flex-col pl-0 mx-auto mb-0 list-none lg:flex-row xl:ml-auto">
            <li>
              <a class="flex items-center px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75" aria-current="page" href="../pages/dashboard.html">
                <i class="mr-1 text-white lg-max:text-slate-700 fa fa-chart-pie opacity-60"></i>
                algo
              </a>
            </li>
            <li>
              <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75" href="../pages/profile.html">
                <i class="mr-1 text-white lg-max:text-slate-700 fa fa-user opacity-60"></i>
                algo
              </a>
            </li>
            <li>
              <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75" href="../pages/sign-up.html">
                <i class="mr-1 text-white lg-max:text-slate-700 fas fa-user-circle opacity-60"></i>
                algo
              </a>
            </li>
            <li>
              <a class="block px-4 py-2 mr-2 font-normal text-white transition-all duration-250 lg-max:opacity-0 lg-max:text-slate-700 ease-soft-in-out text-sm lg:px-2 lg:hover:text-white/75" href="../pages/sign-in.html">
                <i class="mr-1 text-white lg-max:text-slate-700 fas fa-key opacity-60"></i>
                algo
              </a>
            </li>
          </ul>
          <!-- online builder btn  -->
          <!-- <li class="flex items-center">
            <a
              class="leading-pro ease-soft-in border-white/75 text-xs tracking-tight-soft rounded-3.5xl hover:border-white/75 hover:scale-102 active:hover:border-white/75 active:hover:scale-102 active:opacity-85 active:shadow-soft-xs active:border-white/75 bg-white/10 hover:bg-white/10 active:hover:bg-white/10 mr-2 mb-0 inline-block cursor-pointer border border-solid py-2 px-8 text-center align-middle font-bold uppercase text-white shadow-none transition-all hover:text-white hover:opacity-75 hover:shadow-none active:scale-100 active:bg-white active:text-black active:hover:text-white active:hover:opacity-75 active:hover:shadow-none"
              target="_blank"
              href="https://www.creative-tim.com/builder/soft-ui?ref=navbar-dashboard&amp;_ga=2.76518741.1192788655.1647724933-1242940210.1644448053"
              >Online Builder</a
            >
          </li> -->
          <ul class="hidden pl-0 mb-0 list-none lg:block lg:flex-row">
            <li>
              <a href="https://www.creative-tim.com/product/soft-ui-dashboard-tailwind" target="_blank" class="leading-pro hover:scale-102 hover:shadow-soft-xs active:opacity-85 ease-soft-in text-xs tracking-tight-soft shadow-soft-md bg-gradient-to-tl from-gray-400 to-gray-100 rounded-3.5xl mb-0 mr-1 inline-block cursor-pointer border-0 bg-transparent px-8 py-2 text-center align-middle font-bold uppercase text-slate-800 transition-all">Descargar Gratis</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <main class="mt-0 transition-all duration-200 ease-soft-in-out">
      <section style="min-height: 85vh; margin-bottom: 20px;">
        <div class="relative flex items-start bg-center bg-cover rounded-xl" style="background-image: url('{{ asset('assets/img/curved-images/curved14.jpg') }}'); padding-top: 30px; padding-bottom: 120px; margin: 10px; min-height: 350px;">
          <span class="absolute top-0 left-0 w-full h-full bg-center bg-cover bg-gradient-to-tl from-gray-900 to-slate-800 opacity-60"></span>
          <div class="container z-10">
            <div class="flex flex-wrap justify-center -mx-3">
              <div class="w-full max-w-full px-3 mx-auto mt-0 text-center lg:flex-0 shrink-0 lg:w-5/12">
                <h1 style="margin-top: 50px; margin-bottom: 15px;" class="text-white">¡Bienvenido!</h1>
                <p class="text-white">Usa este formulario para registrarte y así poder iniciar seción.</p>
              </div>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="flex flex-wrap -mx-3" style="margin-top: -100px;">
            <div class="w-full max-w-full px-3 mx-auto mt-0 md:flex-0 shrink-0 md:w-9/12 lg:w-7/12 xl:w-6/12">
              <div class="relative z-0 flex flex-col min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
                <div style="padding: 15px 24px;" class="mb-0 text-center bg-white border-b-0 rounded-t-2xl">
                  <h5>Regístrate con</h5>
                </div>
                <div class="flex flex-wrap px-3 -mx-3 sm:px-6 xl:px-12">
                  <div class="w-3/12 max-w-full px-1 ml-auto flex-0">
                    <a style="padding: 10px 15px; margin-bottom: 10px;" class="inline-block w-full font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:bg-transparent hover:opacity-75" href="javascript:;">
                      <svg width="20px" height="24px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink32">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(3.000000, 3.000000)" fill-rule="nonzero">
                            <circle fill="#3C5A9A" cx="29.5091719" cy="29.4927506" r="29.4882047"></circle>
                            <path d="M39.0974944,9.05587273 L32.5651312,9.05587273 C28.6886088,9.05587273 24.3768224,10.6862851 24.3768224,16.3054653 C24.395747,18.2634019 24.3768224,20.1385313 24.3768224,22.2488655 L19.8922122,22.2488655 L19.8922122,29.3852113 L24.5156022,29.3852113 L24.5156022,49.9295284 L33.0113092,49.9295284 L33.0113092,29.2496356 L38.6187742,29.2496356 L39.1261316,22.2288395 L32.8649196,22.2288395 C32.8649196,22.2288395 32.8789377,19.1056932 32.8649196,18.1987181 C32.8649196,15.9781412 35.1755132,16.1053059 35.3144932,16.1053059 C36.4140178,16.1053059 38.5518876,16.1085101 39.1006986,16.1053059 L39.1006986,9.05587273 L39.0974944,9.05587273 L39.0974944,9.05587273 Z" fill="#FFFFFF"></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div class="w-3/12 max-w-full px-1 flex-0">
                    <a style="padding: 10px 15px; margin-bottom: 10px;" class="inline-block w-full font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:bg-transparent hover:opacity-75" href="javascript:;">
                      <svg width="20px" height="24px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(7.000000, 0.564551)" fill="#000000" fill-rule="nonzero">
                            <path
                              d="M40.9233048,32.8428307 C41.0078713,42.0741676 48.9124247,45.146088 49,45.1851909 C48.9331634,45.4017274 47.7369821,49.5628653 44.835501,53.8610269 C42.3271952,57.5771105 39.7241148,61.2793611 35.6233362,61.356042 C31.5939073,61.431307 30.2982233,58.9340578 25.6914424,58.9340578 C21.0860585,58.9340578 19.6464932,61.27947 15.8321878,61.4314159 C11.8738936,61.5833617 8.85958554,57.4131833 6.33064852,53.7107148 C1.16284874,46.1373849 -2.78641926,32.3103122 2.51645059,22.9768066 C5.15080028,18.3417501 9.85858819,15.4066355 14.9684701,15.3313705 C18.8554146,15.2562145 22.5241194,17.9820905 24.9003639,17.9820905 C27.275104,17.9820905 31.733383,14.7039812 36.4203248,15.1854154 C38.3824403,15.2681959 43.8902255,15.9888223 47.4267616,21.2362369 C47.1417927,21.4153043 40.8549638,25.1251794 40.9233048,32.8428307 M33.3504628,10.1750144 C35.4519466,7.59650964 36.8663676,4.00699306 36.4804992,0.435448578 C33.4513624,0.558856931 29.7884601,2.48154382 27.6157341,5.05863265 C25.6685547,7.34076135 23.9632549,10.9934525 24.4233742,14.4943068 C27.7996959,14.7590956 31.2488715,12.7551531 33.3504628,10.1750144"
                            ></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div class="w-3/12 max-w-full px-1 mr-auto flex-0">
                    <a style="padding: 10px 15px; margin-bottom: 10px;" class="inline-block w-full font-bold text-center text-gray-200 uppercase align-middle transition-all bg-transparent border border-gray-200 border-solid rounded-lg shadow-none cursor-pointer hover:scale-102 leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 hover:bg-transparent hover:opacity-75" href="javascript:;">
                      <svg width="20px" height="24px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <g transform="translate(3.000000, 2.000000)" fill-rule="nonzero">
                            <path d="M57.8123233,30.1515267 C57.8123233,27.7263183 57.6155321,25.9565533 57.1896408,24.1212666 L29.4960833,24.1212666 L29.4960833,35.0674653 L45.7515771,35.0674653 C45.4239683,37.7877475 43.6542033,41.8844383 39.7213169,44.6372555 L39.6661883,45.0037254 L48.4223791,51.7870338 L49.0290201,51.8475849 C54.6004021,46.7020943 57.8123233,39.1313952 57.8123233,30.1515267" fill="#4285F4"></path>
                            <path d="M29.4960833,58.9921667 C37.4599129,58.9921667 44.1456164,56.3701671 49.0290201,51.8475849 L39.7213169,44.6372555 C37.2305867,46.3742596 33.887622,47.5868638 29.4960833,47.5868638 C21.6960582,47.5868638 15.0758763,42.4415991 12.7159637,35.3297782 L12.3700541,35.3591501 L3.26524241,42.4054492 L3.14617358,42.736447 C7.9965904,52.3717589 17.959737,58.9921667 29.4960833,58.9921667" fill="#34A853"></path>
                            <path d="M12.7159637,35.3297782 C12.0932812,33.4944915 11.7329116,31.5279353 11.7329116,29.4960833 C11.7329116,27.4640054 12.0932812,25.4976752 12.6832029,23.6623884 L12.6667095,23.2715173 L3.44779955,16.1120237 L3.14617358,16.2554937 C1.14708246,20.2539019 0,24.7439491 0,29.4960833 C0,34.2482175 1.14708246,38.7380388 3.14617358,42.736447 L12.7159637,35.3297782" fill="#FBBC05"></path>
                            <path d="M29.4960833,11.4050769 C35.0347044,11.4050769 38.7707997,13.7975244 40.9011602,15.7968415 L49.2255853,7.66898166 C44.1130815,2.91684746 37.4599129,0 29.4960833,0 C17.959737,0 7.9965904,6.62018183 3.14617358,16.2554937 L12.6832029,23.6623884 C15.0758763,16.5505675 21.6960582,11.4050769 29.4960833,11.4050769" fill="#EB4335"></path>
                          </g>
                        </g>
                      </svg>
                    </a>
                  </div>
                  <div class="relative w-full max-w-full px-3 text-center shrink-0" style="margin-top: 5px;">
                    <p style="margin-bottom: 5px;" class="z-20 inline px-4 font-semibold leading-normal bg-white text-sm text-slate-400">o también con</p>
                  </div>
                </div>
                <div style="padding: 15px 24px;" class="flex-auto">
                  <form role="form text-left" id="registrationForm" method="POST" action="/register" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Selector de tipo de usuario -->
                    <div style="margin-bottom: 20px;">
                      <label class="block text-sm font-semibold text-slate-700 mb-2">Tipo de usuario</label>
                      <div class="flex gap-3">
                        <div class="flex items-center mr-2">
                          <input type="radio" id="estudiante" name="user_type" value="estudiante" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2" checked>
                          <label for="estudiante" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer flex items-center">
                            <i class="fas fa-user-graduate text-blue-600 mr-1"></i>
                            Estudiante
                          </label>
                        </div>
                        <div class="flex items-center mr-2">
                          <input type="radio" id="padre" name="user_type" value="padre" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                          <label for="padre" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer flex items-center">
                            <i class="fas fa-users text-blue-600 mr-1"></i>
                            Padre/Madre    
                          </label>
                        </div>
                        <div class="flex items-center">
                          <input type="radio" id="docente" name="user_type" value="docente" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                          <label for="docente" class="ml-2 text-sm font-medium text-gray-700 cursor-pointer flex items-center">
                            <i class="fas fa-chalkboard-teacher text-blue-600 mr-1"></i>
                            Docente
                          </label>
                        </div>
                      </div>
                    </div>

                    <!-- Datos básicos (comunes para todos) -->
                    <div class="mb-4">
                      <h6 class="text-sm font-semibold text-slate-700 mb-3">Datos Personales</h6>
                      
                      <div style="margin-bottom: 12px;">
                        <input type="text" name="name" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Nombre completo" />
                        @error('name')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                        <input type="text" name="dni" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="DNI" />
                        @error('dni')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                        <input type="date" name="fechaNacimiento" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" />
                        @error('fechaNacimiento')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                      <div class="flex items-center gap-2">
                        <input 
                          type="email" 
                          name="email" 
                          id="email"
                          required 
                          class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" 
                          placeholder="Correo electrónico" 
                          value="{{ session('verified_email') ?? old('email') }}"
                          {{ session('email_verified') ? 'readonly' : '' }}
                        />
                        
                        @if(!session('email_verified'))
                          <button 
                            type="button" 
                            id="verifyEmailBtn"
                            class="px-3 py-2 bg-black hover:bg-blue-700 text-white text-xs font-medium rounded-lg transition-colors duration-200 whitespace-nowrap"
                          >
                            Verificar
                          </button>
                        @endif
                        
                        <div class="flex items-center">
                          <input 
                            type="checkbox" 
                            id="emailVerified" 
                            name="email_verified"
                            class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2"
                            {{ session('email_verified') ? 'checked' : '' }}
                            disabled
                          />
                          <label for="emailVerified" class="ml-1 text-xs text-gray-700 whitespace-nowrap">
                            Verificado
                          </label>
                        </div>
                      </div>
                      
                      @if(session('success'))
                        <div class="mt-1 text-xs text-green-500">{{ session('success') }}</div>
                      @endif
                      
                      @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                      @enderror
                      
                      <div id="emailStatus" class="mt-1 text-xs hidden"></div>
                    </div>

                      <div style="margin-bottom: 12px;">
                        <input type="password" name="password" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Contraseña" />
                        @error('password')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                        <input type="password" name="password_confirmation" required class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Confirmar contraseña" />
                      </div>
                    </div>

                    <!-- Campos específicos para estudiantes -->
                    <div id="estudiante-fields" class="role-specific-fields mb-4">
                      <h6 class="text-sm font-semibold text-slate-700 mb-3">Documentos de Estudiante</h6>
                      
                      <div style="margin-bottom: 12px;">
                        <label class="block text-xs text-slate-600 mb-1">Partida de Nacimiento (PDF/JPG)</label>
                        <input type="file" name="partida_nacimiento" accept=".pdf,.jpg,.jpeg,.png" class="text-sm block w-full text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @error('partida_nacimiento')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                        <label class="block text-xs text-slate-600 mb-1">Constancia de Estudios Anteriores (PDF/JPG)</label>
                        <input type="file" name="constancia_estudios" accept=".pdf,.jpg,.jpeg,.png" class="text-sm block w-full text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @error('constancia_estudios')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <!-- Campos específicos para padres de familia -->
                    <div id="padre-fields" class="role-specific-fields mb-4" style="display: none;">
                      <h6 class="text-sm font-semibold text-slate-700 mb-3">Información extra</h6>
                      <div style="margin-bottom: 12px;">
                        <label class="block text-xs text-slate-600 mb-1">Últimos 4 dígitos de tarjeta (opcional)</label>
                        <input type="text" name="ultimos_digitos_tarjeta" maxlength="4" pattern="[0-9]{4}" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="XXXX" />
                        @error('ultimos_digitos_tarjeta')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <!-- Campos específicos para docentes -->
                    <div id="docente-fields" class="role-specific-fields mb-4" style="display: none;">
                      <h6 class="text-sm font-semibold text-slate-700 mb-3">Documentos Profesionales</h6>
                      
                      <div style="margin-bottom: 12px;">
                        <input type="text" name="especialidad" class="text-sm focus:shadow-soft-primary-outline leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 px-3 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:bg-white focus:text-gray-700 focus:outline-none focus:transition-shadow" placeholder="Especialidad" />
                        @error('especialidad')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                        <label class="block text-xs text-slate-600 mb-1">Título Universitario (PDF/JPG)</label>
                        <input type="file" name="titulo_profesional" accept=".pdf,.jpg,.jpeg,.png" class="text-sm block w-full text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @error('titulo_profesional')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>

                      <div style="margin-bottom: 12px;">
                        <label class="block text-xs text-slate-600 mb-1">Curriculum Vitae (PDF)</label>
                        <input type="file" name="curriculum_vitae" accept=".pdf" class="text-sm block w-full text-gray-700 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                        @error('curriculum_vitae')
                          <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                    <div style="margin-bottom: 8px;" class="min-h-6 pl-6.92 block">
                      <input id="terms" name="terms" required class="w-4.92 h-4.92 ease-soft -ml-6.92 rounded-1.4 checked:bg-gradient-to-tl checked:from-gray-900 checked:to-slate-800 after:text-xxs after:font-awesome after:duration-250 after:ease-soft-in-out duration-250 relative float-left mt-1 cursor-pointer appearance-none border border-solid border-slate-200 bg-white bg-contain bg-center bg-no-repeat align-top transition-all after:absolute after:flex after:h-full after:w-full after:items-center after:justify-center after:text-white after:opacity-0 after:transition-all after:content-['\f00c'] checked:border-0 checked:border-transparent checked:bg-transparent checked:after:opacity-100" type="checkbox" value="1" />
                      <label class="mb-2 ml-1 font-normal cursor-pointer select-none text-sm text-slate-700" for="terms"> Estoy de acuerdo con los <a href="javascript:;" class="font-bold text-slate-700">Términos y condiciones</a> </label>
                      @error('terms')
                        <span class="text-red-500 text-xs block">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                      <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-500 mt-1 mr-2"></i>
                        <div class="text-sm text-blue-700">
                          <p class="font-semibold mb-1">Proceso de Verificación</p>
                          <p>Sus documentos serán validados por el administrador. Recibirá un correo electrónico con el resultado de la verificación en un plazo de 12-24 horas.</p>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" style="padding: 12px 24px; margin-top: 15px; margin-bottom: 8px;" class="inline-block w-full font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer active:opacity-85 hover:scale-102 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-gray-900 to-slate-800 hover:border-slate-700 hover:bg-slate-700 hover:text-white">Registrarse</button>
                    </div>
                    <p style="margin-top: 10px; margin-bottom: 0;" class="leading-normal text-sm">¿Ya tienes una cuenta? <a href="/" class="font-bold text-slate-700">Iniciar sesión</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
      <footer style="padding: 10px 0; margin-top: -30px;">
        <div class="container">
          <div class="flex flex-wrap -mx-3">
            <div style="margin-bottom: 8px;" class="flex-shrink-0 w-full max-w-full mx-auto text-center lg:flex-0 lg:w-8/12">
              <a href="javascript:;" target="_blank" style="margin-right: 15px; margin-bottom: 2px;" class="text-slate-400 sm:mb-0 xl:mr-12"> Compañía </a>
              <a href="javascript:;" target="_blank" style="margin-right: 15px; margin-bottom: 2px;" class="text-slate-400 sm:mb-0 xl:mr-12"> Acerca de nosotros </a>
              <a href="javascript:;" target="_blank" style="margin-right: 15px; margin-bottom: 2px;" class="text-slate-400 sm:mb-0 xl:mr-12"> Equipo </a>
              <a href="javascript:;" target="_blank" style="margin-right: 15px; margin-bottom: 2px;" class="text-slate-400 sm:mb-0 xl:mr-12"> Cursos </a>
              <a href="javascript:;" target="_blank" style="margin-right: 15px; margin-bottom: 2px;" class="text-slate-400 sm:mb-0 xl:mr-12"> Blog </a>
              <a href="javascript:;" target="_blank" style="margin-right: 15px; margin-bottom: 2px;" class="text-slate-400 sm:mb-0 xl:mr-12"> Precios </a>
            </div>
            <div style="margin-bottom: 8px;" class="flex-shrink-0 w-full max-w-full mx-auto text-center lg:flex-0 lg:w-8/12">
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-dribbble"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-twitter"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-instagram"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-pinterest"></span>
              </a>
              <a href="javascript:;" target="_blank" class="mr-6 text-slate-400">
                <span class="text-lg fab fa-github"></span>
              </a>
            </div>
          </div>
          <div class="flex flex-wrap -mx-3">
            <div class="w-8/12 max-w-full px-3 mx-auto text-center flex-0" style="margin-top: 0;">
              <p class="mb-0 text-slate-400">
                Copyright ©
                <script>
                  document.write(new Date().getFullYear());
                </script>
                Creado por Eduardo Romero.
              </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
  </body>
  <!-- plugin for scrollbar  -->
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
  <!-- main script file  -->
  <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js?v=1.0.5') }}" async></script>
  

  <!-- Script para el auto rellenado de los inputs al verificar el correo -->
  <script>
  document.addEventListener('DOMContentLoaded', function() {
      // Verificar si hay datos del formulario en la sesión
      @if(session('form_data'))
          const formData = @json(session('form_data'));
          
          // Rellenar los campos del formulario
          Object.keys(formData).forEach(function(key) {
              const input = document.querySelector(`[name="${key}"]`);
              if (input && formData[key]) {
                  if (input.type === 'radio' || input.type === 'checkbox') {
                      if (input.value === formData[key]) {
                          input.checked = true;
                      }
                  } else {
                      input.value = formData[key];
                  }
              }
          });
          
          // Si hay contraseña guardada, también rellenarla
          @if(session('pending_registration_password'))
              const password = '{{ session("pending_registration_password") }}';
              const passwordInput = document.querySelector('[name="password"]');
              const passwordConfInput = document.querySelector('[name="password_confirmation"]');
              if (passwordInput) passwordInput.value = password;
              if (passwordConfInput) passwordConfInput.value = password;
          @endif
      @endif
  });
  </script>

  <!-- Script para la verificación del correo -->
  @if(session('email_verified'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const emailCheckbox = document.getElementById('emailVerified');
            const emailInput = document.getElementById('email');
            
            if (emailCheckbox && emailInput) {
                emailCheckbox.checked = true;
                emailInput.readOnly = true;
            }
        });
    </script>
  @endif

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const verifyBtn = document.getElementById('verifyEmailBtn');
    const emailInput = document.getElementById('email');
    const emailCheckbox = document.getElementById('emailVerified');
    const emailStatus = document.getElementById('emailStatus');
    const form = document.getElementById('registrationForm');
    
    verifyBtn.addEventListener('click', function() {
      const email = emailInput.value.trim();
      
      if (!email) {
        showStatus('Por favor ingresa un email válido', 'error');
        return;
      }
      
      // Validación básica de email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showStatus('Por favor ingresa un email válido', 'error');
        return;
      }
      
      // Cambiar estado del botón
      verifyBtn.disabled = true;
      verifyBtn.innerHTML = 'Enviando...';
      verifyBtn.classList.remove('bg-black', 'hover:bg-blue-700');
      verifyBtn.classList.add('bg-gray-400');
      
      // Crear FormData con todos los datos del formulario
      const formData = new FormData(form);
      
      // Agregar el email específicamente
      formData.set('email', email);
      
      // Remover archivos del FormData para esta petición (solo verificamos email)
      const fileInputs = form.querySelectorAll('input[type="file"]');
      fileInputs.forEach(input => {
        formData.delete(input.name);
      });
      
      fetch('{{ route("verify.email.exists") }}', {
          method: 'POST',
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
              // No incluir Content-Type, let browser set it para FormData
          },
          body: formData
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              showStatus(data.message, 'success');
              verifyBtn.innerHTML = 'Enviado';
          } else {
              showStatus(data.message, 'error');
              verifyBtn.disabled = false;
              verifyBtn.innerHTML = 'Verificar';
              verifyBtn.classList.remove('bg-gray-400');
              verifyBtn.classList.add('bg-black', 'hover:bg-blue-700');
          }
      })
      .catch(error => {
          console.error('Error:', error);
          showStatus('Error al enviar el correo', 'error');
          verifyBtn.disabled = false;
          verifyBtn.innerHTML = 'Verificar';
          verifyBtn.classList.remove('bg-gray-400');
          verifyBtn.classList.add('bg-black', 'hover:bg-blue-700');
      });
    });
    
    function showStatus(message, type) {
      emailStatus.textContent = message;
      emailStatus.classList.remove('hidden', 'text-red-500', 'text-green-500', 'text-blue-500');
      
      if (type === 'error') {
        emailStatus.classList.add('text-red-500');
      } else if (type === 'success') {
        emailStatus.classList.add('text-blue-500');
      } else if (type === 'verified') {
        emailStatus.classList.add('text-green-500');
      }
      
      emailStatus.classList.remove('hidden');
    }
  });
  </script>

  <!-- Script para manejar campos dinámicos según tipo de usuario -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const userTypeRadios = document.querySelectorAll('input[name="user_type"]');
      const roleFields = document.querySelectorAll('.role-specific-fields');
      
      function toggleFields() {
        // Ocultar todos los campos específicos
        roleFields.forEach(field => {
          field.style.display = 'none';
          // Remover required de campos ocultos
          const inputs = field.querySelectorAll('input, select, textarea');
          inputs.forEach(input => {
            input.removeAttribute('required');
          });
        });
        
        // Mostrar campos del tipo seleccionado
        const selectedType = document.querySelector('input[name="user_type"]:checked').value;
        const fieldsToShow = document.getElementById(selectedType + '-fields');
        
        if (fieldsToShow) {
          fieldsToShow.style.display = 'block';
          // Añadir required a campos necesarios
          const requiredInputs = fieldsToShow.querySelectorAll('input[name$="_nacimiento"], input[name$="_estudios"], input[name$="_profesional"], input[name$="_vitae"], input[name="especialidad"], input[name="nombre_hijo"], input[name="dni_hijo"], input[name$="_hijo"]');
          requiredInputs.forEach(input => {
            if (input.type === 'file' || input.name === 'especialidad' || input.name === 'nombre_hijo' || input.name === 'dni_hijo') {
              input.setAttribute('required', 'required');
            }
          });
        }
      }
      
      // Ejecutar al cargar la página
      toggleFields();
      
      // Ejecutar cuando cambie la selección
      userTypeRadios.forEach(radio => {
        radio.addEventListener('change', toggleFields);
      });
      
      // Validación de archivos
      document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function() {
          const file = this.files[0];
          if (file) {
            const maxSize = 5 * 1024 * 1024; // 5MB
            const allowedTypes = this.accept.split(',').map(type => type.trim());
            
            if (file.size > maxSize) {
              alert('El archivo es demasiado grande. El tamaño máximo es 5MB.');
              this.value = '';
              return;
            }
            
            const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
            if (!allowedTypes.includes(fileExtension)) {
              alert('Tipo de archivo no permitido. Por favor seleccione un archivo válido.');
              this.value = '';
              return;
            }
          }
        });
      });
      
      // Validación de últimos 4 dígitos de tarjeta
      const tarjetaInput = document.querySelector('input[name="ultimos_digitos_tarjeta"]');
      if (tarjetaInput) {
        tarjetaInput.addEventListener('input', function() {
          // Solo permitir números
          this.value = this.value.replace(/[^0-9]/g, '');
          // Limitar a 4 caracteres
          if (this.value.length > 4) {
            this.value = this.value.slice(0, 4);
          }
        });
      }
      
      // Validación del formulario antes del envío
      document.getElementById('registrationForm').addEventListener('submit', function(e) {
        const selectedType = document.querySelector('input[name="user_type"]:checked').value;
        const terms = document.getElementById('terms');
        
        if (!terms.checked) {
          e.preventDefault();
          alert('Debe aceptar los términos y condiciones.');
          return;
        }
        
        // Validaciones específicas por tipo
        if (selectedType === 'estudiante') {
          const partidaNac = document.querySelector('input[name="partida_nacimiento"]');
          const constancia = document.querySelector('input[name="constancia_estudios"]');
          
          if (!partidaNac.files.length || !constancia.files.length) {
            e.preventDefault();
            alert('Debe subir la partida de nacimiento y constancia de estudios.');
            return;
          }
        } else if (selectedType === 'padre') {
          const nombreHijo = document.querySelector('input[name="nombre_hijo"]');
          const dniHijo = document.querySelector('input[name="dni_hijo"]');
          const partidaHijo = document.querySelector('input[name="partida_nacimiento_hijo"]');
          
          if (!nombreHijo.value || !dniHijo.value || !partidaHijo.files.length) {
            e.preventDefault();
            alert('Debe completar todos los datos del hijo y subir su partida de nacimiento.');
            return;
          }
        } else if (selectedType === 'docente') {
          const especialidad = document.querySelector('input[name="especialidad"]');
          const titulo = document.querySelector('input[name="titulo_profesional"]');
          const cv = document.querySelector('input[name="curriculum_vitae"]');
          
          if (!especialidad.value || !titulo.files.length || !cv.files.length) {
            e.preventDefault();
            alert('Debe completar la especialidad y subir el título profesional y curriculum vitae.');
            return;
          }
        }
      });
    });
  </script>
</html>
