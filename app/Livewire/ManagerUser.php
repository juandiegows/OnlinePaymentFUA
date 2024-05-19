<?php

namespace App\Livewire;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ManagerUser extends Component
{
    public $countRow = 10;
    public bool $showModal = false;
    public $data = [
        "name" => "",
        "email" => "",
        "role_id" => "",
        "password" => "",
        "password_confirmation" => "",
    ];


    protected function rules()
    {
        return [
            'data.name' => 'required|string|max:255',
            'data.email' => 'required|email|unique:users,email,' . ($this->data['id'] ?? 'NULL') . ',id',
            'data.password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/', // must contain at least one lowercase letter
                'regex:/[A-Z]/', // must contain at least one uppercase letter
                'regex:/[0-9]/', // must contain at least one number
                'confirmed', // password must match confirmation
            ],
            'data.password_confirmation' => 'required|same:data.password',
            'data.role_id' => 'required|exists:roles,id',
        ];
    }

    protected function messages()
    {
        return [
            'data.name.required' => 'El nombre es obligatorio.',
            'data.name.string' => 'El nombre debe ser una cadena de texto.',
            'data.name.max' => 'El nombre no puede exceder los 255 caracteres.',
            'data.email.required' => 'El correo electrónico es obligatorio.',
            'data.email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'data.email.unique' => 'El correo electrónico ya ha sido tomado.',
            'data.password.required' => 'La contraseña es obligatoria.',
            'data.password.string' => 'La contraseña debe ser una cadena de texto.',
            'data.password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'data.password.regex' => 'La contraseña debe incluir al menos una letra mayúscula, una letra minúscula y un número.',
            'data.password.confirmed' => 'La confirmación de la contraseña no coincide.',
            'data.password_confirmation.required' => 'La confirmación de la contraseña es obligatoria.',
            'data.password_confirmation.same' => 'La confirmación de la contraseña no coincide con la contraseña.',
            'data.role_id.required' => 'El rol es obligatorio.',
            'data.role_id.exists' => 'El rol seleccionado no es válido.',
        ];
    }

    public function render()
    {
        return view('livewire.manager-user', [
            'users' => $this->getData(),
            'roles' => Role::all()
        ]);
    }

    public function getData(): LengthAwarePaginator
    {
        $query = User::query();
        $query->where('id', '!=', auth()->user()->id);
        return $query->paginate($this->countRow ?? 10);
    }

    public function setActive(User $user)
    {
        $user->active = !$user->active;
        $user->save();
        $message = "Se ha  " . ($user->active ? "Activado" : "Desactivado") . " el usuario " . $user->name;
        toastr()->success($message);
    }

    public function addOrEdit(?User $user = null)
    {
        $this->showModal = true;
        if ($user) {
            $this->data = $user->toArray();
            $this->data['password_confirmation'] = 'Jj12345678';
            $this->data['password'] = 'Jj12345678';
        }
    }

    public function storeOrUpdate()
    {
        Log::info($this->data);
        $this->validate();
        Log::info("Validado");
        $message = "";
        try {
            unset($this->data['password_confirmation']);
            if (isset($this->data['id'])) {
                unset($this->data['password']);
                $user = User::find($this->data['id']);
                $user->fill($this->data);
                $message = "Se ha actualizado correctamente";
            } else {
                $user = new User();
                $user->fill($this->data);
                $message = "Se ha guardado correctamente";
            }
            $user->save();
            toastr()->success($message);
        } catch (\Throwable $th) {
            toastr()->success($th->getMessage());
        }
     
        $this->showModal = false;
    }
}
