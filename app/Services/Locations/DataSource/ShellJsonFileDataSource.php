<?php

namespace App\Services\Locations\DataSource;

use Illuminate\Support\Collection;
use App\Interfaces\DataSourceInterface;

class ShellJsonFileDataSource implements DataSourceInterface
{
    public function __construct(private string $filePath = __DIR__.'/../Fixtures/shell-locations.json')
    {}

    /**
     * Fetch the data from the Shell API.
     *
     * @return Collection<int, array>
     */
    public function fetchData(): Collection
    {
        return collect(json_decode(file_get_contents($this->filePath), true));
    }

    /**
     * Map the data to the correct format.
     *
     * @param array $location
     * @return array<string, string>
     */
    public function mapData(array $location): array
    {
        return [
            'brand' => $location['brand'],
            'status' => $location['status'],
            'address' => $location['address'],
            'long' => $location['long'],
            'lat' => $location['lat'],
        ];
    }
}
