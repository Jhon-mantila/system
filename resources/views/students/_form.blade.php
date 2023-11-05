@csrf

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Primer Nombre</label>
        <span class="text-xs text-red-600">@error('first_name') {{ $message }}  @enderror</span>
        <input type="text" name="first_name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('first_name', $student->first_name) }}">
    </div>

    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Segundo Nombre</label>
        <span class="text-xs text-red-600">@error('second_name') {{ $message }}  @enderror</span>
        <input type="text" name="second_name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('second_name', $student->second_name) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Primer Apellido</label>
        <span class="text-xs text-red-600">@error('last_name') {{ $message }}  @enderror</span>
        <input type="text" name="last_name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('last_name', $student->last_name) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Segundo Apellido</label>
            <span class="text-xs text-red-600">@error('second_last_name') {{ $message }}  @enderror</span>
            <input type="text" name="second_last_name" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('second_last_name', $student->second_last_name) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">    
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Tipo de Documento</label>
            <span class="text-xs text-red-600">@error('type_document') {{ $message }}  @enderror</span>
            <select name="type_document" id="" class="rounded border-gray-200 w-full mb-4">
                    @foreach ($typeDocument as $key => $value)
                        <option value="{{ $key }}"
                        @if (old('type_document', $student->type_document) === $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
            </select> 
        </div>
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Número de Documento</label>
            <span class="text-xs text-red-600">@error('document') {{ $message }}  @enderror</span>
            <input type="number" name="document" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('document', $student->document) }}">
        </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Teléfono</label>
            <span class="text-xs text-red-600">@error('phone') {{ $message }}  @enderror</span>
            <input type="text" name="phone" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('phone', $student->phone) }}">
    </div>
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Teléfono móvil</label>
        <span class="text-xs text-red-600">@error('mobile') {{ $message }}  @enderror</span>
        <input type="text" name="mobile" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('mobile', $student->mobile) }}">
    </div>
</div>
<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Género</label>
        <span class="text-xs text-red-600">@error('gender') {{ $message }}  @enderror</span>
        <select name="gender" id="" class="rounded border-gray-200 w-full mb-4">
                        @foreach ($genderOptions as $key => $value)
                            <option value="{{ $key }}"
                            @if (old('gender', $student->gender) === $key)
                                selected
                            @endif
                            >{{ $value }}</option>
                        @endforeach
        </select> 
    </div>
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Activo</label>
        <span class="text-xs text-red-600">@error('active') {{ $message }}  @enderror</span>
        <select name="active" id="" class="rounded border-gray-200 w-full mb-4">
                        @foreach ($activeOptions as $key => $value)
                            <option value="{{ $key }}"
                            @if (old('active', $student->active) === $key)
                                selected
                            @endif
                            >{{ $value }}</option>
                        @endforeach
        </select> 
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Ciudad</label>
            <span class="text-xs text-red-600">@error('city') {{ $message }}  @enderror</span>
            <input type="text" name="city" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('city', $student->city) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Email</label>
            <span class="text-xs text-red-600">@error('email') {{ $message }}  @enderror</span>
            <input type="email" name="email" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('email', $student->email) }}">
    </div>
</div>



<div class="flex justify-between items-center">
    <a href="{{ route('students.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>