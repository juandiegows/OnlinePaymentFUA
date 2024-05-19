<div class="max-w-[80vw] mx-auto my-4">
    <h1 class="text-3xl font-bold mb-6">Ventas Realizadas</h1>

    <div class="w-[80vw]   mx-auto  flex justify-between mb-4">

        <select id="countries" class="w-60 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5" wire:model.live="countRow">

            <option value="10">10 Registros</option>
            <option value="25">25 Registros</option>
            <option value="50">50 Registros</option>
            <option value="100">100 Registros</option>
        </select>
      
    </div>

    <div class="w-[80vw] mx-auto my-4">
        {{ $sales->links() }}
    </div>

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Usuario</th>
                <th class="py-2 px-4 border-b">Cursos</th>
                <th class="py-2 px-4 border-b">Total a Pagar</th>
                <th class="py-2 px-4 border-b">Fecha de Compra</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr class="text-center align-middle items-center ">
                    <td class="py-2 px-4 border-b">{{ $sale->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $sale->user->name }}</td>
                    <td class="py-2 px-4 border-b">
                        <ul>
                            @foreach (json_decode($sale->courses, true) as $course)
                                <li>{{ $course['name'] }} - ${{ $course['price'] }} x {{ $course['quantity'] }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="py-2 px-4 border-b">${{ $sale->total_to_pay }}</td>
                    <td class="py-2 px-4 border-b">{{ $sale->purchase_date }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="w-[80vw] mx-auto my-4">
        {{ $sales->links() }}
    </div>

</div>
