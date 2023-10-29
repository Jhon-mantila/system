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
                    @foreach ($certificate as $certificado)

                    <div class="flex items-center justify-between">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Nombre del Programa</label>
                            <p class="p-2">{{ $certificado->program->name }}</p>
                        </div> 

                        <div>
                            <a href="{{ route('certificates.edit', $certificado) }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Editar</a>
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Nombre del Estudiante</label>
                            <p class="p-2">{{ $certificado->student->first_name }} {{ $certificado->student->second_name }} {{ $certificado->student->last_name }} {{ $certificado->student->second_last_name }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Certificador</label>
                            <p class="p-2">{{ $certificado->employee->first_name }} {{ $certificado->employee->second_name }} {{ $certificado->employee->last_name }} {{ $certificado->employee->second_last_name }}</p>
                        </div class="py-2">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha Inicial</label>
                            <p class="p-2">{{ $certificado->date_start }}</p>
                        </div class="py-2">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha Final</label>
                            <p class="p-2">{{ $certificado->date_end }}</p>
                        </div class="py-2">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Título</label>
                            <p class="p-2">{{ $certificado->title }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Tipo de Código</label>
                            <p class="p-2">{{ $typeCode[$certificado->type_code] }}</p>
                        </div> 
                        </div> 

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Referencias</label>
                            <p class="p-2">{{ $certificado->references }}</p>
                        </div> 
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Proceso</label>
                            <p class="p-2">{{ $certificado->process }}</p>
                        </div> 
                    </div>    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Acreditado</label>
                            <p class="p-2">{{ $accreditedOptions[$certificado->accredited] }}</p>
                        </div> 
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Notificado</label>
                            <p class="p-2">{{ $certificado->notified }}</p>
                        </div> 

                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Tipo Certificado</label>
                            <p class="p-2">{{ $typeCertificate[$certificado->type_certificate] }}</p>
                        </div>
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">usuario</label>
                            <p class="p-2">{{ $certificado->user->name }}</p>
                        </div> 
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Última Actualización</label>
                            <p class="p-2">{{ $certificado->updated_at }}</p>
                        </div> 

                        <div class="py-2">
                            <label for="" class="uppercase text-gray-700 text-xm block bg-gray-500/50 p-2">Fecha de Creación</label>
                            <p class="p-2">{{ $certificado->created_at }}</p>
                        </div> 
                    </div>

                    @endforeach    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>