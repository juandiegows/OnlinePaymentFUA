<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class Welcome extends Component
{

    public function render()
    {
        return view('livewire.welcome', ['courses' => Course::all()])->layout('layouts.guest');
    }
}
