<?php

namespace App\Domain\Assets\Exports;

use App\Domain\Assets\Models\Asset;
use Faker\Core\Number;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AssetsExport implements FromCollection, WithMapping, WithColumnFormatting, WithHeadings
{
    private $serials;
    private $exportType;

    public function __construct(array $serials = [], string $exportType)
    {
        $this->serials = $serials;
        $this->exportType = $exportType;
    }

    public function headings(): array
    {
        return [
            '#',
            'asset_type',
            'serial',
            'employee_name',
            'employee_email',
            'product_model',
            'product_type',
            'product_maker',
            'aviz',
            'invoice',
            'service_tag',
            'status',
            'created_at'
        ];
    }

    public function map($asset): array
    {
        return [
            $asset->id,
            $asset->asset_type->label,
            $asset->serial,
            $asset->employee->getName(),
            $asset->employee->email,
            $asset->product->model,
            $asset->product->productType->name,
            $asset->product->productMaker->name,
            $asset->aviz,
            $asset->invoice,
            $asset->service_tag,
            $asset->status,
            $this->isCsv() ? $asset->created_at : Date::dateTimeToExcel($asset->created_at)
        ];
    }

    private function isCsv(): bool
    {
        return $this->exportType === 'csv';
    }

    public function columnFormats(): array
    {
        if ($this->isCsv()) return [];
        return [
            'M' => NumberFormat::FORMAT_DATE_DATETIME
        ];
    }

    public function collection()
    {
        if ($this->serials) {
            return Asset::whereIn('serial', $this->serials)->get();
        }
        return Asset::all();
    }
}
