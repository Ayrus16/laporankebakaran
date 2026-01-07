<?php

namespace App\Services;

use App\Models\Kantor;

class NearestKantorService
{
    public function findNearestKantorId(?float $lat, ?float $lng): ?int
    {
        if ($lat === null || $lng === null) {
            return null;
        }

        return Kantor::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->orderByRaw(
                "(6371 * acos(
                    cos(radians(?)) * cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) * sin(radians(latitude))
                )) asc",
                [$lat, $lng, $lat]
            )
            ->value('id');
    }
}
