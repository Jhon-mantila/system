@csrf

<div class="grid grid-cols-1 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Nombre</label>
        <span class="text-xs text-red-600">@error('name') {{ $message }}  @enderror</span>
        <input type="text" name="name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('name', $course->name) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Código</label>
        <span class="text-xs text-red-600">@error('code') {{ $message }}  @enderror</span>
        <input type="text" name="code" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('code', $course->code) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Creditos</label>
            <span class="text-xs text-red-600">@error('credits') {{ $message }}  @enderror</span>
            <input type="number" name="credits" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('credits', $course->credits) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">

        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Cantidad de Horas</label>
            <span class="text-xs text-red-600">@error('hours') {{ $message }}  @enderror</span>
            <input type="number" name="hours" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('hours', $course->hours) }}">
        </div>
        
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Activado</label>
            <span class="text-xs text-red-600">@error('active') {{ $message }}  @enderror</span>
            <select name="active" id="" class="rounded border-gray-200 w-full mb-4">
                    @foreach ($activeOptions as $key => $value)
                        <option value="{{ $key }}"
                        @if (old('active', $course->active) === $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
            </select>    
        </div>
</div>


<div class="flex justify-between items-center">
    <a href="{{ route('courses.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>