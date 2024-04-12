<?php

use Livewire\Volt\Component;
use Illuminate\Validation\Rules\Password;
use App\Models\Tenant;

new class extends Component {
    public $domain_name;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function submit()
    {
        $validatedData = $this->validate([
            'domain_name' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required', 'confirmed', Password::defaults()]
        ]);

        // save tenant
        $tenant = Tenant::create($validatedData);
        $createdTenant = Tenant::findOrFail($tenant->id);
        $createdTenant->user_id = Auth::user()->id;
        $createdTenant->save();

        //save tenant domain
        $tenant->domains()->create([
            'domain' => $validatedData['domain_name'].'.'.config('app.domain'),
        ]);
        
        redirect(route('stores.index'));
    }

}; ?>

<div>
    <form wire:submit='submit' class="space-y-4">
        <x-ts-input suffix="localhost.com" label="Nom de domaine" wire:model='domain_name' />
        <x-ts-input wire:model="name" label="Tenant Name" placeholder="" wire:model='name' />
        <x-ts-input icon="user" label="Email" placeholder="yourfriend@email.com"
            type="email" wire:model='email'/>
        <x-ts-password label="Mot de passe"
            generator
            :rules="['min:8', 'symbols', 'numbers', 'mixed']" wire:model='password'/>
        <x-ts-password label="Comfirmer mot de passe *"
                     wire:model='password_confirmation'/>
        <div class="pt-4">
            <x-ts-button type="submit" primary right-icon="calendar" spinner>Save tenant</x-ts-button>
        </div>
        <x-ts-errors />
    </form>
</div>
