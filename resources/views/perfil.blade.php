@extends('layout.plantilla')
@section('contenido')
<div class="w-full px-6 mx-auto flex items-center">
    <div class="relative flex flex-col flex-auto min-w-0 p-4 mx-6 overflow-hidden break-words border-0 shadow-blur rounded-2xl bg-white/80 bg-clip-border backdrop-blur-2xl backdrop-saturate-200">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-auto max-w-full px-3">
                <div class="text-base ease-soft-in-out h-18.5 w-18.5 relative inline-flex items-center justify-center rounded-xl text-white transition-all duration-200">
                <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-full shadow-soft-sm rounded-xl" />
                </div>
            </div>
            <div class="flex-none w-auto max-w-full px-3 my-auto">
                <div class="h-full">
                <h5 class="mb-1">{{Auth::user()->name}}</h5>
                <p class="mb-0 font-semibold leading-normal text-sm">{{Auth::user()->role->nombreRol}}</p> <!-- Esto puede hacerse porque el Auth::user() devuelve el usuario autenticado como un objeto User, con todas sus relaciones y atributos -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="w-full p-6 mx-auto">
    <div class="flex flex-wrap -mx-3">
        <div class="relative flex flex-col h-full w-full min-w-0 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white border-b-0 rounded-t-2xl">
            <div class="flex flex-wrap -mx-3">
                <div class="flex items-center w-full max-w-full px-3 shrink-0 md:w-8/12 md:flex-none">
                <h6 class="mb-0">Información de perfil</h6>
                </div>
                <div class="w-full max-w-full px-3 text-right shrink-0 md:w-4/12 md:flex-none">
                <a href="javascript:;" data-target="tooltip_trigger" data-placement="top">
                    <i class="leading-normal fas fa-user-edit text-sm text-slate-400"></i>
                </a>
                <div data-target="tooltip" class="hidden px-2 py-1 text-center text-white bg-black rounded-lg text-sm" role="tooltip">
                    Edit Profile
                    <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                </div>
                </div>
            </div>
            </div>
            <div class="flex-auto p-4">
            <p class="leading-normal text-sm">Hola, soy {{Auth::user()->name}}. Soy un estudiante de la academia pre-universitaria Sunny Class.</p>
            <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                <li class="relative block px-4 py-2 pt-0 pl-0 leading-normal bg-white border-0 rounded-t-lg text-sm text-inherit"><strong class="text-slate-700">Nombre completo:</strong> &nbsp; {{Auth::user()->name}}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">DNI:</strong> &nbsp; {{Auth::user()->dni}}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Correo:</strong> &nbsp; {{Auth::user()->email}}</li>
                <li class="relative block px-4 py-2 pl-0 leading-normal bg-white border-0 border-t-0 text-sm text-inherit"><strong class="text-slate-700">Fecha de nacimiento:</strong> &nbsp; {{ Auth::user()->fechaNacimiento ? Auth::user()->fechaNacimiento->format('d/m/Y') : '' }}</li>
            </ul>
            </div>
        </div>
        </div>
        <div class="flex-none w-full max-w-full px-3 mt-6">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-4 pb-0 mb-0 bg-white rounded-t-2xl">
            <h6 class="mb-1">Projects</h6>
            <p class="leading-normal text-sm">Architects design houses</p>
            </div>
            <div class="flex-auto p-4">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                    <div class="relative">
                    <a class="block shadow-xl rounded-2xl">
                        <img src="../assets/img/home-decor-1.jpg" alt="img-blur-shadow" class="max-w-full shadow-soft-2xl rounded-2xl" />
                    </a>
                    </div>
                    <div class="flex-auto px-1 pt-6">
                    <p class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">Project #2</p>
                    <a href="javascript:;">
                        <h5>Modern</h5>
                    </a>
                    <p class="mb-6 leading-normal text-sm">As Uber works through a huge amount of internal management turmoil.</p>
                    <div class="flex items-center justify-between">
                        <button type="button" class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">View Project</button>
                        <div class="mt-2">
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-1.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Elena Morison
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-2.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Ryan Milly
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-3.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Nick Daniel
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-4.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Peterson
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                    <div class="relative">
                    <a class="block shadow-xl rounded-2xl">
                        <img src="../assets/img/home-decor-2.jpg" alt="img-blur-shadow" class="max-w-full shadow-soft-2xl rounded-xl" />
                    </a>
                    </div>
                    <div class="flex-auto px-1 pt-6">
                    <p class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">Project #1</p>
                    <a href="javascript:;">
                        <h5>Scandinavian</h5>
                    </a>
                    <p class="mb-6 leading-normal text-sm">Music is something that every person has his or her own specific opinion about.</p>
                    <div class="flex items-center justify-between">
                        <button type="button" class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">View Project</button>
                        <div class="mt-2">
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-3.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Nick Daniel
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-4.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Peterson
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-1.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Elena Morison
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-2.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Ryan Milly
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                <div class="relative flex flex-col min-w-0 break-words bg-transparent border-0 shadow-none rounded-2xl bg-clip-border">
                    <div class="relative">
                    <a class="block shadow-xl rounded-2xl">
                        <img src="../assets/img/home-decor-3.jpg" alt="img-blur-shadow" class="max-w-full shadow-soft-2xl rounded-2xl" />
                    </a>
                    </div>
                    <div class="flex-auto px-1 pt-6">
                    <p class="relative z-10 mb-2 leading-normal text-transparent bg-gradient-to-tl from-gray-900 to-slate-800 text-sm bg-clip-text">Project #3</p>
                    <a href="javascript:;">
                        <h5>Minimalist</h5>
                    </a>
                    <p class="mb-6 leading-normal text-sm">Different people have different taste, and various types of music.</p>
                    <div class="flex items-center justify-between">
                        <button type="button" class="inline-block px-8 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro ease-soft-in text-xs hover:scale-102 active:shadow-soft-xs tracking-tight-soft border-fuchsia-500 text-fuchsia-500 hover:border-fuchsia-500 hover:bg-transparent hover:text-fuchsia-500 hover:opacity-75 hover:shadow-none active:bg-fuchsia-500 active:text-white active:hover:bg-transparent active:hover:text-fuchsia-500">View Project</button>
                        <div class="mt-2">
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-4.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Peterson
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-3.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Nick Daniel
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-2.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Ryan Milly
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        <a href="javascript:;" class="relative z-20 inline-flex items-center justify-center w-6 h-6 -ml-4 text-white transition-all duration-200 border-2 border-white border-solid ease-soft-in-out text-xs rounded-circle hover:z-30" data-target="tooltip_trigger" data-placement="bottom">
                            <img class="w-full rounded-circle" alt="Image placeholder" src="../assets/img/team-1.jpg" />
                        </a>
                        <div data-target="tooltip" class="hidden px-2 py-1 text-white bg-black rounded-lg text-sm" role="tooltip">
                            Elena Morison
                            <div class="invisible absolute h-2 w-2 bg-inherit before:visible before:absolute before:h-2 before:w-2 before:rotate-45 before:bg-inherit before:content-['']" data-popper-arrow></div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <div class="w-full max-w-full px-3 mb-6 md:w-6/12 md:flex-none xl:mb-0 xl:w-3/12">
                <div class="relative flex flex-col h-full min-w-0 break-words bg-transparent border border-solid shadow-none rounded-2xl border-slate-100 bg-clip-border">
                    <div class="flex flex-col justify-center flex-auto p-6 text-center">
                    <a href="javascript:;">
                        <i class="mb-4 fa fa-plus text-slate-400"></i>
                        <h5 class="text-slate-400">New project</h5>
                    </a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

@endsection