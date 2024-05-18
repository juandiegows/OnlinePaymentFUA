<?php

namespace App\Livewire;

use App\Models\Course;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;

class ManagerCourse extends Component
{
    public function render()
    {
        return view('livewire.manager-course', [
            'courses' => $this->getData()
        ]);
    }

    public function getData(): LengthAwarePaginator
    {
        $query = Course::query();
        $query->where('id', '!=', auth()->user()->id);
        return $query->paginate($this->countRow ?? 10);
    }
}
