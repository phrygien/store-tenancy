<?php

namespace App\Livewire\School;

use App\Livewire\Forms\EcoleForm;
use App\Models\Ecole as ModelEcole;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\SplFileInfo;
use TallStackUi\Traits\Interactions;
class EcoleCreate extends Component
{
    use WithFileUploads;
    use Interactions;

    #[Validate('required|string')]
    public $nom;

    #[Validate('required|string|max:3')]
    public $code;

    #[Validate('required|email')]
    public $email;

    #[Validate('required|string|max:14')]
    public $phone;

    #[Validate('required|min:4')]
    public $adresse;

    #[Validate('required')]
    public $province_id;

    #[Validate('required')]
    public $region_id;

    #[Validate('required')]
    public $district_id;

    #[Validate('required')]
    public $commune_id;

    #[Validate('required')]
    public $is_active = false;

    #[Validate('required')]
    public $category_id;
/**@var TemporaryUploadedFile|mixed $image
    */
    #[Rule('required|max:1024', as: 'Image obligatoire.')]
    public $logo;


    public $featuredImage;

    public $photos = [];

    // 1. We create a property that will temporarily store the uploaded files
    public $backup = [];

    public function mount()
    {
        //dd(ModelEcole::all());
    }

    public function deleteUpload(array $content): void
    {
        /*
        the $content contains:
        [
            'temporary_name',
            'real_name',
            'extension',
            'size',
            'path',
            'url',
        ]
        */

        if (! $this->logo) {
            return;
        }

        $files = Arr::wrap($this->logo);

        /** @var UploadedFile $file */
        $file = collect($files)->filter(fn (UploadedFile $item) => $item->getFilename() === $content['temporary_name'])->first();

        // 1. Here we delete the file. Even if we have a error here, we simply
        // ignore it because as long as the file is not persisted, it is
        // temporary and will be deleted at some point if there is a failure here.
        rescue(fn () => $file->delete(), report: false);

        $collect = collect($files)->filter(fn (UploadedFile $item) => $item->getFilename() !== $content['temporary_name']);

        // 2. We guarantee restore of remaining files regardless of upload
        // type, whether you are dealing with multiple or single uploads
        $this->logo = is_array($this->logo) ? $collect->toArray() : $collect->first();
    }

    public function updatingProvinceId($key): void
    {
        $this->reset('region_id', 'district_id', 'commune_id');
    }

    public function saveEcole(): void
    {
            $verification = $this->validate();
            // store images
            ModelEcole::create([
                'nom' => $this->nom,
                'code' => $this->code,
                'email' => $this->email,
                'phone' => $this->phone,
                'province_id' => $this->province_id,
                'region_id' => $this->region_id,
                'district_id' => $this->district_id,
                'commune_id' => $this->commune_id,
                'adresse' => $this->adresse,
                'user_id' => Auth::user()->id,
                'is_active' => $this->is_active,
                'category_id' => $this->category_id,
                'logo' => Str::replaceFirst('public/', '', $this->logo->store('public/logos'))
               ]);

               $this->reset();

               $this->banner()
                        ->close()
                        ->success('Ecole bien enregistrer !')
                        ->leave(5)
                        ->send();


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
