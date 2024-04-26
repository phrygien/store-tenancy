<?php

namespace App\Livewire\Forms;

use App\Models\Ecole;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EcoleForm extends Form
{
    public ?Ecole $ecole;

    #[Rule('required|string')]
    public string $nom;

    #[Rule('required|string|max:3')]
    public string $code;

    #[Rule('required|email')]
    public string $email;

    #[Rule('required|string|max:14')]
    public string $phone;

    #[Rule('required|string|min:4')]
    public string $adresse;

    #[Rule('required|string')]
    public string $province_id;

    #[Rule('required|string')]
    public string $region_id;

    #[Rule('required|string')]
    public string $district_id;

    #[Rule('required|string')]
    public string $commune_id;


    #[Rule('required|string')]
    public string $user_id;

    #[Rule('required|integer')]
    public string $is_active;

    #[Rule('required|array', as: 'category')]
    public array $ecoleCategories = [];

    #[Rule('required|string')]
    public string $category_id;

    #[Rule('image')]
    public $logo;

    public function setEcole(Ecole $ecole): void
    {
        $this->ecole = $ecole;
        $this->nom = $ecole->nom;
        $this->code = $ecole->code;
        $this->email = $ecole->email;
        $this->phone = $ecole->phone;
        $this->province_id = $ecole->province_id;
        $this->region_id = $ecole->region_id;
        $this->district_id = $ecole->district_id;
        $this->commune_id = $ecole->commune_id;
        $this->adresse = $ecole->adresse;
        $this->user_id = $ecole->user_id;
        $this->is_active = $ecole->is_active;
        $this->category_id = $ecole->category_id;
    }


    public function saveEcole(): void
    {
        $this->validate();

        $filename = $this->logo->store('ecoles_logo', 'public');
        $ecole = Ecole::create($this->all() + ['logo' => $filename]);
        $ecole->categories()->sync($this->ecoleCategories);
    }

    public function updateEcole(): void
    {
        $this->validate();

        $filename = $this->logo->store('ecoles_logo', 'public');
        $this->ecole->update($this->all() + ['logo' => $filename]);
        $ecole->categories()->sync($this->ecoleCategories);
    }
}
