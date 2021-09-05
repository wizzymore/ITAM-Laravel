<?php

namespace App\Http\Livewire\Assets;

use App\Domain\Assets\Exports\AssetsExport;
use App\Domain\Assets\Models\Asset;
use App\Domain\Assets\Models\AssetType;
use App\Domain\Assets\Models\Product;
use App\Domain\Assets\Models\ProductMaker;
use App\Domain\Assets\Models\ProductType;
use App\Domain\Assets\Support\Exports\FileFormat;
use App\Domain\Employees\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class AssetEdit extends Component
{
    use WithPagination;

    /** @var int */
    public $serial = 0;

    /** @var int */
    public $employee = 0;

    /** @var int */
    public $productType = 0;

    /** @var int */
    public $productMaker = 0;

    /** @var int */
    public $product = 0;

    /** @var string */
    public $asset_type = '';

    /** @var string */
    public $status = '';

    public $asset = null;

    public function mount($assetId)
    {
        $asset = Asset::find($assetId);
        if (!$asset)
            abort(404);

        $this->asset = $asset;

        $this->serial = $asset->getSerial();
        $this->asset_type = $asset->asset_type->id;
        $this->employee = $asset->employee->id;
        $this->product = $asset->product->id;
        $this->productMaker = $asset->product->productMaker->id;
        $this->productType = $asset->product->productType->id;
        $this->status = $asset->status;
    }

    public function updatedProductMaker()
    {
        $this->product = -1;
        $this->productType = -1;
    }

    public function save()
    {
        $this->asset->serial = $this->serial;
        $this->asset->employee_id = $this->employee;
        $this->asset->product_id = $this->product;
        $this->asset->asset_type_id = $this->asset_type;
        $this->asset->status = $this->status;

        $this->asset->save();

        $this->emit('saved');
    }

    public function export($exportType)
    {
        return Excel::download(new AssetsExport([$this->serial], $exportType), FileFormat::formatExport($this->asset, $exportType));
    }

    public function render()
    {
        return view('livewire.assets.edit', [
            'asset' => $this->asset,
            'assetTypes' => AssetType::all(),
            'employees' => Employee::all(),
            'productMakers' => ProductMaker::all(),
            'productTypes' => ProductType::whereRelation('products', 'product_maker_id', $this->productMaker)->get(),
            'products' => Product::where('product_maker_id', $this->productMaker)->where('product_type_id', $this->productType)->get(),
            'statuses' => ['active', 'in-service', 'inactive']
        ]);
    }
}
