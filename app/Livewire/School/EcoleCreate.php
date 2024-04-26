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
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Finder\SplFileInfo;
class EcoleCreate extends Component
{
    use WithFileUploads;


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

    public function updatingProvinceId($key): void
    {
        $this->reset('region_id', 'district_id', 'commune_id');
    }

    public function saveEcole(): void
    {
        //dd($this->nom, $this->code, $this->email, $this->phone, $this->province_id, $this->region_id, $this->district_id, $this->commune_id, $this->adresse, $this->is_active, $this->category_id);
        sleep(3);
        $this->validate();

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
