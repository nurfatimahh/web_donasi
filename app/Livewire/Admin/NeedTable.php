<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Need;
use Livewire\WithPagination;

class NeedTable extends Component
{
    use WithPagination;

    public $search = '';

    // Reset halaman ke 1 setiap kali mengetik pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $needs = Need::where('nama_barang', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        $needs = Need::where('nama_barang', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(5); // Saya ubah ke 5 dulu untuk tes

        return view('livewire.admin.need-table', [
            'needs' => $needs
        ]);
    }
}