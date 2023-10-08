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
                    @foreach ($student as $estudiante)

                    <div class="flex items-center justify-between">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Nombre del Estudiante</label>
                            <p class="p-2">{{ $estudiante->first_name }} {{ $estudiante->second_name }} {{ $estudiante->last_name }} {{ $estudiante->second_last_name }}</p>
                        </div> 

                        <div>
                            <a href="{{ route('students.edit', $estudiante) }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Editar</a>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Tipo de Documento</label>
                            <p class="p-2">{{ $typeDocument[$estudiante->type_document] }}</p>
                        </div>

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Número de Documento</label>
                            <p class="p-2">{{ $estudiante->document }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Ciudad</label>
                            <p class="p-2">{{ $estudiante->city }}</p>
                        </div>

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Mobile</label>
                            <p class="p-2">{{ $estudiante->mobile }}</p>
                        </div>
                    </div> 

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Correo Electronico</label>
                            <p class="p-2">{{ $estudiante->email }}</p>
                        </div>

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Activado</label>
                            <p class="p-2">{{ $activeOptions[$estudiante->active] }}</p>
                        </div> 
                    </div>    

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Última Actualización</label>
                            <p class="p-2">{{ $estudiante->updated_at }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha de Creación</label>
                            <p class="p-2">{{ $estudiante->created_at }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-2 gap-4">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">usuario</label>
                            <p class="p-2">{{ $estudiante->user->name }}</p>
                        </div> 
                    </div>

                    <div class="py-2">  
                        <input type="text" value="{{ $estudiante->id }}" id="id_studiante" class="hidden">                          
                    </div> 

                    @endforeach    
                </div>
            </div>
        </div>
    </div>

    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto p-6 relative"> <!-- Agrega la clase "relative" al contenedor -->
                        <h2 class="text-2xl font-semibold mb-4">Programas Certificados</h2>
                        <div id="content-section">
                            <!-- Aquí se cargará la información relacionada -->
                        </div>
                        <div>
                        <div class="flex items-baseline">
                            <div id="pagination" class="mt-4 m-2 flex"> <!-- Agrega la clase "absolute" a la paginación -->

                            </div>
                            <div class="flex m-2">
                                <!-- Previous Button -->
                                <a href="#" class="flex items-center justify-center px-3 h-8 mr-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" id="previous-button">
                                    <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
                                    </svg>
                                    Previous
                                </a>
                                <a href="#" class="flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white" id="next-button">
                                    Next
                                    <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


<script src="{{ asset('js/certificate-students.js') }}"></script>