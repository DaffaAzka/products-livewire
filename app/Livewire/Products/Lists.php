<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("List Products")]
class Lists extends Component
{

    use WithPagination;

    public function render()
    {
        $products = Product::with('category')->paginate(4);
        return view('livewire.products.lists', ['products' => $products]);
    }
}
