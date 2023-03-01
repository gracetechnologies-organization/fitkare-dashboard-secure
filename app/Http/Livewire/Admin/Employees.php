<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Employees extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $email, $password, $employee_id;

    protected function rules()
    {
        return [
            'name' => 'required|max:30',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ];
    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveEmployee()
    {
        $this->validate();
        $insert = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => 'emp',
        ]);
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'basicModal']);
        if ($insert) {
            session()->flash('success', 'Employee Added.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function closeModel()
    {
        $this->resetInputs();
    }

    public function editEmployee($id)
    {
        $employee = User::where('id', '=', $id)->first();
        if ($employee) {
            $this->employee_id = $employee->id;
            $this->name = $employee->name;
            $this->email = $employee->email;
        } else {
            return redirect()->to(route('employees.index'))->with('error', 'Record Not Found.');
        }
    }

    public function updateEmployee()
    {
        $update = User::where('id', '=', $this->employee_id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        if (!is_null($this->password)) {
            User::where('id', '=', $this->employee_id)->update([
                'password' => Hash::make($this->password)
            ]);
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'updateModal']);
        if ($update) {
            session()->flash('success', 'Employee Updated.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function deleteEmployee($id)
    {
        $this->employee_id = $id;
    }

    public function destroyEmployee()
    {
        $delete = User::find($this->employee_id)->delete();
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'deleteModal']);
        if ($delete) {
            session()->flash('success', 'Employee Deleted.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function render()
    {
        $employees = User::where('role_id', '=', 'emp')->orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.employees', ['employees' => $employees]);
    }
}