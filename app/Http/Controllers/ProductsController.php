<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $products = [
        'food-beverage' => [
            ['name' => 'Coca Cola', 'price' => 10000],
            ['name' => 'Indomie Goreng', 'price' => 3500],
            ['name' => 'Chitato', 'price' => 12000],
            ['name' => 'Teh Botol Sosro', 'price' => 8000],
        ],
        'beauty-health' => [
            ['name' => 'Face Wash', 'price' => 25000],
            ['name' => 'Hand Sanitizer', 'price' => 15000],
            ['name' => 'Body Lotion', 'price' => 30000],
            ['name' => 'Shampoo Herbal', 'price' => 40000],
        ],
        'home-care' => [
            ['name' => 'Detergent', 'price' => 30000],
            ['name' => 'Floor Cleaner', 'price' => 20000],
            ['name' => 'Glass Cleaner', 'price' => 18000],
            ['name' => 'Toilet Cleaner', 'price' => 22000],
        ],
        'baby-kid' => [
            ['name' => 'Baby Diapers', 'price' => 50000],
            ['name' => 'Baby Shampoo', 'price' => 40000],
            ['name' => 'Baby Powder', 'price' => 15000],
            ['name' => 'Baby Oil', 'price' => 20000],
        ],
    ];

    public function index()
    {
        return view('products.products', ['allProducts' => $this->products])->with('allCategory', ['Food Beverage', 'Beauty Health', 'Home Care', 'Baby Kid']);
    }
    public function foodBeverage()
    {
        return view('products.products', ['products' => $this->products['food-beverage']])->with('category', 'Food Beverage');
    }

    public function beautyHealth()
    {
        return view('products.products', ['products' => $this->products['beauty-health']])->with('category', 'Beauty Health');
    }

    public function homeCare()
    {
        return view('products.products', ['products' => $this->products['home-care']])->with('category', 'Home Care');
    }

    public function babyKid()
    {
        return view('products.products', ['products' => $this->products['baby-kid']])->with('category', 'Baby Kid');
    }
}
