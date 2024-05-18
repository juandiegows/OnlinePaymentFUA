<?php

namespace App\Livewire;

use App\Models\CourseCategory;
use App\Traits\WithToastNotifications;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ManagerCategoryComponent extends Component
{

    use WithToastNotifications;

    public $countRow = 10;

    public bool $showModal = false;
    protected function rules()
    {
        return [
            'data.name' => [
                'required',
                Rule::unique('categories', 'name')->ignore($this->data['id'] ?? 0),
            ],
        ];
    }

    protected function messages()
    {
        return [
            'data.name.required' => 'El nombre es obligatorio.',
            'data.name.unique' => 'El nombre ya ha sido tomado.',
        ];
    }

   
    public $data = [
        "name" => ""
    ];


    public function render()
    {
        return view('livewire.manager-category-component', [
            'categories' => $this->getData()
        ]);
    }

    public function getData(): LengthAwarePaginator
    {
        $query = CourseCategory::query();
        return $query->paginate($this->countRow ?? 10);
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
        $this->validate();
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
