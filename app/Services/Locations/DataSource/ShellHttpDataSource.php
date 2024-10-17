<?php

namespace App\Services\Locations\DataSource;

use Illuminate\Support\Collection;
use App\Interfaces\DataSourceInterface;
use Illuminate\Support\Facades\Http;

class ShellHttpDataSource implements DataSourceInterface
{
    public function __construct(private string $url = 'https://shell-fuelling.com/api/locations')
    {}

    /**
     * Fetch the data from the Shell API.
     *
     * @return Collection<int, array>
     */
    public function fetchData(): Collection
    {
        try {
            $response = Http::get($this->url);
            $response->throw();

            return $response->collect();
        } catch (\Exception $e) {
            throw new \Exception('Failed to fetch data from Shell API: ' . $e->getMessage());
        }
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
