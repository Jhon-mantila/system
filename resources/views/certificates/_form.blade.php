@csrf
<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Programa</label>
        <span class="text-xs text-red-600">@error('program_id') {{ $message }}  @enderror</span>
        <input type="text" id="programSearch" name="programSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchPrograms()">
        <input type="hidden" id="selectedProgramId" name="program_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('program_id', $certificate->program_id) }}">
        <div id="programSearchResults"></div>
    </div>

    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Estudiante</label>
        <span class="text-xs text-red-600">@error('student_id') {{ $message }}  @enderror</span>
        <input type="text" id="studentSearch" name="studentSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchStudents()">
        <input type="hidden" id="selectedStudentId" name="student_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('student_id', $certificate->student_id) }}">
        <div id="studentSearchResults"></div>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Empleado</label>
        <span class="text-xs text-red-600">@error('employee_id') {{ $message }}  @enderror</span>
        <input type="text" id="employeeSearch" name="employeeSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchEmployees()">
        <input type="hidden" id="selectedEmployeeId" name="employee_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('employee_id', $certificate->employee_id) }}">
        <div id="employeeSearchResults"></div>
    </div>
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Tipo Certificado</label>
        <span class="text-xs text-red-600">@error('type_certificate') {{ $message }}  @enderror</span>
        <select name="type_certificate" id="" class="rounded border-gray-200 w-full mb-4">
                    @foreach ($typeCertificate as $key => $value)
                        <option value="{{ $key }}"
                        @if (old('type_certificate', $certificate->type_certificate) === $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
        </select>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Referencias</label>
            <span class="text-xs text-red-600">@error('references') {{ $message }}  @enderror</span>
            <input type="text" name="references" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('references', $certificate->references) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Proceso</label>
            <span class="text-xs text-red-600">@error('process') {{ $message }}  @enderror</span>
            <input type="text" name="process" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('process', $certificate->process) }}">
    </div>
</div>

<div class="grid grid-cols-2 gap-4">    
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Fecha Inicial</label>
            <span class="text-xs text-red-600">@error('date_start') {{ $message }}  @enderror</span>
            <input type="date" name="date_start" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('date_start', $certificate->date_start) }}">
        </div>
        <div class="">
            <label for="" class="uppercase text-gray-700 text-xs"></label>Fecha Final</label>
            <span class="text-xs text-red-600">@error('date_end') {{ $message }}  @enderror</span>
            <input type="date" name="date_end" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('date_end', $certificate->date_end) }}">
        </div>
</div>
<div class="grid grid-cols-2 gap-4"> 
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Tipo Código</label>
        <span class="text-xs text-red-600">@error('type_code') {{ $message }}  @enderror</span>
        <select name="type_code" id="" class="rounded border-gray-200 w-full mb-4">
                    @foreach ($typeCode as $key => $value)
                        <option value="{{ $key }}"
                        @if (old('type_code', $certificate->type_code) === $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
        </select>
    </div>   
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Título</label>
            <span class="text-xs text-red-600">@error('title') {{ $message }}  @enderror</span>
            <input type="text" name="title" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('title', $certificate->title) }}">
    </div>

</div>
<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Acreditado</label>
        <span class="text-xs text-red-600">@error('accredited') {{ $message }}  @enderror</span>
        <select name="accredited" id="" class="rounded border-gray-200 w-full mb-4">
                    @foreach ($accreditedOptions as $key => $value)
                        <option value="{{ $key }}"
                        @if (old('accredited', $certificate->accredited) === $key)
                            selected
                        @endif
                        >{{ $value }}</option>
                    @endforeach
        </select>
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Notificado</label>
            <span class="text-xs text-red-600">@error('notified') {{ $message }}  @enderror</span>
            <input type="text" name="notified" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('notified', $certificate->notified) }}">
    </div>
</div>

<div class="flex justify-between items-center">
    <a href="{{ route('certificates.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>

<script src="{{ asset('js/certificate-form.js') }}"></script>