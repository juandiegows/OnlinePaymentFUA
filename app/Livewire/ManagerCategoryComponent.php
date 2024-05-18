<?php

namespace App\Livewire;

use App\Models\CourseCategory;
use App\Traits\WithToastNotifications;
use Livewire\Component;

class ManagerCategoryComponent extends Component
{

    use WithToastNotifications;

    public bool $showModal = false;

    public $data = [
        "name" => ""
    ];


    public function render()
    {
        return view('livewire.manager-category-component', [
            'categories' => CourseCategory::all()
        ]);
    }


    public function addOrEdit(?CourseCategory $category = null)
    {
        $this->showModal = true;
        if ($category) {
            $this->data = $category->toArray();
        }
    }

    public function storeOrUpdate()
    {
        $message = "";

        if (isset($this->data['id'])) {
            $category = CourseCategory::find($this->data['id']);
            $category->forceFill($this->data);
            $message = "Se ha actualizado correctamente";
        } else {
            $category = new CourseCategory();
            $category->forceFill($this->data);
            $message = "Se ha guardado correctamente";
        }
        $category->save();
        toastr()->success($message);
        $this->showModal = false;
    }

    public function setActive(CourseCategory $category)
    {
        $category->active = !$category->active;
        $category->save();
        $message = "Se ha cambiado el estado a " . ($category->active ? "Activo" : "Inactivo");
        toastr()->success($message);

    }
}
