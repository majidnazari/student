<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\College;
use App\Models\EducationGroup;
use App\Models\Major;
use App\Models\Lesson;
use App\Models\Student;
use App\Models\Term;
use App\Models\TermLessonResult;

class ApiV1CrudTest extends TestCase
{
    use RefreshDatabase;

    private string $base = '/api/v1';

    public function test_college_crud(): void
    {
        // CREATE
        $create = $this->postJson("{$this->base}/colleges", [
            'name' => 'دانشکده تست',
        ]);

        $create->assertCreated()
            ->assertJsonFragment(['name' => 'دانشکده تست']);

        $collegeId = $create->json('id');

        // INDEX
        $this->getJson("{$this->base}/colleges")
            ->assertOk()
            ->assertJsonFragment(['name' => 'دانشکده تست']);

        // SHOW
        $this->getJson("{$this->base}/colleges/{$collegeId}")
            ->assertOk()
            ->assertJsonFragment(['id' => $collegeId]);

        // UPDATE
        $this->putJson("{$this->base}/colleges/{$collegeId}", [
            'name' => 'دانشکده تست (ویرایش)',
        ])->assertOk()
            ->assertJsonFragment(['name' => 'دانشکده تست (ویرایش)']);

        // DELETE
        $this->deleteJson("{$this->base}/colleges/{$collegeId}")
            ->assertOk();

        // Should be deleted
        $this->assertDatabaseMissing('colleges', [
            'id' => $collegeId,
        ]);
    }

    public function test_education_group_crud(): void
    {
        $create = $this->postJson("{$this->base}/education-groups", [
            'name' => 'گروه تست',
        ]);

        $create->assertCreated()->assertJsonFragment(['name' => 'گروه تست']);
        $id = $create->json('id');

        $this->getJson("{$this->base}/education-groups")->assertOk();
        $this->getJson("{$this->base}/education-groups/{$id}")
            ->assertOk()
            ->assertJsonFragment(['id' => $id]);

        $this->putJson("{$this->base}/education-groups/{$id}", [
            'name' => 'گروه تست (ویرایش)',
        ])->assertOk()
            ->assertJsonFragment(['name' => 'گروه تست (ویرایش)']);

        $this->deleteJson("{$this->base}/education-groups/{$id}")
            ->assertOk();

        $this->assertDatabaseMissing('education_groups', ['id' => $id]);
    }

    public function test_major_crud(): void
    {
        $eg = EducationGroup::create(['name' => 'مهندسی']);

        // CREATE
        $create = $this->postJson("{$this->base}/majors", [
            'education_group_id' => $eg->id,
            'name' => 'رشته تست',
        ]);

        $create->assertCreated()->assertJsonFragment(['name' => 'رشته تست']);
        $majorId = $create->json('id');

        // INDEX
        $this->getJson("{$this->base}/majors")->assertOk();

        // SHOW
        $this->getJson("{$this->base}/majors/{$majorId}")
            ->assertOk()
            ->assertJsonFragment(['id' => $majorId]);

        // UPDATE
        $this->putJson("{$this->base}/majors/{$majorId}", [
            'name' => 'رشته تست (ویرایش)',
        ])->assertOk()
            ->assertJsonFragment(['name' => 'رشته تست (ویرایش)']);

        // DELETE
        $this->deleteJson("{$this->base}/majors/{$majorId}")
            ->assertOk();

        $this->assertDatabaseMissing('majors', ['id' => $majorId]);
    }

    public function test_lesson_crud(): void
    {
        $create = $this->postJson("{$this->base}/lessons", [
            'code' => 'CS900',
            'name' => 'درس تست',
            'unit' => 3,
        ]);

        $create->assertCreated()->assertJsonFragment(['code' => 'CS900']);
        $lessonId = $create->json('id');

        $this->getJson("{$this->base}/lessons")->assertOk();

        $this->getJson("{$this->base}/lessons/{$lessonId}")
            ->assertOk()
            ->assertJsonFragment(['id' => $lessonId]);

        $this->putJson("{$this->base}/lessons/{$lessonId}", [
            'name' => 'درس تست (ویرایش)',
            'unit' => 2,
        ])->assertOk()
            ->assertJsonFragment(['name' => 'درس تست (ویرایش)']);

        $this->deleteJson("{$this->base}/lessons/{$lessonId}")
            ->assertOk();

        // چون soft delete دارید، این check بهتر است:
        $this->assertSoftDeleted('lessons', ['id' => $lessonId]);
    }

    public function test_student_crud_and_report_show(): void
    {
        $college = College::create(['name' => 'دانشکده مهندسی']);
        $eg = EducationGroup::create(['name' => 'مهندسی']);
        $major = Major::create(['education_group_id' => $eg->id, 'name' => 'مهندسی نرم‌افزار']);

        // CREATE student
        $create = $this->postJson("{$this->base}/students", [
            'college_id' => $college->id,
            'education_group_id' => $eg->id,
            'major_id' => $major->id,
            'student_number' => '40123456',
            'first_name' => 'علی',
            'last_name' => 'احمدی',
            'photo_path' => null,
        ]);

        $create->assertCreated()->assertJsonFragment(['student_number' => '40123456']);
        $studentId = $create->json('id');

        // INDEX (search)
        $this->getJson("{$this->base}/students?last_name=احمدی")
            ->assertOk()
            ->assertJsonFragment(['student_number' => '40123456']);

        // SHOW (report)
        $this->getJson("{$this->base}/students/{$studentId}")
            ->assertOk()
            ->assertJsonFragment(['id' => $studentId]);

        // UPDATE
        $this->putJson("{$this->base}/students/{$studentId}", [
            'first_name' => 'علی‌اصغر',
        ])->assertOk()
            ->assertJsonFragment(['first_name' => 'علی‌اصغر']);

        // DELETE
        $this->deleteJson("{$this->base}/students/{$studentId}")
            ->assertOk();

        $this->assertSoftDeleted('students', ['id' => $studentId]);
    }

    public function test_term_crud_for_student(): void
    {
        $college = College::create(['name' => 'دانشکده مهندسی']);
        $eg = EducationGroup::create(['name' => 'مهندسی']);
        $major = Major::create(['education_group_id' => $eg->id, 'name' => 'مهندسی نرم‌افزار']);

        $student = Student::create([
            'college_id' => $college->id,
            'education_group_id' => $eg->id,
            'major_id' => $major->id,
            'student_number' => '40100001',
            'first_name' => 'نگار',
            'last_name' => 'محمدی',
            'photo_path' => null,
        ]);

        // CREATE term
        $create = $this->postJson("{$this->base}/students/{$student->id}/terms", [
            'term_number' => 1,
            'start_date' => '2025-09-23',
            'end_date' => '2026-01-20',
        ]);

        $create->assertCreated()->assertJsonFragment(['term_number' => 1]);
        $termId = $create->json('id');

        // UPDATE term
        $this->putJson("{$this->base}/terms/{$termId}", [
            'term_number' => 2,
        ])->assertOk()
            ->assertJsonFragment(['term_number' => 2]);

        // DELETE term
        $this->deleteJson("{$this->base}/terms/{$termId}")
            ->assertOk();

        $this->assertSoftDeleted('terms', ['id' => $termId]);
    }

    public function test_term_lesson_result_crud(): void
    {
        $college = College::create(['name' => 'دانشکده مهندسی']);
        $eg = EducationGroup::create(['name' => 'مهندسی']);
        $major = Major::create(['education_group_id' => $eg->id, 'name' => 'مهندسی نرم‌افزار']);
        $lesson = Lesson::create(['code' => 'CS101', 'name' => 'مبانی برنامه‌نویسی', 'unit' => 3]);

        $student = Student::create([
            'college_id' => $college->id,
            'education_group_id' => $eg->id,
            'major_id' => $major->id,
            'student_number' => '40100002',
            'first_name' => 'سارا',
            'last_name' => 'رضایی',
            'photo_path' => null,
        ]);

        $term = Term::create([
            'student_id' => $student->id,
            'term_number' => 1,
            'start_date' => '2025-09-23',
            'end_date' => '2026-01-20',
        ]);

        // CREATE result for term
        $create = $this->postJson("{$this->base}/terms/{$term->id}/results", [
            'lesson_id' => $lesson->id,
            'grade' => 18.50,
            'grade_status' => 1,
            'coach_name' => 'دکتر حسینی',
            'description' => 'عملکرد خوب',
        ]);

        $create->assertCreated()
            ->assertJsonFragment(['lesson_id' => $lesson->id])
            ->assertJsonFragment(['grade_status' => 1]);

        $resultId = $create->json('id');

        // UPDATE result
        $this->putJson("{$this->base}/results/{$resultId}", [
            'grade' => 19.00,
            'grade_status' => 1,
            'description' => 'بهبود عالی',
        ])->assertOk()
            ->assertJsonFragment(['description' => 'بهبود عالی']);

        // DELETE result
        $this->deleteJson("{$this->base}/results/{$resultId}")
            ->assertOk();

        $this->assertSoftDeleted('term_lesson_results', ['id' => $resultId]);
    }

    public function test_lookup_endpoints(): void
    {
        College::create(['name' => 'دانشکده علوم']);
        $eg = EducationGroup::create(['name' => 'علوم پایه']);
        Major::create(['education_group_id' => $eg->id, 'name' => 'ریاضی']);
        Lesson::create(['code' => 'MATH101', 'name' => 'ریاضی عمومی ۱', 'unit' => 3]);

        $this->getJson("{$this->base}/lookups/colleges")->assertOk();
        $this->getJson("{$this->base}/lookups/education-groups")->assertOk();
        $this->getJson("{$this->base}/lookups/majors?education_group_id={$eg->id}")->assertOk();
        $this->getJson("{$this->base}/lookups/lessons")->assertOk();
    }
}