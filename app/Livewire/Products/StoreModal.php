<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class StoreModal extends Component
{
    use WithFileUploads;

    public $title, $description, $price, $stock, $category_id, $image;
    public $categories;

    function store() {
        $image = null;

        $this->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'description' => 'required',

            'price' => 'required',
            'stock' => 'required',
        ]);

        if ($this->image) {
            $fileName = $this->generateRandomString();
            $extension = $this->image->extension();
            $image = $fileName . '.' . $extension;
            Storage::disk('public')->putFileAs('images', $this->image, $image);
        }

        Product::create([
            'title'=> $this->title,
            'description'=> $this->description,
            'price'=> $this->price,
            'stock'=> $this->stock,
            'category_id'=> $this->category_id,
            'image'=> $image
        ]);

        return redirect()->route('products.lists')->with('success', 'Product created successfully.');

    }

    public function mount() {
        $this->categories = Category::select('id', 'name')->get();
        if ($this->categories->isNotEmpty()) {
            $this->category_id = $this->categories->first()->id;
        }
    }



    public function render()
    {
        return view('livewire.products.store-modal');
    }

    function generateRandomString($length = 30): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
