<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

class StoreModal extends Component
{
    #[Rule("required", message:"Name is required")]
    public $name;
    public $slug;

    #[Rule("required", message:"Description is required")]
    public $description;

    public function store() {
        $this->validate();

        $this->slug = Str::slug($this->name);

        if (Category::where("slug", $this->slug)->exists()) {
            $this->addError("name","Category already exists");
        } else {
            Category::create([
                'name'=> $this->name,
                'slug'=> $this->slug,
                'description'=> $this->description
            ]);

            return redirect()->route('categories.lists')->with('success','Success created category');
        }
    }

    public function render()
    {
        return view('livewire.categories.store-modal');
    }
}
