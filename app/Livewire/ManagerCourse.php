<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ManagerCourse extends Component
{
    use WithFileUploads;

    public $countRow = 10;
    public bool $showModal = false;
    public $data = [
        "name" => "",
        "url_poster" => "",
        "course_category_id" => "",
        "description" => "",
        "price" => "",
    ];

    public function render()
    {
        return view('livewire.manager-course', [
            'courses' => $this->getData(),
            'categories' => CourseCategory::where('active', true)->get(),
        ]);
    }

    public function getData(): LengthAwarePaginator
    {
        $query = Course::query();
        $query->where('id', '!=', auth()->user()->id);
        return $query->paginate($this->countRow ?? 10);
    }

    public function addOrEdit(?Course $course = null)
    {
        $this->showModal = true;
        if ($course) {
            $this->data = $course->toArray();
        }
    }
}
