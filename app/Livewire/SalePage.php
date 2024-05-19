<?php

namespace App\Livewire;

use App\Models\CourseSale;
use Livewire\Component;

class SalePage extends Component
{
    public function render()
    {
        return view('livewire.sale-page', [
            'sales' => CourseSale::with('user')->get()
        ]);
    }
}
