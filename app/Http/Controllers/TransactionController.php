<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $cartItems = [
            [
                'name' => 'Coca Cola',
                'price' => 10000,
                'quantity' => 2,
                'total' => 20000
            ],
            [
                'name' => 'Indomie Goreng',
                'price' => 3500,
                'quantity' => 5,
                'total' => 17500
            ],
            [
                'name' => 'Face Wash',
                'price' => 25000,
                'quantity' => 1,
                'total' => 25000
            ]
        ];

        // Hitung total transaksi
        $subtotal = array_sum(array_column($cartItems, 'total'));
        $discount = 5000;
        $tax = $subtotal * 0.1;
        $totalPay = $subtotal - $discount + $tax;
        $payment = 60000;
        $change = $payment - $totalPay;

        return view('transaction', compact('cartItems', 'subtotal', 'discount', 'tax', 'totalPay', 'payment', 'change'));
    }
}
