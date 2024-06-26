<div class="grid grid-cols-3 gap-6">
    @foreach ($courses as $course)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <img src="{{  Storage::url($course->url_poster) }}" alt="{{ $course->name }}" class="w-full h-48 object-cover">
        <div class="p-4">
            <h3 class="text-lg font-semibold mb-2">{{ $course->name }}</h3>
            <p class="text-gray-600 mb-4">${{ $course->price }}</p>
            <div class="flex justify-between">
                <form action="{{ route('cart.add', $course->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Agregar al carrito</button>
                </form>
                <a href="{{ route('courses.show', $course->id) }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-md">Comprar</a>
            </div>
        </div>
    </div>
    @endforeach
</div>