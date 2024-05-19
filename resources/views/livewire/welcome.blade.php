<div>
    <h1 class="text-green-900 font-bold text-[3rem]  text-center">Todos los cursos a un solo clic</h1>
    <div class="grid grid-cols-3 gap-6 m-4  max-w-[80rem]">
        @foreach ($courses as $course)
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <img src="{{  Storage::url($course->url_poster) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $course->name }}</h3>
                <p class="text-gray-600 mb-4">${{ $course->price }}</p>
                <div class="flex justify-between">

                    <button type="button" wire:click="addToCart({{ $course->id }})" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Agregar al carrito</button>
                    <button type="button" wire:click="addToCart({{ $course->id }}, {{ true }})" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Comprar</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
