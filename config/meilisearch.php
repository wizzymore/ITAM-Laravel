<?php

use App\Domain\Assets\Models\Asset;

return [
    'settings' => [
        Asset::class => [
            'searchableAttributes' => ['serial_short', 'serial', 'serial_last_3', 'serial_with_type', 'product', 'product_maker', 'employee', 'asset_type'],
            'filterableAttributes' => ['serial', 'serial_with_type', 'asset_type', 'product', 'product_maker', 'employee']
        ]
    ]
];
