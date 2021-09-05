<?php

namespace App\Domain\Assets\Support\Exports;

use App\Domain\Assets\Models\Asset;

class FileFormat {
    public static function formatExport(Asset $asset, string $extension): string
    {
        return $asset->asset_type->label . $asset->getSerial() . '-' . $asset->product->model . '.' . $extension;
    }
}
