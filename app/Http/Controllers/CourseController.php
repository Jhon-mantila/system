<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\Services\DropdownService;

class CourseController extends Controller
{
    //
    protected $dropdownService;
    
    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }
    public function index(Request $request){

        $search =  $request->search;

        $courses = Course::where([
            ['name', 'LIKE', "%{$search}%"],
            //['active', '<>', 0]
        ])->latest()->paginate();

        return view('courses.index',[
            'courses' => $courses
        ]);
    }

    public function show(Course $course){
        
        $activeOptions = $this->dropdownService->getActive();

        $course = Course::with('user')->get()->where('id', '=', $course->id);
        // foreach ($program as $programs) {
        //     echo $programs->name . ' ' . $programs->code . ' ' . $programs->credits . ' ' . $programs->hours . ' ' . $programs->active . ' ' . $programs->user->name;
        // }
        //dd($program);
        return view('courses.show', [
            'course' => $course,
            'activeOptions' => $activeOptions
        ]);
    }

    public function create(Course $course){
        
        $activeOptions = $this->dropdownService->getActive();

        return view ('courses.create',[
            'course' => $course,
            'activeOptions' => $activeOptions
        ]);
    }

    public function store(Request $request){
        //dd($request);

        $request->validate([
            'code' => 'required|unique:courses,code',
            'name'  => 'required',
            'active'  => 'required',
        ],[
            'code.required' => 'El campo código es requerido',
            'code.unique'    => 'El código debe ser unico (Ya existe este código)',
            'name.required'  => 'El campo nombre del programa es requerido',
            'active.required'    => 'Este campo es requerido',
        ]);

        $course = $request->user()->courses()->create([
            'id' => (String) Uuid::uuid4(),
            'code' => $request->code,
            'name' => $request->name,
            'credits' => $request->credits,
            'hours' => $request->hours,
            'active' => $request->active,
            
        ]);

        return redirect()->route('courses.edit', $course);
    }

    public function edit(Course $course){

        $activeOptions = $this->dropdownService->getActive();

        return view('courses.edit', [
            'course' => $course,
            'activeOptions' => $activeOptions
        ]);
    }

    public function update(Request $request, Course $course){

        $request->validate([
            'code' => 'required|unique:courses,code,' . $course->id,
            'name'  => 'required',
            'active'  => 'required',
        ],[
            'code.required' => 'El campo código es requerido',
            'code.unique'    => 'El código debe ser unico (Ya existe este código)',
            'name.required'  => 'El campo nombre del programa es requerido',
            'active.required'    => 'Este campo es requerido',
        ]);

        $course->update([
            'code' => $request->code,
            'name' => $request->name,
            'credits' => $request->credits,
            'hours' => $request->hours,
            'active' => $request->active,
            'updated_at' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->route('courses.edit', $course);
    }

    public function destroy(Course $course){
        //dd($course);
        $course->delete();

        return back();
    }
}
