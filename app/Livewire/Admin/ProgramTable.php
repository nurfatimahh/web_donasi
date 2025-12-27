<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Program;
use Livewire\WithPagination;

class ProgramTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $programs = Program::where('nama_program', 'like', '%' . $this->search . '%')
            ->latest()
            ->paginate(10);

        return view('livewire.admin.program-table', [
            'programs' => $programs
        ]);
    }
}