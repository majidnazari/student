<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource (Search + List).
     * GET /api/v1/students
     */
    public function index(Request $request)
    {
        $perPage = (int) $request->integer('per_page', 20);
        $perPage = max(1, min($perPage, 100));

        $students = Student::query()
            ->with(['college', 'educationGroup', 'major'])
            ->when(
                $request->filled('student_number'),
                fn($q) => $q->where('student_number', 'like', '%' . $request->string('student_number') . '%')
            )
            ->when(
                $request->filled('first_name'),
                fn($q) => $q->where('first_name', 'like', '%' . $request->string('first_name') . '%')
            )
            ->when(
                $request->filled('last_name'),
                fn($q) => $q->where('last_name', 'like', '%' . $request->string('last_name') . '%')
            )
            ->when(
                $request->filled('college_id'),
                fn($q) => $q->where('college_id', (int) $request->input('college_id'))
            )
            ->when(
                $request->filled('education_group_id'),
                fn($q) => $q->where('education_group_id', (int) $request->input('education_group_id'))
            )
            ->when(
                $request->filled('major_id'),
                fn($q) => $q->where('major_id', (int) $request->input('major_id'))
            )
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate($perPage);

        return response()->json($students);
    }

    /**
     * Show the form for creating a new resource.
     * (Not used in API)
     */
    public function create()
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/v1/students
     */
    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();

        // photo را از داده‌ها جدا می‌کنیم (چون فایل هست نه string)
        unset($data['photo']);

        $student = Student::create($data);

        // اگر عکس داشت:
        if ($request->hasFile('photo')) {
            $photoPath = $this->storeStudentPhoto($student, $request->file('photo'));
            $student->update(['photo_path' => $photoPath]);
        }

        $student->load(['college', 'educationGroup', 'major']);

        return response()->json($student, 201);
    }

    /**
     * Display the specified resource (Full report with terms).
     * GET /api/v1/students/{student}
     */
    public function show(Student $student)
    {
        $student->load([
            'college',
            'educationGroup',
            'major',
            'terms' => fn($q) => $q->orderBy('term_number')->with([
                'results' => fn($r) => $r->with('lesson')->orderBy('id'),
            ]),
        ]);

        return response()->json($student);
    }

    /**
     * Show the form for editing the specified resource.
     * (Not used in API)
     */
    public function edit(Student $student)
    {
        return response()->json(['message' => 'Not implemented'], 501);
    }

    /**
     * Update the specified resource in storage.
     * PUT /api/v1/students/{student}
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $data = $request->validated();
        unset($data['photo']);

        $student->update($data);

        // اگر عکس جدید ارسال شد => overwrite
        if ($request->hasFile('photo')) {
            $photoPath = $this->storeStudentPhoto($student->fresh(), $request->file('photo'));
            $student->update(['photo_path' => $photoPath]);
        }

        $student->load(['college', 'educationGroup', 'major']);

        return response()->json($student);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/v1/students/{student}
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json(['message' => 'دانشجو حذف شد.']);
    }

    /**
     * ذخیره عکس دانشجو با نام ثابت (برای overwrite)
     * خروجی: مسیر قابل نمایش از public مثل /storage/...
     */
    private function storeStudentPhoto(Student $student, \Illuminate\Http\UploadedFile $file): string
    {
        // نام فایل بر اساس شماره + نام (برای خوانایی)
        $base = $student->student_number . '-' . $student->first_name . '-' . $student->last_name;
        $safeBase = Str::slug($base); // تبدیل به safe string
        $ext = strtolower($file->getClientOriginalExtension() ?: 'jpg');

        // مسیر ثابت => overwrite همیشه
        $relativePath = "students/photos/{$safeBase}.{$ext}";

        // اگر قبلاً عکسی بوده، فایل قبلی را حذف کن (حتی اگر ext فرق کند)
        // (اگر نمی‌خوای این بخش را هم میشه حذف کرد)
        if ($student->photo_path) {
            $old = str_replace('/storage/', '', $student->photo_path);
            Storage::disk('public')->delete($old);
        }

        // ذخیره روی disk public
        Storage::disk('public')->putFileAs(
            'students/photos',
            $file,
            "{$safeBase}.{$ext}"
        );

        // آدرس قابل نمایش
        return "/storage/{$relativePath}";
    }
}