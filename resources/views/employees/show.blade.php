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
                    @foreach ($employee as $empleado)

                    <div class="flex items-center justify-between">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Nombre del Empleado</label>
                            <p class="p-2">{{ $empleado->first_name }} {{ $empleado->second_name }} {{ $empleado->last_name }} {{ $empleado->second_last_name }}</p>
                        </div> 

                        <div>
                            <a href="{{ route('employees.edit', $empleado) }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Editar</a>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Tipo de Documento</label>
                            <p class="p-2">{{ $typeDocument[$empleado->type_document] }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Número de Documento</label>
                            <p class="p-2">{{ $empleado->document }}</p>
                        </div class="py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Mobile</label>
                            <p class="p-2">{{ $empleado->mobile }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Correo Electronico</label>
                            <p class="p-2">{{ $empleado->email }}</p>
                        </div class="py-2">
                    </div>   
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Profesión</label>
                            <p class="p-2">{{ $empleado->profession }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Especialidad</label>
                            <p class="p-2">{{ $empleado->specialty }}</p>
                        </div class="py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Descripción</label>
                            <p class="p-2">{{ $empleado->description }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Firma</label>
                            <img src="{{ asset('storage/' . $empleado->signature) }}" alt="imagenes" width="200">
                            
                            
                            <p class="p-2">{{ $empleado->signature }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Última Actualización</label>
                            <p class="p-2">{{ $empleado->updated_at }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha de Creación</label>
                            <p class="p-2">{{ $empleado->created_at }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Tipo Empleado</label>
                            <p class="p-2">{{ $typeEmployee[$empleado->type_employee] }}</p>
                        </div> 
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Activado</label>
                            <p class="p-2">{{ $activeOptions[$empleado->active] }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-1 gap-4">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">usuario</label>
                            <p class="p-2">{{ $empleado->user->name }}</p>
                        </div> 
                    </div>

                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>