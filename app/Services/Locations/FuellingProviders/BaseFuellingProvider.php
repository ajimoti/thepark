<?php

namespace App\Services\Locations\FuellingProviders;

use Illuminate\Support\Collection;
use App\Interfaces\FuellingProviderInterface;
use App\Interfaces\DataSourceInterface;

abstract class BaseFuellingProvider implements FuellingProviderInterface
{
    public function __construct(private DataSourceInterface $dataSource)
    {}

    /**
     * Get the locations from the fuelling provider.
     *
     * @return Collection<int, array>
     */
    public function getLocations(): Collection
    {
        $jsonData = $this->dataSource->fetchData();

        return $jsonData->map(function ($location) {
            return $this->dataSource->mapData($location);
        });
    }

}
