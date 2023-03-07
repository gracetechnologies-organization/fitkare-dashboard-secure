<?php

namespace App\Http\Livewire\Employee;

use App\Models\User;
use Auth;
use Livewire\Component;

class Profile extends Component
{
    public function render()
    {
        $data = User::find(Auth::user()->id);
        return view('livewire.employee.profile', ['data' => $data]);
    }
}