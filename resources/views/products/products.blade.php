<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>TransactX POS | Products</title>
</head>

<body>
    <div class="container mx-auto flex flex-col gap-6 mt-5">

        {{-- untuk menampilkan semua kategori --}}
        @if (isset($allProducts))
            <h1 class="text-4xl font-semibold">Daftar Produk</h1>
            <div
                class="flex items-center justify-center w-full mx-auto p-5 rounded-lg shadow-md gap-5 border border-gray-200">
                @foreach ($allProducts as $category => $items)
                    <a href="/category/{{ $category }}"
                        class="flex flex-col w-full max-w-xs p-5 rounded-lg shadow-md gap-5 border border-gray-200">
                        <h2 class="text-xl font-semibold">{{ $allCategory[$loop->index] }}</h2>
                        <ul>
                            @foreach ($items as $item)
                                <li>{{ $item['name'] }} - Rp{{ number_format($item['price'], 0, ',', '.') }}</li>
                            @endforeach
                        </ul>
                    </a>
                @endforeach
            </div>
        @endif

        {{-- untuk setiap kategori --}}
        @if (isset($products))
            <h1 class="text-4xl font-semibold">{{ $category }}</h1>
            <ul>
                @foreach ($products as $item)
                    <li>{{ $item['name'] }} - Rp{{ number_format($item['price'], 0, ',', '.') }}</li>
                @endforeach
            </ul>
        @endif
    </div>

</body>

</html>
