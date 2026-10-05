<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCrudTest extends TestCase
{
    use RefreshDatabase;

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Asha Gurung',
            'email' => 'asha@example.com',
            'phone' => '9800000000',
            'address' => 'Kathmandu',
            'date_of_birth' => '2002-04-15',
        ], $overrides);
    }

    public function test_list_page_shows_empty_state(): void
    {
        $this->get('/students')
            ->assertOk()
            ->assertSee('No students found');
    }

    public function test_create_form_renders(): void
    {
        $this->get('/students/create')
            ->assertOk()
            ->assertSee('Create Student');
    }

    public function test_student_can_be_created(): void
    {
        $this->post('/students', $this->validData())
            ->assertRedirect('/students')
            ->assertSessionHas('success');

        $this->assertDatabaseHas('students', ['email' => 'asha@example.com']);

        $this->get('/students')->assertSee('Asha Gurung');
    }

    public function test_create_validates_input(): void
    {
        $this->post('/students', ['email' => 'not-an-email'])
            ->assertSessionHasErrors(['name', 'email', 'phone']);

        $this->assertDatabaseCount('students', 0);
    }

    public function test_create_rejects_duplicate_email(): void
    {
        Student::create($this->validData());

        $this->post('/students', $this->validData(['name' => 'Someone Else']))
            ->assertSessionHasErrors('email');
    }

    public function test_student_detail_and_edit_pages_render(): void
    {
        $student = Student::create($this->validData());

        $this->get("/students/{$student->id}")
            ->assertOk()
            ->assertSee('asha@example.com')
            ->assertSee('15 April 2002');

        $this->get("/students/{$student->id}/edit")
            ->assertOk()
            ->assertSee('value="2002-04-15"', false);
    }

    public function test_missing_student_returns_404(): void
    {
        $this->get('/students/999')->assertNotFound();
    }

    public function test_student_can_be_updated_keeping_same_email(): void
    {
        $student = Student::create($this->validData());

        $this->put("/students/{$student->id}", $this->validData(['name' => 'Asha G.']))
            ->assertRedirect("/students/{$student->id}")
            ->assertSessionHas('success');

        $this->assertSame('Asha G.', $student->fresh()->name);
    }

    public function test_update_rejects_email_of_another_student(): void
    {
        Student::create($this->validData(['email' => 'taken@example.com']));
        $student = Student::create($this->validData());

        $this->put("/students/{$student->id}", $this->validData(['email' => 'taken@example.com']))
            ->assertSessionHasErrors('email');
    }

    public function test_student_can_be_deleted(): void
    {
        $student = Student::create($this->validData());

        $this->delete("/students/{$student->id}")
            ->assertRedirect('/students')
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }
}
