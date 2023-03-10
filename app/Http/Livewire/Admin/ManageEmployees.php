<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;

class ManageEmployees extends Component
{
    use WithPagination;
    public function render()
    {
        $employees = [];
        return view('livewire.admin.manage-employees', ['employees' => $employees]);
    }
}