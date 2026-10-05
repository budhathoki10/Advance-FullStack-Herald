<?php

namespace Tests\Feature;

use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseCrudTest extends TestCase
{
    use RefreshDatabase;

    private function validData(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Laravel Fundamentals',
            'description' => 'Routing, Blade and Eloquent.',
            'duration' => 8,
            'fee' => '15000.50',
            'difficulty' => 'medium',
            'is_active' => '1',
        ], $overrides);
    }

    public function test_list_page_shows_empty_state(): void
    {
        $this->get('/courses')
            ->assertOk()
            ->assertSee('No courses found');
    }

    public function test_create_form_renders(): void
    {
        $this->get('/courses/create')
            ->assertOk()
            ->assertSee('Create Course');
    }

    public function test_course_can_be_created(): void
    {
        $this->post('/courses', $this->validData())
            ->assertRedirect('/courses')
            ->assertSessionHas('success');

        $course = Course::first();
        $this->assertSame('Laravel Fundamentals', $course->name);
        $this->assertSame(8, $course->duration);
        $this->assertSame('15000.50', $course->fee);
        $this->assertTrue($course->is_active);

        $this->get('/courses')
            ->assertSee('Laravel Fundamentals')
            ->assertSee('NPR 15,000.50');
    }

    public function test_unchecked_active_box_saves_inactive_course(): void
    {
        $this->post('/courses', $this->validData(['is_active' => '0']));

        $this->assertFalse(Course::first()->is_active);
    }

    public function test_create_validates_input(): void
    {
        $this->post('/courses', [
            'duration' => 0,
            'fee' => -5,
            'difficulty' => 'impossible',
        ])->assertSessionHasErrors(['name', 'duration', 'fee', 'difficulty']);

        $this->assertDatabaseCount('courses', 0);
    }

    public function test_course_detail_and_edit_pages_render(): void
    {
        $course = Course::create($this->validData());

        $this->get("/courses/{$course->id}")
            ->assertOk()
            ->assertSee('Routing, Blade and Eloquent.');

        $this->get("/courses/{$course->id}/edit")
            ->assertOk()
            ->assertSee('value="medium" selected', false);
    }

    public function test_missing_course_returns_404(): void
    {
        $this->get('/courses/999')->assertNotFound();
    }

    public function test_course_can_be_updated(): void
    {
        $course = Course::create($this->validData());

        $this->put("/courses/{$course->id}", $this->validData([
            'difficulty' => 'hard',
            'is_active' => '0',
        ]))
            ->assertRedirect("/courses/{$course->id}")
            ->assertSessionHas('success');

        $course->refresh();
        $this->assertSame('hard', $course->difficulty);
        $this->assertFalse($course->is_active);
    }

    public function test_course_can_be_deleted(): void
    {
        $course = Course::create($this->validData());

        $this->delete("/courses/{$course->id}")
            ->assertRedirect('/courses')
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('courses', ['id' => $course->id]);
    }
}
