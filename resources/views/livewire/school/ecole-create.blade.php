<div class="w-full lg:ps-64">

            <div class="max-w-3xl py-16 mx-auto px-7 lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Creation ecole</h2>
                <form wire:submit='saveEcole'>
                    {{-- <div class="p-6 bg-white border border-gray-200 rounded-lg shadow width-full dark:bg-gray-800 dark:border-gray-700">
                        <div class="grid gap-4 mb-3 sm:grid-cols-2 sm:gap-6">
                            <div class="w-full">
                                <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom ecole</label>
                                <x-ts-input wire:model='nom' />
                            </div>
                            <div class="w-full">
                                <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Unique</label>
                                <x-ts-input wire:model='code'/>
                            </div>
                            <div>
                                <label for="commune_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                <x-ts-select.styled wire:model='category_id' :request="[
                                    'url' => route('ecoles.index'),
                                    'method' => 'get',
                                    'params' => ['library' => 'TallStackUi'],
                                ]" select="label:name|value:id" />
                            </div>
                            <div>
                                <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo</label>
                                <x-ts-upload wire:model='photos' :preview="false" />
                            </div>
                            <div>
                                <x-ts-toggle wire:click='toggleIsActive'/>
                                @if($is_active)
                                <span class="text-rose-600">Active</span>
                            @else
                                Inactive
                            @endif
                                <input type="text" hidden ="hidden" wire:model='is_active'/>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 mt-3 mb-3 bg-white border border-gray-200 rounded-lg shadow width-full dark:bg-gray-800 dark:border-gray-700">
                        <div class="grid gap-4 mb-3 sm:grid-cols-2 sm:gap-6">
                            <div>
                                <label for="province_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinces</label>
                                <x-ts-select.styled wire:model.live='province_id' :request="[
                                    'url' => route('api.provinces.index'),
                                    'method' => 'get',
                                ]" select="label:nom|value:id" placeholder="select province" />
                            </div>
                            <div>
                                <label for="region_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Regions</label>
                                <x-ts-select.styled wire:model.live='region_id' :request="[
                                    'url' => route('api.regions.index'),
                                    'method' => 'get',
                                    'params' => ['province_id' => $province_id   ],
                                ]" select="label:nom|value:id" placeholder="select region" />
                            </div>
                            <div>
                                <label for="district_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Districts</label>
                                <x-ts-select.styled wire:model.live='district_id' :request="[
                                    'url' => route('api.districts.index'),
                                    'method' => 'get',
                                    'params' => ['id_region' => $region_id],
                                ]" select="label:libelle|value:id" />
                            </div>
                            <div>
                                <label for="commune_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Commune</label>
                                <x-ts-select.styled wire:model.live='commune_id' :request="[
                                    'url' => route('api.communes.index'),
                                    'method' => 'get',
                                    'params' => ['district_id' => $district_id],
                                ]" select="label:nom|value:id" />
                            </div>
                            <div class="sm:col-span-2">
                                <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse exacte</label>
                                <x-ts-textarea wire:model='adresse'/>
                            </div>
                        </div>
                    </div> --}}

                    <div class="grid gap-4 mb-3 sm:grid-cols-2 sm:gap-6">
                        <div class="w-full">
                            <label for="nom" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom ecole</label>
                            <x-ts-input wire:model='nom' />
                        </div>
                        <div class="w-full">
                            <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Code Unique</label>
                            <x-ts-input wire:model='code'/>
                        </div>
                        <div class="w-full">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse email</label>
                            <x-ts-input wire:model='email'/>
                        </div>
                        <div class="w-full">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Telephone</label>
                            <x-ts-input wire:model='phone'/>
                        </div>


                        <div>
                            <label for="province_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Provinces</label>
                            <x-ts-select.styled wire:model.live='province_id' :request="[
                                'url' => route('api.provinces.index'),
                                'method' => 'get',
                            ]" select="label:nom|value:id" placeholder="select province" />
                        </div>
                        <div>
                            <label for="region_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Regions</label>
                            <x-ts-select.styled wire:model.live='region_id' :request="[
                                'url' => route('api.regions.index'),
                                'method' => 'get',
                                'params' => ['province_id' => $province_id   ],
                            ]" select="label:nom|value:id" placeholder="select region" />
                        </div>
                        <div>
                            <label for="district_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Districts</label>
                            <x-ts-select.styled wire:model.live='district_id' :request="[
                                'url' => route('api.districts.index'),
                                'method' => 'get',
                                'params' => ['id_region' => $region_id],
                            ]" select="label:libelle|value:id" />
                        </div>
                        <div>
                            <label for="commune_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Commune</label>
                            <x-ts-select.styled wire:model.live='commune_id' :request="[
                                'url' => route('api.communes.index'),
                                'method' => 'get',
                                'params' => ['district_id' => $district_id],
                            ]" select="label:nom|value:id" />
                        </div>
                        <div class="sm:col-span-2">
                            <label for="adresse" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Adresse exacte</label>
                            <x-ts-textarea wire:model='adresse'/>
                        </div>


                        <div>
                            <label for="commune_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <x-ts-select.styled wire:model='category_id' :request="[
                                'url' => route('ecoles.index'),
                                'method' => 'get',
                                'params' => ['library' => 'TallStackUi'],
                            ]" select="label:name|value:id" />
                        </div>
                        <div>
                            <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo</label>
                            <x-ts-upload wire:model='photos' :preview="false" />
                        </div>
                        <div>
                            <x-ts-toggle wire:click='toggleIsActive' class="primary"/>
                            @if($is_active)
                            <span class="text-rose-600">Active</span>
                        @else
                            Inactive
                        @endif
                            <input type="text" hidden ="hidden" wire:model='is_active'/>
                        </div>

                    </div>
                    <x-ts-button wire:click="saveEcole" loading="saveEcole">
                        Save data
                    </x-ts-button>
                </form>
            </div>
</div>

