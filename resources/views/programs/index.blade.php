<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center flex-grow gap-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Programas') }}
                </h2>

                <form action="{{ route('programs.index') }}" method="GET" class="flex-grow">
                    <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}"
                    class="border border-gray-200 rounded py-2 px-4 w-1/2"
                    >
                </form>
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Listado de Programas") }}
                </div>

                <table class="mb-4">
                    <tr class="border-b border-gray-200 text-sm">
                        <td class="px-6 py-4">Nombre Programa</td>
                        <td class="px-6 py-4">Código Programa</td>
                        <td class="px-6 py-4"></td>
                        <td class="px-6 py-4"></td>
                    </tr>
                    @foreach ($programs as $program)
                        <tr class="border-b border-gray-200 text-sm">
                            <td class="px-6 py-4">{{ $program->name }}</td>
                            <td class="px-6 py-4">{{ $program->code }}</td>
        
                            <td class="px-6 py-4">
                                <a href="{{ route('programs.edit', $program) }}" class="text-indigo-600">Editar</a> 
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('programs.destroy', $program) }}" method="POST">
                                    <!-- Crea una encriptación un token en value -->
                                    @csrf
                                    @method('DELETE')

                                    <input 
                                        type="submit" 
                                        value="Eliminar"
                                        class="bg-gray-800 text-white rounded px-4 py-2"
                                        onclick="return confirm('Deseas Eliminar?')">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $programs->links() }}
            </div>
        </div>
    </div>
</x-app-layout>