<?php

namespace App\Http\Controllers;

use App\Models\comptoir;
use App\Models\Customer;
use App\Models\CustomerInvoice;
use App\Models\Product;
use App\Models\PurchaseInvoice;
use App\Models\ReturnCustomer;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('user-access:admin,gerant,gestionnaire');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $purchaseinvoice_sum = PurchaseInvoice::where("status_purchase_invoice", "no_pay")->whereMonth('created_at', Carbon::now()->month)->sum('total_purchase_invoice');
        $customerinvoice_sum = CustomerInvoice::where("status_customer_invoices", "no pay")->whereMonth('created_at', Carbon::now()->month)->sum('total_customer_invoices');
        $totalpurchaseinvoice = PurchaseInvoice::whereMonth('created_at', Carbon::now()->month)->sum('total_purchase_invoice');
        $totalcustomerinvoice = CustomerInvoice::whereMonth('created_at', Carbon::now()->month)->sum('total_customer_invoices');
        $customercount = Customer::all()->count();
        $supplycount = Supplier::all()->count();
        $purchaseInvoicecount = PurchaseInvoice::whereMonth('created_at', Carbon::now()->month)->count();
        $customerInvoicecount = CustomerInvoice::whereMonth('created_at', Carbon::now()->month)->count();
        $purchaseinvoice = PurchaseInvoice::select(DB::raw("sum(total_purchase_invoice) as total_purchase"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('total_purchase', 'month_name');
        $customerinvoice = CustomerInvoice::select(DB::raw("sum(total_customer_invoices) as total_customer"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('total_customer', 'month_name');
        $datapurchase = json_decode($purchaseinvoice->values());
        $datacustomer = json_decode($customerinvoice->values());
        $products = Product::orderBy("id", "asc")->offset(0)->limit(5)->get();
        return view('pages.dashboard.dashboard', compact('purchaseinvoice_sum', 'customerinvoice_sum', 'totalpurchaseinvoice', 'totalcustomerinvoice', 'customercount', 'supplycount', 'purchaseInvoicecount', 'customerInvoicecount', 'products','datapurchase','datacustomer'));
    }

    public function homegerant()
    {
        $purchaseinvoice_sum = PurchaseInvoice::where("status_purchase_invoice", "no_pay")->whereMonth('created_at', Carbon::now()->month)->sum('total_purchase_invoice');
        $customerinvoice_sum = CustomerInvoice::where("status_customer_invoices", "no pay")->whereMonth('created_at', Carbon::now()->month)->sum('total_customer_invoices');
        $totalpurchaseinvoice = PurchaseInvoice::whereMonth('created_at', Carbon::now()->month)->sum('total_purchase_invoice');
        $totalcustomerinvoice = CustomerInvoice::whereMonth('created_at', Carbon::now()->month)->sum('total_customer_invoices');
        $customercount = Customer::all()->count();
        $supplycount = Supplier::all()->count();
        $purchaseInvoicecount = PurchaseInvoice::whereMonth('created_at', Carbon::now()->month)->count();
        $customerInvoicecount = CustomerInvoice::whereMonth('created_at', Carbon::now()->month)->count();
        $purchaseinvoice = PurchaseInvoice::select(DB::raw("sum(total_purchase_invoice) as total_purchase"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('total_purchase', 'month_name');
        $customerinvoice = CustomerInvoice::select(DB::raw("sum(total_customer_invoices) as total_customer"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('total_customer', 'month_name');
        $datapurchase = json_decode($purchaseinvoice->values());
        $datacustomer = json_decode($customerinvoice->values());
        $products = Product::orderBy("id", "asc")->offset(0)->limit(5)->get();
        return view('pages.dashboard.dashboard', compact('purchaseinvoice_sum', 'customerinvoice_sum', 'totalpurchaseinvoice', 'totalcustomerinvoice', 'customercount', 'supplycount', 'purchaseInvoicecount', 'customerInvoicecount', 'products','datapurchase','datacustomer'));
    }
    public function homeuser()
    {
        $totalcomptoir = comptoir::WhereDay('created_at', Carbon::now()->day)->where('users_id',Auth::user()->id)->sum('total_comptoir');
        //$totalreturncustomer = ReturnCustomer::WhereDay('created_at', Carbon::now()->day)->where('users_id',Auth::user()->id)->sum('total_return_customer');
        $customercount = Customer::all()->count();
        $comptoir = comptoir::select(DB::raw("sum(total_comptoir) as total_comptoir"), DB::raw("MONTHNAME(created_at) as month_name"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->where('users_id',Auth::user()->id)
        ->pluck('total_comptoir', 'month_name');
        $datacomptoir = json_decode($comptoir->values());
        $products = Product::orderBy("id", "asc")->offset(0)->limit(5)->get();
        return view('pages.dashboard.homeuser',compact('totalcomptoir','customercount','datacomptoir','products'));
    }
}
