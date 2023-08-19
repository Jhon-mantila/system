@csrf

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Nombre de la Empresa</label>
        <span class="text-xs text-red-600">@error('name') {{ $message }}  @enderror</span>
        <input type="text" name="name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('name', $company->name) }}">
    </div>

    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Nit</label>
        <span class="text-xs text-red-600">@error('nit') {{ $message }}  @enderror</span>
        <input type="text" name="nit" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('nit', $company->nit) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Sitio Web</label>
        <span class="text-xs text-red-600">@error('web') {{ $message }}  @enderror</span>
        <input type="text" name="web" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('web', $company->web) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Dirección</label>
            <span class="text-xs text-red-600">@error('direction') {{ $message }}  @enderror</span>
            <input type="text" name="direction" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('direction', $company->direction) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">    
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Ciudad</label>
            <span class="text-xs text-red-600">@error('city') {{ $message }}  @enderror</span>
            <input type="text" name="type_document" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('city', $company->city) }}">
        </div>
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Mobil</label>
            <span class="text-xs text-red-600">@error('mobile') {{ $message }}  @enderror</span>
            <input type="text" name="mobile" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('mobile', $company->mobile) }}">
        </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Teléfono</label>
        <span class="text-xs text-red-600">@error('phone') {{ $message }}  @enderror</span>
        <input type="text" name="phone" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('phone', $company->phone) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Agente</label>
            <span class="text-xs text-red-600">@error('agent') {{ $message }}  @enderror</span>
            <input type="text" name="agent" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('agent', $company->agent) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">

    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Logo</label>
            <span class="text-xs text-red-600">@error('logo') {{ $message }}  @enderror</span>
            <img src="{{ asset('storage/' . $company->logo) }}" alt="" width="200">
            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100
                "
                name="logo"
                value="{{ old('logo', $company->logo) }}"/>
            </label>
            <!-- <input type="text" name="logo" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('logo', $company->logo) }}"> -->
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    
<!-- <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Tipo empleado</label>
            <span class="text-xs text-red-600">@error('type_employee') {{ $message }}  @enderror</span>
            <input type="text" name="type_employee" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('type_employee', $company->type_employee) }}">
    </div> -->

</div>

<div class="flex justify-between items-center">
    <a href="{{ route('companies.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>