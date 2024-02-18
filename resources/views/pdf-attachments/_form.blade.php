@csrf
<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Nombre Adjunto</label>
        <span class="text-xs text-red-600">@error('name') {{ $message }}  @enderror</span>
        <input type="text" name="name" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('name', $pdf_attachment->name) }}">
    </div>

</div>
<div class="grid grid-cols-2 gap-4">
    <div class="">
        <label for="" class="uppercase text-gray-700 text-xs">Estudiante</label>
        <span class="text-xs text-red-600">@error('student_id') {{ $message }}  @enderror</span>
        <input type="text" id="studentSearch" name="studentSearch" class="rounded border-gray-200 w-full mb-4" 
        oninput="searchStudents()">
        <input type="hidden" id="selectedStudentId" name="student_id" class="rounded border-gray-200 w-full mb-4" 
        value="{{ old('student_id', $pdf_attachment->student_id) }}">
        <div id="studentSearchResults"></div>
    </div>

    <div class="">
            <label for="" class="uppercase text-gray-700 text-xs">Adjunto</label>
            <span class="text-xs text-red-600">@error('attachments') {{ $message }}  @enderror</span>
            <label class="block">
                <span class="sr-only">Choose profile photo</span>
                <input type="file" class="block w-full text-sm text-slate-500
                file:mr-4 file:py-2 file:px-4
                file:rounded-full file:border-0
                file:text-sm file:font-semibold
                file:bg-violet-50 file:text-violet-700
                hover:file:bg-violet-100
                "
                name="attachments"
                value="{{ old('attachments', $pdf_attachment->attachments) }}"/>
            </label>
    </div>
</div>

<div class="flex justify-between items-center">
    <a href="{{ route('pdf-attachments.index') }}" class="text-indigo-600">Volver</a>
    <input type="submit" value="Enviar" class="bg-gray-800 text-white rouded px-4 py-2">
</div>

@if(!empty($pdf_attachment->attachments))
    <embed src="{{ asset('storage/' . $pdf_attachment->attachments) }}" type="application/pdf" width="100%" height="600px" />
@endif


<script src="{{ asset('js/certificate-form.js') }}"></script>