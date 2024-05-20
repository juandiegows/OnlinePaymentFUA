<?php

namespace App\Livewire;

use App\Models\Course;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Welcome extends Component
{

    public function render()
    {
        return view('livewire.welcome', ['courses' => Course::where('active', true)->get()])->layout('layouts.guest');
    }

    public function addToCart($courseId, $buy = false)
    {

        $course = Course::findOrFail($courseId);
        $cart = Session::get('cart', []);

        if (isset($cart[$course->id])) {
            $cart[$course->id]['quantity']++;
        } else {

            $cart[$course->id] = [
                'name' => $course->name,
                'price' => $course->price,
                'quantity' => 1
            ];


            Session::put('cart', $cart);
        }
        $this->dispatch('cartUpdated');
        if ($buy) {
            return redirect('cart');
        }
    }
}
