<?php

namespace App\Http\Livewire\Employee;

use App\Models\Category;
use App\Models\Exercise;
use App\Models\Level;
use App\Models\Program;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $total_categories = Category::count();
        $total_levels = Level::count();
        $total_programs = Program::count();
        $total_exercises = Exercise::count();
        return view('livewire.employee.dashboard', [
            'total_categories' => $total_categories,
            'total_levels' => $total_levels,
            'total_programs' => $total_programs,
            'total_exercises' => $total_exercises
        ]);
    }
}