<div class="bg-white shadow-md rounded-lg overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Category</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Product Name</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Unit Price</th>
                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Supplier</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-200">
            <tr class="hover:bg-gray-100 transition">
                <td class="px-6 py-4">{{ $product->category->name }}</td>
                <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                <td class="px-6 py-4">{{ $product->Qty }}</td>
                <td class="px-6 py-4">$ {{ number_format($product->unit_price, 2) }}</td>
                <td class="px-6 py-4">{{ $product->supplier?->name ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>
