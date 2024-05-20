<?php

namespace App\Livewire;

use App\Models\Content;
use App\Models\Course;
use App\Models\CourseCategory;
use App\Models\TypeContent;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ManagerCourse extends Component
{
    use WithFileUploads;

    public $countRow = 10;
    public $chapters = [];
    public bool $showModal = false;
    public $data = [
        "name" => "",
        "url_poster" => "",
        "course_category_id" => "",
        "description" => "",
        "price" => "",
    ];

    public $chaptersToDelete = [];


    protected function rules()
    {
        return [
            'data.name' => 'required|string|max:255',
            'data.course_category_id' => 'required',
            'data.description' => 'required|string|max:1000',
            'data.price' => 'required|numeric|min:0',
            'chapters.*.title' => 'required|string|max:255',
            'chapters.*.url' => 'required|url',
            'chapters.*.duration_second' => 'required|numeric|min:1',
            'chapters.*.type_content_id' => 'required|exists:type_contents,id',
        ];
    }

    protected function messages()
    {
        return [
            'data.name.required' => 'El nombre es obligatorio.',
            'data.url_poster.required' => 'El póster es obligatorio.',
            'data.url_poster.image' => 'El archivo debe ser una imagen.',
            'data.url_poster.max' => 'El tamaño de la imagen no puede exceder 1MB.',
            'data.course_category_id.required' => 'La categoría del curso es obligatoria.',
            'data.course_category_id.exists' => 'La categoría seleccionada no es válida.',
            'data.description.required' => 'La descripción es obligatoria.',
            'data.price.required' => 'El precio es obligatorio.',
            'data.price.numeric' => 'El precio debe ser un número.',
            'data.price.min' => 'El precio no puede ser negativo.',
            'chapters.*.title.required' => 'El título del capítulo es obligatorio.',
            'chapters.*.url.required' => 'La URL del capítulo es obligatoria.',
            'chapters.*.url.url' => 'La URL del capítulo no es válida.',
            'chapters.*.duration_second.required' => 'La duración del capítulo es obligatoria.',
            'chapters.*.duration_second.numeric' => 'La duración debe ser un número.',
            'chapters.*.duration_second.min' => 'La duración debe ser al menos 1 segundo.',
            'chapters.*.type_content_id.required' => 'El tipo de contenido es obligatorio.',
            'chapters.*.type_content_id.exists' => 'El tipo de contenido seleccionado no es válido.',
        ];
    }

    public function render()
    {
        return view('livewire.manager-course', [
            'courses' => $this->getData(),
            'categories' => CourseCategory::where('active', true)->get(),
            'typeContents' => TypeContent::all(),
        ]);
    }

    public function addChapter()
    {
        $this->chapters[] = [
            'title' => '',
            'url' => '',
            'duration_second' => 60,
            'type_content_id' => '',
        ];
    }

    public function moveChapterUp($index)
    {
        if ($index > 0) {
            $temp = $this->chapters[$index];
            $this->chapters[$index] = $this->chapters[$index - 1];
            $this->chapters[$index - 1] = $temp;
        }
    }

    public function moveChapterDown($index)
    {
        if ($index < count($this->chapters) - 1) {
            $temp = $this->chapters[$index];
            $this->chapters[$index] = $this->chapters[$index + 1];
            $this->chapters[$index + 1] = $temp;
        }
    }

    public function getData(): LengthAwarePaginator
    {
        $query = Course::query();
        return $query->paginate($this->countRow ?? 10);
    }

    public function addOrEdit(?Course $course = null)
    {
        $this->showModal = true;
        if ($course) {
            $this->data = $course->toArray();
            $this->chapters = $course->contents()->orderBy('orden')->get()->toArray();
        }
    }

    public function removeChapter($index)
    {
        if (isset($this->chapters[$index]['id'])) {
            $this->chaptersToDelete[] = $this->chapters[$index]['id'];
        }
        array_splice($this->chapters, $index, 1);
    }

    public function storeOrUpdate()
    {
        $this->validate();

        if ($this->data['url_poster'] && !is_string($this->data['url_poster'])) {
            $this->data['url_poster'] = $this->data['url_poster']->store('posters', 'public');

        }
        $this->data['user_id'] = auth()->user()->id;
        if (isset($this->data['id'])) {
            $message = "Se ha actualizado correctamente";
        } else {
            $message = "Se ha guardado correctamente";
        }
      

        $course = Course::updateOrCreate(['id' => $this->data['id'] ?? null], $this->data);

  
        foreach ($this->chapters as $key => $chapter) {
            $chapter['course_id'] = $course->id;
            $chapter['orden'] = $key+ 1;
            Content::updateOrCreate(['id' => $chapter['id'] ?? null], $chapter);
        }

        // Eliminar capítulos marcados para eliminación
        if (!empty($this->chaptersToDelete)) {
            Content::destroy($this->chaptersToDelete);
        }

        $this->showModal = false;
        toastr()->success($message);
        $this->reset('data', 'chapters', 'chaptersToDelete');
    }
    public function setActive(Course $course)
    {
        $course->active = !$course->active;
        $course->save();
        $message = "Se ha  " . ($course->active ? "Activado" : "Desactivado") . " el curso " . $course->name;
        toastr()->success($message);
    }

  
}
