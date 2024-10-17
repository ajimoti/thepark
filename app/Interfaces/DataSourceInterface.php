<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface DataSourceInterface
{
    /**
     * Fetch data from the data source.
     *
     * @return Collection<int, array>
     */
    public function fetchData(): Collection;

    /**
     * Map the data to the correct format.
     *
     * @param array $location
     * @return array
     */
    public function mapData(array $location): array;
}
