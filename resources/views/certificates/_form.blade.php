@csrf
        
    <!-- <label for="programSearch">Buscar Programa:</label>
    <input type="text" id="programSearch" name="programSearch" oninput="searchPrograms()">
    <input type="text" id="selectedProgramId" name="selectedProgramId">
    <div id="programSearchResults"></div> -->

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Programa</label>
        <span class="text-xs text-red-600">@error('program_id') {{ $message }}  @enderror</span>
        <input type="text" id="programSearch" name="programSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchPrograms()">
        <input type="text" id="selectedProgramId" name="program_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('program_id', $certificate->program_id) }}">
        <div id="programSearchResults"></div>
    </div>

    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Estudiante</label>
        <span class="text-xs text-red-600">@error('student_id') {{ $message }}  @enderror</span>
        <input type="text" id="studentSearch" name="studentSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchStudents()">
        <input type="text" id="selectedStudentId" name="student_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('student_id', $certificate->student_id) }}">
        <div id="studentSearchResults"></div>
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Empleado</label>
        <span class="text-xs text-red-600">@error('employee_id') {{ $message }}  @enderror</span>
        <input type="text" name="employee_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('employee_id', $certificate->employee_id) }}">
    </div>
    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Empresa</label>
            <span class="text-xs text-red-600">@error('company_id') {{ $message }}  @enderror</span>
            <input type="text" name="company_id" class="rounded border-gray-200 w-full mb-4" 
            value="{{ old('company_id', $certificate->company_id) }}">
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
        <label for="" class="uppercase text-gray-700 text-xs">Acreditado</label>
        <span class="text-xs text-red-600">@error('accredited') {{ $message }}  @enderror</span>
        <input type="text" name="accredited" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('accredited', $certificate->accredited) }}">
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