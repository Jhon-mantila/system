@csrf

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Primer Nombre</label>
        <span class="text-xs text-red-600">@error('first_name') {{ $message }}  @enderror</span>
        <input type="text" name="first_name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('first_name', $employee->first_name) }}">
    </div>

    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Segundo Nombre</label>
        <span class="text-xs text-red-600">@error('second_name') {{ $message }}  @enderror</span>
        <input type="text" name="second_name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('second_name', $employee->second_name) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Primer Apellido</label>
        <span class="text-xs text-red-600">@error('last_name') {{ $message }}  @enderror</span>
        <input type="text" name="last_name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('last_name', $employee->last_name) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Segundo Apellido</label>
            <span class="text-xs text-red-600">@error('second_last_name') {{ $message }}  @enderror</span>
            <input type="text" name="second_last_name" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('second_last_name', $employee->second_last_name) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">    
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Tipo de Documento</label>
            <span class="text-xs text-red-600">@error('type_document') {{ $message }}  @enderror</span>
            <input type="number" name="type_document" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('type_document', $employee->type_document) }}">
        </div>
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Número de Documento</label>
            <span class="text-xs text-red-600">@error('document') {{ $message }}  @enderror</span>
            <input type="number" name="document" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('document', $employee->document) }}">
        </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Mobil</label>
        <span class="text-xs text-red-600">@error('mobile') {{ $message }}  @enderror</span>
        <input type="text" name="mobile" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('mobile', $employee->mobile) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Email</label>
            <span class="text-xs text-red-600">@error('email') {{ $message }}  @enderror</span>
            <input type="email" name="email" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('email', $employee->email) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Profesión</label>
        <span class="text-xs text-red-600">@error('profession') {{ $message }}  @enderror</span>
        <input type="text" name="profession" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('profession', $employee->profession) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Especialidad</label>
            <span class="text-xs text-red-600">@error('specialty') {{ $message }}  @enderror</span>
            <input type="text" name="specialty" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('specialty', $employee->specialty) }}">
    </div>
</div>


<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Descripción</label>
        <span class="text-xs text-red-600">@error('description') {{ $message }}  @enderror</span>
        <textarea name="description" id="" cols="10" rows="5" class="rounded border-gray-200 w-full mb-4">
        {{ old('description', $employee->description) }}
        </textarea>
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Firma</label>
            <span class="text-xs text-red-600">@error('signature') {{ $message }}  @enderror</span>
            <img src="{{ asset('storage/' . $employee->signature) }}" alt="" width="200">
            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100
                "
                name="signature"
                value="{{ old('signature', $employee->signature) }}"/>
            </label>
            <!-- <input type="text" name="signature" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('signature', $employee->signature) }}"> -->
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
<div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Tipo empleado</label>
            <span class="text-xs text-red-600">@error('type_employee') {{ $message }}  @enderror</span>
            <input type="text" name="type_employee" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('type_employee', $employee->type_employee) }}">
    </div>
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Activo</label>
        <span class="text-xs text-red-600">@error('active') {{ $message }}  @enderror</span>
        <input type="number" name="active" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('active', $employee->active) }}">
    </div>
</div>

<div class="flex justify-between items-center">
    <a href="{{ route('employees.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>