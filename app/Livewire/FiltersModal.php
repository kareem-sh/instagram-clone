<?php

namespace App\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Livewire\Component;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class FiltersModal extends ModalComponent
{
    public $filters = ['Original','Clarendon','Gingham','Moon','Perpetua'];
    public $filtered_image;
    public $image;
    public $description;
    public $temp_images = [];
    
    public static function dispatchCloseEvent(): bool
    {
        return true;
    }
    public function mount($image){
        $this->image = $image;
        $this->filtered_image = $this->image;
        $this->add_temp_image($image);
    }

    public function filter_original(){
        $this->filtered_image = $this->image;
        $this->dispatch('add_temp_image',$this->filtered_image);
    }
    public static function modalMaxWidth(): string
    {
        return '5xl';
    }
   public function filter_clarendon()
{
    $manager = new ImageManager(new Driver());
    $imagePath = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
    $newFilename = Str::random(30) . '.jpg';
    $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $newFilename;

    $img = $manager->read($imagePath)
        ->brightness(6)
        ->contrast(6)
        ->save($savePath);

    $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $newFilename;
    $this->dispatch('add_temp_image',$this->filtered_image);
}
public function filter_moon()
{
    $manager = new ImageManager(new Driver());
    $imagePath = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
    $newFilename = Str::random(30) . '.jpg';
    $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $newFilename;

    $img = $manager->read($imagePath)
        ->brightness(10)
        ->contrast(5)
        ->greyscale()
        ->save($savePath);

    $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $newFilename;
    $this->dispatch('add_temp_image',$this->filtered_image);
}

public function filter_gingham()
{
    $manager = new ImageManager(new Driver());
    $imagePath = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
    $newFilename = Str::random(30) . '.jpg';
    $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $newFilename;

    $img = $manager->read($imagePath)
        ->brightness(5)
        ->contrast(15)
        ->colorize(0, -10, -10)
        ->save($savePath);

    $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $newFilename;
    $this->dispatch('add_temp_image',$this->filtered_image);
}

public function filter_perpetua()
{
    $manager = new ImageManager(new Driver());
    $imagePath = storage_path('app/public') . DIRECTORY_SEPARATOR . $this->image;
    $newFilename = Str::random(30) . '.jpg';
    $savePath = storage_path('app/public/temp') . DIRECTORY_SEPARATOR . $newFilename;

    $img = $manager->read($imagePath)
        ->contrast(15)
        ->colorize(-30,10,10)
        ->save($savePath);

    $this->filtered_image = 'temp' . DIRECTORY_SEPARATOR . $newFilename;
    $this->dispatch('add_temp_image',$this->filtered_image);
}

    #[on('add_temp_image')]
    public function add_temp_image($image){
        $relative_path = str_replace('storage/', '', $image);
        array_push($this->temp_images, $relative_path);
    }

    public function publish()
    {
        $this->validate([
            'description' => 'required',
        ]);
        $post_image = 'posts/' . Str::random(30) . '.jpg';
        Storage::move($this->filtered_image, $post_image);
        $post = Auth::user()->posts()->create([
            'description' => $this->description,
            'slug' => Str::random(10),
            'image' => $post_image
        ]);
        
        $this->dispatch('createPost'); // Dispatch event to refresh posts
        $this->forceClose()->closeModal();
        $this->dispatch('updated');
    }
    #[On('modalClosed')]
    public function delete_temp_images(){
        Storage::delete($this->temp_images);
    }

    public function render()
    {
        return view('livewire.filters-modal');
    }
}