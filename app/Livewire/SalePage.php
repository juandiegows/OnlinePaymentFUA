<?php

namespace App\Livewire;

use App\Models\CourseSale;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Livewire\Component;

class SalePage extends Component
{

    public $countRow = 10;
    
    public function render()
    {
        return view('livewire.sale-page', [
            'sales' => $this->getData()
        ]);
    }

    public function getData(): LengthAwarePaginator
    {
        $query =  CourseSale::with('user');
        $query->where('id', '!=', auth()->user()->id);
        return $query->paginate($this->countRow ?? 10);
    }
}
