<?php

namespace App\Services\Locations;

use Illuminate\Support\Collection;
use App\Services\Locations\FuellingProviders\BaseFuellingProvider;

class LocationsService
{
    protected array $providers;

    public function __construct(...$providers)
    {
        $this->providers = $providers;

        $this->validateProviders($providers);
    }

    /**
     * Get the locations from the fuelling providers.
     *
     * @return Collection<int, array>
     */
    public function getLocations(): Collection
    {
        $allLocations = collect();
        foreach ($this->providers as $provider) {
            $allLocations =$allLocations->merge(app()->make($provider)->getLocations());
        }

        return $allLocations;
    }

    /**
     * Validate the providers.
     *
     * @param array $providers
     * @return void
     */
    private function validateProviders(array $providers): void
    {
        foreach ($providers as $provider) {
            if (! is_subclass_of($provider, BaseFuellingProvider::class)) {
                throw new \InvalidArgumentException("Invalid provider: $provider");
            }
        }
    }
}
