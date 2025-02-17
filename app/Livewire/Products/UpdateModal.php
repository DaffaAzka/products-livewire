<?php

namespace App\Livewire\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class UpdateModal extends Component
{
    use WithFileUploads;

    public $title;
    public $description;
    public $price;
    public $stock;
    public $category_id;
    public $image;
    public $categories;
    public $product_id;

    public function mount()
    {
        $this->categories = Category::select('id', 'name')->get();
    }

    #[On('editSelected')]
    public function handleEditSelected($idProduct)
    {
        $this->product_id = $idProduct;
        $product = Product::findOrFail($idProduct);

        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category_id = $product->category_id;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product = Product::findOrFail($this->product_id);

        if ($this->image) {
            if ($product->image && $product->image != 'default.jpg') {
                Storage::disk('public')->delete('images/' . $product->image);
            }
            $fileName = $this->generateRandomString();
            $extension = $this->image->extension();
            $image = $fileName . '.' . $extension;
            Storage::disk('public')->putFileAs('images', $this->image, $image);
            $this->image = $image;
        } else {
            $this->image = $product->image;
        }

        $product->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'image' => $this->image,
        ]);

        return redirect()->route('products.lists')->with('success', 'Product updated successfully.');
    }

    public function render()
    {
        return view('livewire.products.update-modal');
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
