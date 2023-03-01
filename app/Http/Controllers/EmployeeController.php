<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\AuthenticatedSessionController as AuthAuthenticatedSessionController;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display the Employee dashboard index view.
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $active = 'dashboard';
        $currentMonth = Carbon::now()->startOfMonth();
        $mostSold = OrderItem::selectRaw('prod_id, sum(qty) as sum')
            ->groupBy('prod_id')
            ->orderByDesc('sum')->whereBetween('created_at', [$currentMonth, Carbon::now()])
            ->first();
        // $totalSelling = Order::where('user_id', Auth::user()->id)
        //     ->whereBetween('created_at', [$currentMonth, Carbon::now()])
        //     ->sum('total_bill');
        if(!is_null($mostSold)){
            $mostSoldProduct = Product::find($mostSold->prod_id);
        }else{
            $mostSoldProduct='N/A';
        }
        return view('livewire.employee.index', compact('active', 'mostSoldProduct'));
    }
    public function orders()
    {
        $active = 'orders';
        return view('livewire.employee.orders', compact('active'));
    }
    public function profile()
    {
        $active = '';
        $user = User::where('id', '=', Auth::user()->id)->first();
        return view('employee.profile', compact('user', 'active'));
    }
    public function update_emp(Request $req)
    {
        $req->validate([
            'name' => 'required',
        ]);
        $update = User::where('id', '=', $req->id)->update([
            'name' => $req->name,
        ]);
        if ($update) {
            $logout = new AuthAuthenticatedSessionController();
            return $logout->destroy($req);
        } else {
            return redirect()->back()->with('error', 'Try Again');
        }
    }

    public function update_emp_password(Request $req)
    {
        $req->validate([
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|min:8'
        ]);
        $update = User::where('id', '=', $req->id)->update([
            'password' => Hash::make($req->password)
        ]);
        if ($update) {
            $logout = new AuthAuthenticatedSessionController();
            return $logout->destroy($req);
        } else {
            return redirect()->back()->with('error', 'Try Again');
        }
    }

    public function categories(){
        $obj = new Category;
        dd($obj->showCategories());
    }
}
