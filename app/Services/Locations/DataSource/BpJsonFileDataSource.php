<?php

namespace App\Services\Locations\DataSource;

use Illuminate\Support\Collection;
use App\Interfaces\DataSourceInterface;

class BpJsonFileDataSource implements DataSourceInterface
{
    public function __construct(private string $filePath = __DIR__.'/../Fixtures/bp-locations.json')
    {}

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
            'status' => $this->mapStatus($location['status']),
            'address' => $location['address'],
            'long' => $location['lng'],
            'lat' => $location['lat'],
        ];
    }

    /**
     * Map the status to the correct format.
     *
     * @param string $status
     *
     * @return string
     */
    private function mapStatus(string $status): string
    {
        return match ($status) {
            'not_free' => 'being_used',
            default => $status,
        };
    }
}
