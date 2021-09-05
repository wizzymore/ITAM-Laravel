<?php

namespace App\Domain\Assets\Models;

use App\Domain\Employees\Models\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

class Asset extends Model
{
    use HasFactory, Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [];

    /**
     * Load all relationships on scout indexing
     *
     */

    protected function makeAllSearchableUsing($query)
    {
        return $query;
    }

    public function toSearchableArray()
    {
        $array = $this->toArray();

        $array['serial_short'] = $this->serial;
        $array['serial'] = $this->getSerial();
        $array['serial_last_3'] = substr($this->getSerial(), -3);
        $array['serial_with_type'] = $this->asset_type->label . $this->getSerial();
        $array['asset_type'] = $this->asset_type->label;
        $array['employee'] = $this->employee->getName();
        $array['product'] = $this->product->model;
        $array['product_maker'] = $this->product->productMaker->name;
        $array['product_type'] = $this->product->productType->name;

        return $array;
    }

    /**
     * Return serial in a correct format
     *
     * @example Input: 12960 | Output: 0012960 || PC
     * @example Input: 150960 | Output: 0150960 || LAPTOP
     *
     * @var string
     */
    public function getSerial(): string
    {
        return sprintf('%07d', $this->serial);
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function asset_type(): BelongsTo
    {
        return $this->belongsTo(AssetType::class);
    }
}
