<?php

namespace App\Livewire\Courses;

use App\Models\Course;
use Livewire\Component;
use Livewire\WithPagination;

class CourseList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $courses = Course::where('status', true)->orderBy('order')->paginate(9);
        return view('livewire.courses.course-list', [
            'courses' => $courses
        ])->layout('layouts.app');
    }
}
