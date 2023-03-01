<?php

namespace App\Http\Livewire\Employee;

use App\Models\Level;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ManageLevels extends Component
{
    use WithPagination;

    public $level_id, $level, $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'level' => 'required|string|unique:levels,name|regex:/^[A-Za-z\s]+$/'
    ];

    protected $messages = [
        'level.required' => 'Mere bhai level must hai 😒',
        'level.unique' => 'Yar unique data daal bhangra na daal 😒',
        'level.regex' => 'Jigar sirf letters dalo 🙂'
    ];

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function resetModal()
    {
        $this->resetAllErrors();
        $this->level_id = '';
        $this->level = '';
    }

    public function resetAllErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function renderEditModal($id)
    {
        $data = Level::find($id);
        if ($data) {
            $this->level_id = $data->id;
            $this->level = $data->name;
        } else {
            return redirect()->to(route('emp.levels'))->with('error', 'Record Not Found.');
        }
    }

    public function renderDeleteModal($id)
    {
        $this->level_id = $id;
    }

    public function add()
    {
        $this->validate();
        try {
            /* Perform some operation */
            $inserted = Level::create([
                'name' => $this->level
            ]);
            /* Operation finished */
            $this->resetModal();
            sleep(1);
            $this->dispatchBrowserEvent('close-modal', ['id' => 'addModal']);
            if ($inserted) {
                session()->flash('success', config('messages.INSERTION_SUCCESS'));
            } else {
                session()->flash('error', config('messages.INSERTION_FAILED'));
            }
        } catch (Exception $error) {
            report($error);
            session()->flash('error', config('messages.INVALID_DATA'));
        }
    }

    public function edit()
    {
        $this->validate();
        try {
            /* Perform some operation */
            $updated = Level::where('id', '=', $this->level_id)
                ->update(['name' => $this->level]);
            /* Operation finished */
            $this->resetModal();
            sleep(1);
            $this->dispatchBrowserEvent('close-modal', ['id' => 'editModal']);
            if ($updated) {
                session()->flash('success', config('messages.UPDATION_SUCCESS'));
            } else {
                session()->flash('error', config('messages.UPDATION_FAILED'));
            }
        } catch (Exception $error) {
            report($error);
            session()->flash('error', config('messages.INVALID_DATA'));
        }
    }

    public function destroy()
    {
        try {
            /* Perform some operation */
            $deleted = Level::find($this->level_id)->delete();
            /* Operation finished */
            sleep(1);
            $this->dispatchBrowserEvent('close-modal', ['id' => 'deleteModal']);
            if ($deleted) {
                session()->flash('success', config('messages.DELETION_SUCCESS'));
            } else {
                session()->flash('error', config('messages.DELETION_FAILED'));
            }
        } catch (Exception $error) {
            report($error);
            session()->flash('error', config('messages.INVALID_DATA'));
        }
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Level::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.employee.manage-levels', ['data' => $data]);
    }
}