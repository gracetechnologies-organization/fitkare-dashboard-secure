<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class MenuItems extends Component
{
    use WithFileUploads,WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $price,$previous_media,$media, $menu_item_id;

    protected function rules()
    {
        return [
            'name' => 'required|max:3',
            'price' => 'required|numeric|between:0,10000.00',
            'media' => 'required|mimes:jpeg,png,jpg'
        ];
    }


    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function saveMenuItem()
    {
        $this->validate();
        $insert = Product::create([
            'name' => $this->name,
            'price' => $this->price,
            'user_id' => Auth::user()->id
        ]);
        $insert->addMedia($this->media->getRealPath())->usingFileName($this->media->getFilename())->toMediaCollection();
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'basicModal']);
        if ($insert) {
            session()->flash('success', 'Menu Item Added.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->price = '';
        $this->media = '';
        $this->previous_media = '';
    }

    public function closeModel()
    {
        $this->resetInputs();
    }

    public function editMenuItem($id)
    {
        $menu_item = Product::where('id', '=', $id)->first();
        if ($menu_item) {
            $this->menu_item_id = $menu_item->id;
            $this->name = $menu_item->name;
            $this->price = $menu_item->price;
            $this->previous_media = $menu_item->getFirstMediaUrl();
        } else {
            return redirect()->to(route('menu-items.index'))->with('error', 'Record Not Found.');
        }
    }

    public function updateMenuItem()
    {
        $update = Product::where('id', '=', $this->menu_item_id)->update([
            'name' => $this->name,
            'price' => $this->price,
        ]);
        if (!is_null($this->media)&&!empty($this->media)) {
            $update_media=Product::where('id', '=', $this->menu_item_id)->first();
            $update_media->clearMediaCollection();
            $update_media->addMedia($this->media->getRealPath())->usingFileName($this->media->getFilename())->toMediaCollection();
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'updateModal']);
        if ($update) {
            session()->flash('success', 'Menu Item Updated.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function deleteMenuItem($id)
    {
        $this->menu_item_id = $id;
    }

    public function destroyMenuItem()
    {
        $update_media=Product::where('id', '=', $this->menu_item_id)->first();
        $update_media->clearMediaCollection();
        $delete = Product::find($this->menu_item_id)->delete();
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'deleteModal']);
        if ($delete) {
            session()->flash('success', 'Menu Item Deleted.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function render()
    {
        $menu_items = Product::orderBy('created_at','DESC')->paginate(10);
        return view('livewire.admin.menu-items',['menu_items' => $menu_items]);
    }
}
