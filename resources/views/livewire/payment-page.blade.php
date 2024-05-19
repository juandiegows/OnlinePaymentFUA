<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Pagar</h1>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Resumen del Carrito</h2>
        @foreach ($cart as $item)
            <div class="mb-2">
                <span>{{ $item['name'] }} - ${{ $item['price'] }} x {{ $item['quantity'] }}</span>
            </div>
        @endforeach
        <div class="mt-4">
            <span class="font-bold">Total: ${{ array_sum(array_map(function($item) { return $item['price'] * $item['quantity']; }, $cart)) }}</span>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Método de Pago</h2>
        <div>
            <label>
                <input type="radio" name="paymentMethod" value="card" wire:model="paymentMethod">
                Tarjeta
            </label>
            <label class="ml-4">
                <input type="radio" name="paymentMethod" value="pse" wire:model="paymentMethod">
                PSE
            </label>
        </div>
    </div>

    <div class="flex justify-between">
        <button wire:click="confirmPurchase" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Confirmar Compra</button>
    </div>

    @if (session()->has('message'))
        <div class="mt-6 text-green-500">
            {{ session('message') }}
        </div>
    @endif
</div>
