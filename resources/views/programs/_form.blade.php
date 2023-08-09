@csrf
<label for="" class="uppercase text-gray-700 text-xs">Nombre</label>
<span class="text-xs text-red-600">@error('name') {{ $message }}  @enderror</span>
<input type="text" name="name" class="rounded border-gray-200 w-full mb-4" 
value="{{ old('name', $program->name) }}">

<label for="" class="uppercase text-gray-700 text-xs">Código</label>
<span class="text-xs text-red-600">@error('slug') {{ $message }}  @enderror</span>
<input type="text" name="code" class="rounded border-gray-200 w-full mb-4" 
value="{{ old('code', $program->code) }}">


<div class="flex justify-between items-center">
    <a href="{{ route('programs.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>