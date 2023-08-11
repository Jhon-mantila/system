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
                    @foreach ($program as $programa)

                    <div class="flex items-center justify-between">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm bg-gray-500/50 p-2">Nombre del Programa</label>
                            <p class="p-2">{{ $programa->name }}</p>
                        </div> 

                        <div>
                            <a href="{{ route('programs.edit', $programa) }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Editar</a>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="py-2 col-span-1">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Código</label>
                            <p class="p-2">{{ $programa->code }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Creditos</label>
                            <p class="p-2">{{ $programa->credits }}</p>
                        </div class="py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Horas</label>
                            <p class="p-2">{{ $programa->hours }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Activado</label>
                            <p class="p-2">{{ $programa->active }}</p>
                        </div class="py-2">
                    </div>    

                    <div class="grid grid-cols-2 gap-4">
                    <div class="py-2">
                        <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Última Actualización</label>
                        <p class="p-2">{{ $programa->updated_at }}</p>
                    </div> 

                    <div class="py-2">
                        <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha de Creación</label>
                        <p class="p-2">{{ $programa->created_at }}</p>
                    </div> 
                    </div>
                    <div class="py-2">
                        <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">usuario</label>
                        <p class="p-2">{{ $programa->user->name }}</p>
                    </div> 

                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>