<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>TransactX POS | Transaction</title>
</head>

<body>
    <div class="container mx-auto p-5">
        <h1 class="text-2xl font-bold mb-4">Transaksi</h1>

        {{-- Tabel Produk yang Dibeli --}}
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 p-2">Nama Produk</th>
                    <th class="border border-gray-300 p-2">Harga</th>
                    <th class="border border-gray-300 p-2">Jumlah</th>
                    <th class="border border-gray-300 p-2">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cartItems as $item)
                    <tr>
                        <td class="border border-gray-300 p-2">{{ $item['name'] }}</td>
                        <td class="border border-gray-300 p-2">Rp{{ number_format($item['price'], 0, ',', '.') }}</td>
                        <td class="border border-gray-300 p-2">{{ $item['quantity'] }}</td>
                        <td class="border border-gray-300 p-2">Rp{{ number_format($item['total'], 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Ringkasan Transaksi --}}
        <div class="mt-5 p-4 border border-gray-300 rounded-lg w-1/2">
            <p><strong>Subtotal:</strong> Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
            <p><strong>Diskon:</strong> Rp{{ number_format($discount, 0, ',', '.') }}</p>
            <p><strong>Pajak (10%):</strong> Rp{{ number_format($tax, 0, ',', '.') }}</p>
            <hr class="my-2">
            <p class="text-lg font-bold"><strong>Total Bayar:</strong> Rp{{ number_format($totalPay, 0, ',', '.') }}</p>
            <p><strong>Uang Diterima:</strong> Rp{{ number_format($payment, 0, ',', '.') }}</p>
            <p><strong>Kembalian:</strong> Rp{{ number_format($change, 0, ',', '.') }}</p>
        </div>

        {{-- Tombol Konfirmasi --}}
        <div class="mt-5">
            <button class="px-4 py-2 bg-green-500 text-white rounded-md cursor-pointer">Konfirmasi Pembayaran</button>
        </div>
    </div>
</body>

</html>
