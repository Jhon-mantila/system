<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vista Registro') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @foreach ($course as $cursos)

                    <div class="flex items-center justify-between">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm bg-gray-500/50 p-2">Nombre del Curso</label>
                            <p class="p-2">{{ $cursos->name }}</p>
                        </div> 

                        <div>
                            <a href="{{ route('courses.edit', $cursos) }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Editar</a>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="py-2 col-span-1">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Código Norma</label>
                            <p class="p-2">{{ $cursos->code }}</p>
                        </div>

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Código Ocupación</label>
                            <p class="p-2">{{ $cursos->code_ocupation }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Horas</label>
                            <p class="p-2">{{ $cursos->hours }}</p>
                        </div>

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Creditos</label>
                            <p class="p-2">{{ $cursos->credits }}</p>
                        </div>
                    </div>    

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Última Actualización</label>
                            <p class="p-2">{{ $cursos->updated_at }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha de Creación</label>
                            <p class="p-2">{{ $cursos->created_at }}</p>
                        </div> 
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                                <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Activado</label>
                                <p class="p-2">{{ $activeOptions[$cursos->active] }}</p>
                            </div>
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">usuario</label>
                            <p class="p-2">{{ $cursos->user->name }}</p>
                        </div> 
                    </div>
                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>