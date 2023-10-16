@csrf
<div class="grid grid-cols-2 gap-4">
<div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Curso</label>
        <span class="text-xs text-red-600">@error('course_id') {{ $message }}  @enderror</span>
        <input type="text" id="courseSearch" name="courseSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchCourse()">
        <input type="hidden" id="selectedCourseId" name="course_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('course_id', $certificate->course_id) }}">
        <div id="courseSearchResults"></div>
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
    <a href="{{ route('certificates-courses.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>

<script src="{{ asset('js/certificate-form.js') }}"></script>