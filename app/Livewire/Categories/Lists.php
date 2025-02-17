<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title("List Categories")]
class Lists extends Component
{
    use WithPagination;
    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.categories.lists', ['categories' => $categories]);
    }
}
