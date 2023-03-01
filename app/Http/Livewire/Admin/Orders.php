<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $product, $qty, $order_detail;
    public $i = 0;
    public $inputs = [];
    public $products = [];

    protected function rules()
    {
        return [
            'product.0' => 'required',
            'qty.0' => 'required|numeric|between:1,1000',
            'product.*' => 'required',
            'qty.*' => 'required|numeric|between:1,1000',
        ];
    }

    protected $messages = [
        'product.0.required' => 'Item is required.',
        'qty.0.required' => 'Quantity is required.',
        'qty.0.numeric' => 'Quantity should be numbers.',
        'qty.0.between' => 'Quantity should be between 1 to 1000.',
        'product.*.required' => 'Item is required.',
        'qty.*.required' => 'Quantity is required.',
        'qty.*.numeric' => 'Quantity should be numbers.',
        'qty.*.between' => 'Quantity should be between 1 to 1000.',

    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function add($i, $p_id)
    {
        if (!in_array($p_id, $this->products)) {
            $this->product[$i] = Product::where('id', '=', $p_id)->first()->name;
            $this->products[$i] = $p_id;
            array_push($this->inputs, $i);
            ++$this->i;
        } else {
            $this->remove($i);
        }
    }

    public function remove($i)
    {
        unset($this->products[$i]);
        unset($this->inputs[$i]);
        --$this->i;
    }

    public function saveOrder()
    {
        $this->validate();
        $total=0;
        foreach ($this->product as $key => $value) {
            $total += Product::where('id','=',$this->products[$key])->first()->price * $this->qty[$key];
        }
        $insert = Order::create([
            'total_bill' => $total,
            'user_id' => Auth::user()->id
        ]);
        foreach ($this->product as $key => $value) {
            OrderItem::create([
                'order_id' => $insert->id,
                'prod_id' => $this->products[$key],
                'qty' => $this->qty[$key]
            ]);
        }
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'basicModal']);
        if ($insert) {
            session()->flash('success', 'Order Added.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function resetInputs()
    {
        unset($this->product);
        $this->product = [];
        unset($this->qty);
        $this->qty = [];
        unset($this->inputs);
        $this->inputs = [];
        unset($this->products);
        $this->products = [];
        $this->order_detail = null;
    }

    public function closeModel()
    {
        $this->resetInputs();
    }

    public function editOrder($id)
    {
        $order = Order::where('id', '=', $id)->first();
        if ($order) {
            $this->order_detail = $order;
        } else {
            return redirect()->to(route('emp.orders'))->with('error', 'Record Not Found.');
        }
    }

    public function updateOrder()
    {
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'updateModal']);
        if (false) {
            session()->flash('success', 'Order Updated.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }

    public function deleteOrder($id)
    {
        $order = Order::where('id', '=', $id)->first();
        if ($order) {
            $this->order_detail = $order;
        } else {
            return redirect()->to(route('emp.orders'))->with('error', 'Record Not Found.');
        }
    }

    public function destroyOrder()
    {
        $delete = Order::find($this->order_detail->id)->delete();
        $this->resetInputs();
        $this->dispatchBrowserEvent('close-modal', ['id' => 'deleteModal']);
        if ($delete) {
            session()->flash('success', 'Order Deleted.');
        } else {
            session()->flash('error', 'Try Again.');
        }
    }
    public function render()
    {
        $menu_items = Product::all();
        $orders = Order::orderBy('created_at', 'DESC')->paginate(10);
        return view('livewire.admin.orders',['orders' => $orders, 'menu_items' => $menu_items]);
    }
}
