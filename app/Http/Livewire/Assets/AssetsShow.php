<?php

namespace App\Http\Livewire\Assets;

use App\Domain\Assets\Models\Asset;
use Livewire\Component;
use Livewire\WithPagination;

class AssetsShow extends Component
{
    use WithPagination;
    /** @var string */
    public $search = '';

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.assets.index', [
            'data' => Asset::search($this->search)->paginate()
        ]);
    }
}
