<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface FuellingProviderInterface
{
    /**
     * Get the locations from the fuelling provider.
     *
     * @return Collection<int, array>
     */
    public function getLocations(): Collection;
}
