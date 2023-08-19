<x-app-layout>
    <x-slot name="header">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Empresa') }}
                    </h2>
                    </div>
                <div>
                    <a href="{{ route('companies.edit', '6cbe7498-3b65-49a6-ad46-7ea9f44bf62d') }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Editar</a>
                </div>
            </div>
            
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                    @foreach ($companies as $empresa)

                    <div class="flex items-center justify-between">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Nombre de la Empresa</label>
                            <p class="p-2">{{ $empresa->name }}</p>
                        </div> 

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Nit</label>
                            <p class="p-2">{{ $empresa->nit }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Sitio Web</label>
                            <p class="p-2">{{ $empresa->web }}</p>
                        </div class="py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Dirección</label>
                            <p class="p-2">{{ $empresa->direction }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Ciudad</label>
                            <p class="p-2">{{ $empresa->city }}</p>
                        </div class="py-2">
                    </div>   
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Mobile</label>
                            <p class="p-2">{{ $empresa->mobile }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Teléfono</label>
                            <p class="p-2">{{ $empresa->phone }}</p>
                        </div class="py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Agente</label>
                            <p class="p-2">{{ $empresa->agent }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Logo</label>
                            <img src="{{ asset('storage/' . $empresa->logo) }}" alt="logo" width="200">

                            <p class="p-2">{{ $empresa->logo }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Última Actualización</label>
                            <p class="p-2">{{ $empresa->updated_at }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha de Creación</label>
                            <p class="p-2">{{ $empresa->created_at }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-2 gap-4"> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">usuario</label>
                            <p class="p-2">{{ $empresa->user->name }}</p>
                        </div> 
                    </div>

                    @endforeach    
                </div>


            </div>
        </div>
    </div>
</x-app-layout>