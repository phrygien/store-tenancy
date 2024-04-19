<?php

namespace App\Livewire\School;

use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\SplFileInfo;
class EcoleCreate extends Component
{
    use WithFileUploads;

    public $province_id;
    public $region_id;
    public $district_id;
    public $commune_id;

    public $is_active = false;

    public $photos = [];

    // 1. We create a property that will temporarily store the uploaded files
    public $backup = [];

    public function mount(): void
    {
        // We get all files and map the contents of the files
        // to ensure a necessary structure for the component.
        $this->photos = collect(File::allFiles(public_path('storage/images')))->map(fn (SplFileInfo $file) => [
            'name' => $file->getFilename(),
            'extension' => $file->getExtension(),
            'size' => $file->getSize(),
            'path' => $file->getPath(),
            'url' => Storage::url('images/'.$file->getFilename()),
        ])->toArray();

        // In this example we are using the images that exists
        // in the application server, but you can use any other
        // files for example, files that are stored in the S3 bucket.
    }

    public function updatingPhotos(): void
    {
        // 2. We store the uploaded files in the temporary property
        $this->backup = $this->photos;
    }

    public function updatedPhotos(): void
    {
        if (!$this->photos) {
            return;
        }

        // 3. We merge the newly uploaded files with the saved ones
        $file = Arr::flatten(array_merge($this->backup, [$this->photos]));

        // 4. We finishing by removing the duplicates
        $this->photos = collect($file)->unique(fn (UploadedFile $item) => $item->getClientOriginalName())->toArray();
    }

    public function deleteUpload(array $content): void
    {
        /*
        the $content contains:
        [
            'temporary_name',
            'real_name', // same of 'temporary_name' in static mode
            'extension',
            'size',
            'path',
            'url',
        ]
        */

        if (empty($this->photos)) {
            return;
        }

        File::delete($content['path']);

        $files = Arr::wrap($this->photos);

        $this->photos = collect($files)
            ->filter(fn (array $item) => $item['name'] !== $content['real_name'])
            ->toArray();
    }

    public function updatingProvinceId($key): void
    {
        $this->reset('region_id', 'district_id', 'commune_id');
    }

    public function saveEcole(): void
    {
        dd($this->region_id);
    }

    public function toggleIsActive(): void
    {
        $this->is_active = !$this->is_active;
    }


    public function render()
    {
        return view('livewire.school.ecole-create');
    }
}
