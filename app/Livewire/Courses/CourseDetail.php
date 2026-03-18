<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use App\Models\Lesson;
use Livewire\Component;

class CourseDetail extends Component
{
    public $course;
    public $currentLesson;

    public function mount($slug, $lesson_slug = null)
    {
        $this->course = Course::where('slug', $slug)->firstOrFail();
        
        if ($lesson_slug) {
            $this->currentLesson = Lesson::where('course_id', $this->course->id)
                ->where('slug', $lesson_slug)
                ->firstOrFail();
        } else {
            $this->currentLesson = $this->course->lessons()->first();
        }
    }

    public function render()
    {
        return view('livewire.courses.course-detail')->layout('layouts.app');
    }
}
