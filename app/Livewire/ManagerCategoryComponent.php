<?php

namespace App\Livewire;

use App\Models\CourseCategory;
use App\Traits\WithToastNotifications;
use Livewire\Component;

class ManagerCategoryComponent extends Component
{

    use WithToastNotifications;
    public function render()
    {
        return view('livewire.manager-category-component', [
            'categories' => CourseCategory::all()
        ]);
    }

    public function setActive(CourseCategory $category)
    {
        $category->active = !$category->active;
        $category->save();
        $message = "Se ha cambiado el estado a " . ($category->active ? "Activo" : "Inactivo");
        toastr()->success($message);

    }
}
