<?php

namespace App\Livewire;

use App\Models\Image;
use App\Models\Product;
use Flux\Flux;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageUploader extends Component {
    use WithFileUploads;

    public $photo;
    public $model;

    public function render() {
        return view('livewire.image-uploader', [
            'images' => $this->model->images()->get(),
        ]);
    }

    public function save() {
        $this->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $this->photo->store('uploads', 'public');

        $this->model->images()->create([
            'url' => $path,
        ]);

        $this->reset('photo');
        Flux::toast(text: 'Imagen subida correctamente.');
        $this->dispatch('image-uploaded');
    }

    public function delete($imageId) {
        $image = Image::find($imageId);
        if ($image && $image->imageable_id === $this->model->id) {
            Storage::disk('public')->delete($image->url);
            $image->delete();
            Flux::toast(text: 'Imagen eliminada.');
        }
    }
}

