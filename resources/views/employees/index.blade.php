<x-app-layout>
    <x-slot name="header">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Empleados:') }} {{ $employees->total() }}
                    </h2>
                    <form action="{{ route('employees.index') }}" method="GET" class="flex-grow">

                        <label class="relative block">
                            <span class="sr-only">Search</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4">
            
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-4 w-4 fill-slate-300" viewBox="0 0 20 20" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>

                            </span>
                            <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-96 border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Buscar por nombre de empleados o ducumento..." value="{{ request('search') }}"  type="text" name="search"/>
                        </label>
                        </form>
                    </div>
                <div>
                    <a href="{{ route('employees.create') }}" class="text-ms bg-gray-800 text-white  px-4 py-2">Crear</a>
                </div>
            </div>
            
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Listado de Empleados") }}
                </div>

                <table class="mb-4">
                    <tr class="border-b border-gray-200 text-sm">
                        <td class="px-6 py-4">Nombre Empleados</td>
                        <td class="px-6 py-4">No. Documento</td>
                        <td class="px-6 py-4">Tipo Empleado</td>
                        <td class="px-6 py-4">Celular</td>
                        <td class="px-6 py-4">Última Actualización</td>
                        <td class="px-6 py-4">Fecha Creación</td>
                        <td class="px-6 py-4"></td>
                        <!-- <td class="px-6 py-4"></td> -->
                    </tr>
                    @foreach ($employees as $employee)
                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-6 py-4"><a class="text-blue-600" href="{{ route('employees.show', $employee) }}">{{ $employee->first_name }} {{ $employee->second_name }} {{ $employee->last_name }} {{ $employee->second_last_name }}</a></td>
                            <td class="px-6 py-4">{{ $employee->document }}</td>
                            <td class="px-6 py-4">{{ $typeEmployee[$employee->type_employee] }}</td>
                            <td class="px-6 py-4">{{ $employee->mobile }}</td>
                            <td class="px-6 py-4">{{ $employee->updated_at }}</td>
                            <td class="px-6 py-4">{{ $employee->created_at }}</td>
        
                            <td class="px-6 py-4">
                                <a href="{{ route('employees.edit', $employee) }}" class="text-indigo-600">Editar</a> 
                            </td>
                            <!-- <td class="px-6 py-4">
                                <form action="{{ route('employees.destroy', $employee) }}" method="POST"> -->
                                    <!-- Crea una encriptación un token en value -->
                                    <!-- @csrf
                                    @method('DELETE')

                                    <input 
                                        type="submit" 
                                        value="Eliminar"
                                        class="bg-gray-800 text-white px-4 py-2"
                                        onclick="return confirm('Deseas Eliminar?')">
                                </form>
                            </td> -->
                        </tr>
                    @endforeach
                </table>
               
                {{ $employees->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>