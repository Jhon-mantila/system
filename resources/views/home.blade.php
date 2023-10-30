<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

                <form   form action="{{ route('index') }}" method="GET" class="flex-grow">
                    <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}"
                    class="border border-gray-200 rounded py-2 px-4 w-1/2"
                    >
                    <input type="submit" value="Enviar">
                </form>
                @if(request('search'))
                    @if(isset($data) && count($data) > 0)
                        <h2>Resultados:</h2>
                        <ul>
                            @foreach ($data as $datos)
                                <li>{{ $datos->nombre_programa }} - Cédula: {{ $datos->code }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p>No se encontraron personas con esa cédula.</p>
                    @endif
                @endif
</body>
</html>