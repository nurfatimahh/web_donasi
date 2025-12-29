<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Donation;
use Livewire\WithPagination;

class DonationTable extends Component
{
    use WithPagination;

    public $search = '';
    public $type = '';
    public $sort = '';
    public $status = '';

    // Penting agar saat search, pagination balik ke halaman 1
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Donation::with(['user', 'need']);

        // Search logic
        if ($this->search) {
            $query->where('nama_donatur', 'like', '%' . $this->search . '%');
        }

        // Filter Type logic
        if ($this->type) {
            $query->where('jenis_donasi', $this->type);
        }

        // Sort logic
        if ($this->sort == 'highest') {
            $query->orderBy('nominal', 'desc');
        } else {
            $query->latest();
        }

        // Filter Status logic
        if ($this->status) {
            $query->where('status', $this->status);
        }

        return view('livewire.admin.donation-table', [
            'donations' => $query->paginate(10)
        ]);
    }
}