<?php

namespace App\Http\Livewire\Employee;

use App\Models\Program;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class ManagePrograms extends Component
{
    use WithPagination;

    public $program_id, $program, $search = '';

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'program' => 'required|string|unique:programs,name|regex:/^[A-Za-z\s]+$/'
    ];

    protected $messages = [
        'program.required' => 'Mere bhai program must hai 😒',
        'program.unique' => 'Yar unique data daal bhangra na daal 😒',
        'program.regex' => 'Jigar sirf letters dalo 🙂'
    ];

    public function updated($property_name)
    {
        $this->validateOnly($property_name);
    }

    public function resetModal()
    {
        $this->resetAllErrors();
        $this->program_id = '';
        $this->program = '';
    }

    public function resetAllErrors()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function renderEditModal($id)
    {
        $data = Program::find($id);
        if ($data) {
            $this->program_id = $data->id;
            $this->program = $data->name;
        } else {
            return redirect()->to(route('emp.programs'))->with('error', 'Record Not Found.');
        }
    }

    public function renderDeleteModal($id)
    {
        $this->program_id = $id;
    }

    public function add()
    {
        $this->validate();
        try {
            /* Perform some operation */
            $inserted = Program::create([
                'name' => $this->program
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
            $updated = Program::where('id', '=', $this->program_id)
                ->update(['name' => $this->program]);
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
            $deleted = Program::find($this->program_id)->delete();
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
        $data = Program::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('livewire.employee.manage-programs', ['data' => $data]);
    }
}