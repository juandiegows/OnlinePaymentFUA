<div class="max-w-[80vw] mx-auto">
    <h1 class="text-3xl font-bold mb-6">Ventas Realizadas</h1>
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
                <tr>
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
</div>
