<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-4">Carrito de Compras</h1>

    @if (empty($cart))
        <p class="text-gray-700">Tu carrito está vacío.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($cart as $id => $item)
                <div class="bg-white rounded-lg shadow-md p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $item['name'] }}</h3>
                    <p class="text-gray-600 mb-2">Precio: ${{ $item['price'] }}</p>
                    <p class="text-gray-600 mb-4">Cantidad: {{ $item['quantity'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex justify-between">
            <button wire:click="clearCart" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Limpiar Carrito</button>
            <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md" wire:click="proceedToCheckout">Pagar</button>
        </div>
    @endif
</div>
