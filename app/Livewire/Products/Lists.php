<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("List Products")]
class Lists extends Component
{

    use WithPagination;

    #[Url]
    public $category = '';

    public function render()
    {
        $products = Product::search($this->category)->with('category')->paginate(4);
        return view('livewire.products.lists', ['products' => $products]);
    }
}
