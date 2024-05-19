<?php

namespace App\Livewire;

use App\Actions\SaleStatus\SaleStatusConstante;
use App\Models\CourseSale;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class PaymentPage extends Component
{
    public $total = 0;
    public function render()
    {
        return view('livewire.payment-page');
    }
    public function calculateTotal()
    {
        return array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $this->cart));
    }

    public $cart;
    public $paymentMethod = 'card'; // Default payment method

    public function mount()
    {
        $this->cart = Session::get('cart', []);
        if (empty($this->cart)) {
            return redirect()->route('home'); // Redirect if cart is empty
        }
    }

    public function confirmPurchase()
    {
        $cartAsArray = array_values($this->cart);

        $course = new CourseSale;
        $course->user_id = auth()->user()->id;
        $course->course_sale_status_id = SaleStatusConstante::COMPLETADA;
        $course->courses = json_encode($cartAsArray);
        $course->total_to_pay = $this->calculateTotal();
        $course->purchase_date = now();
        $course->save();
        Session::forget('cart');
        session()->flash('message', 'Compra confirmada exitosamente!');
        return redirect()->route('home');
    }

}
