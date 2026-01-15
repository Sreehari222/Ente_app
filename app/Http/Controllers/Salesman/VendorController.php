<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Payment;
use App\Models\PaymentInstallment;
use App\Models\Plan;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



class VendorController extends Controller
{
    /* =======================
     * SHOW CREATE FORM
     * ======================= */
    public function create()
    {
        $mainCategories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $plans = Plan::orderBy('amount')->get();

        return view('salesman.vendors.add_vendor', compact('mainCategories', 'plans'));
    }


    /* =======================
     * LOAD CATEGORIES BY MAIN
     * ======================= */
    public function getByMain($mainCategoryId)
    {
        return Category::where('main_category_id', $mainCategoryId)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();
    }

    /* =======================
     * STORE VENDOR
     * ======================= */
    public function store(Request $request)
    {
        // ================= VALIDATION =================
        $request->validate([
            'shop_name' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'digipin' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'google_map' => 'nullable|url',
            'service_area' => 'nullable|string',
            'main_category_id' => 'required|exists:categories,id',
            'category_id' => 'required|exists:categories,id',
            'plan_id' => 'required|exists:plans,id',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
            'payment_mode' => 'required|in:gpay,bank_transfer,cash',
            'transaction_id' => 'nullable|string|max:255',
            'reference_number' => 'nullable|string|max:255',
            'amount' => 'nullable|numeric',
            'emi_duration' => 'nullable|integer|min:1',
            'photo' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'social_links' => 'nullable|array',
            'denominations' => 'nullable|array',
            'special_recommendation' => 'nullable|string',
            'internal_comments' => 'nullable|string',
        ]);

        // ================= FETCH PLAN =================
        $plan = Plan::findOrFail($request->plan_id);

        // ================= EMI CALCULATION =================
        $emiDuration = null;
        $emiAmount = null;

        if ($request->filled('emi_duration') && $request->emi_duration > 0) {
            $emiDuration = (int) $request->emi_duration;
            $emiAmount = round($plan->amount / $emiDuration, 2); // backend-safe
        }

        // ================= CREATE VENDOR =================
        $vendor = new Vendor();
        $vendor->shop_name = $request->shop_name;
        $vendor->owner_name = $request->owner_name;
        $vendor->mobile = $request->mobile;
        $vendor->whatsapp = $request->whatsapp;
        $vendor->email = $request->email;
        $vendor->digipin = $request->digipin;
        $vendor->address = $request->address;
        $vendor->google_map = $request->google_map;
        $vendor->service_area = $request->service_area;

        $vendor->main_category_id = $request->main_category_id;
        $vendor->category_id = $request->category_id;
        $vendor->plan_id = $plan->id;

        $vendor->opening_time = $request->opening_time;
        $vendor->closing_time = $request->closing_time;

        $vendor->payment_mode = $request->payment_mode;
        $vendor->transaction_id = $request->transaction_id;
        $vendor->reference_number = $request->reference_number;
        $vendor->amount = $request->amount;

        // ================= SAVE EMI =================
        $vendor->emi_duration = $emiDuration;
        $vendor->emi_amount = $emiAmount;

        $vendor->special_recommendation = $request->special_recommendation;
        $vendor->internal_comments = $request->internal_comments;

        $vendor->status = 'pending';
        $vendor->created_by = Auth::id();

        // ================= IMAGE UPLOAD =================
        if ($request->hasFile('photo')) {
            $vendor->photo = $request->file('photo')->store('vendors/profile', 'public');
        }

        if ($request->hasFile('gallery')) {
            $galleryPaths = [];
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('vendors/gallery', 'public');
            }
            $vendor->gallery = json_encode($galleryPaths);
        }

        // ================= SOCIAL LINKS =================
        if ($request->filled('social_links')) {
            $vendor->social_links = json_encode(array_values(array_filter($request->social_links)));
        }

        // ================= CASH DENOMINATIONS =================
        if ($request->payment_mode === 'cash' && $request->filled('denominations')) {
            $totalAmount = 0;
            foreach ($request->denominations as $denom => $qty) {
                $totalAmount += ((int)$denom * (int)$qty);
            }
            $vendor->denominations = json_encode($request->denominations);
            $vendor->total_amount = $totalAmount;
        }

        $vendor->save();

        // ================= CREATE PAYMENT =================
        $payment = Payment::create([
            'vendor_id' => $vendor->id,
            'plan_id' => $plan->id,
            'total_amount' => $plan->amount,
            'emi_duration' => $emiDuration,
            'emi_amount' => $emiAmount,
        ]);

        // ================= CREATE INSTALLMENTS =================
        if ($emiDuration && $emiAmount) {
            for ($i = 1; $i <= $emiDuration; $i++) {
                PaymentInstallment::create([
                    'payment_id' => $payment->id,
                    'payment_mode' => $request->payment_mode,
                    'installment_number' => $i,
                    'amount' => $emiAmount,
                    'due_date' => Carbon::now()->addMonths($i)->format('Y-m-d'),
                    'status' => 'pending',
                ]);
            }
        } else {
            // Single installment if no EMI
            PaymentInstallment::create([
                'payment_id' => $payment->id,
                'installment_number' => 1,
                'amount' => $request->amount ?: $plan->amount,
                'due_date' => Carbon::now(),
                'status' => 'paid',
            ]);
        }

        return redirect()->back()->with('success', 'Vendor added successfully with EMI.');
    }


    /* =======================
     * TOGGLE STATUS
     * ======================= */
    public function toggle(Vendor $vendor)
    {
        $this->authorizeVendor($vendor);

        if ($vendor->verification_status !== 'approved') {
            return back()->with('error', 'Vendor not approved by admin yet');
        }

        $vendor->update(['is_active' => !$vendor->is_active]);

        return back()->with('success', 'Vendor status updated.');
    }

    /* =======================
     * AUTH CHECK
     * ======================= */
    public function show(Vendor $vendor)
    {
        $this->authorizeVendor($vendor);

        $mainCategories = Category::orderBy('name')->get();
        $plans = Plan::orderBy('amount')->get();
        $payments = Payment::get();

        $categories = Category::where('main_category_id', $vendor->main_category_id)->get();

        return view('admin.vendor.show', compact(
            'vendor',
            'mainCategories',
            'categories',
            'plans',
            'payments'
        ));
    }

    private function authorizeVendor(Vendor $vendor)
    {
        $user = auth()->user();

        if ($user->user_type === 'provider' && $vendor->provider_id !== $user->id) {
            abort(403);
        }
    }

    public function view(Vendor $vendor)
    {
        $vendor->load(['mainCategory', 'category', 'plan', 'creator']);
        return view('admin.vendors.show', compact('vendor'));
    }

    public function index()
    {
        $vendors = Vendor::where('created_by', auth()->id())->latest()->paginate(10);
        return view('salesman.vendors.vendor_list', compact('vendors'));
    }

    public function destroy($id)
    {
        Vendor::findOrFail($id)->delete();

        return back()->with('success', 'Vendor deleted successfully');
    }

    public function deoindex()
    {
        $deoId = auth()->id(); // DEO id = 3

        // Get all salesmen under this DEO
        $salesmanIds = User::where('role', 'salesman')
            ->where('deo_id', $deoId)
            ->pluck('id');

        // Get vendors under those salesmen
        $vendors = Vendor::whereIn('created_by', $salesmanIds)
            ->latest()
            ->get();

        return view('deo.vendors.index', compact('vendors'));
    }

    public function approve(Vendor $vendor)
    {
        $vendor->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return back()->with('success', 'Vendor approved successfully.');
    }

    public function markPaid(Request $request, PaymentInstallment $installment)
{
    $installment->update([
        'status' => 'paid',
        'paid_at' => Carbon::now(),
        'payment_mode' => $request->payment_mode,
        'transaction_id' => $request->transaction_id,
        'denominations' => $request->denominations,
    ]);

    $payment = $installment->payment;

    if ($payment->installments()->where('status', 'pending')->count() === 0) {
        $payment->update(['status' => 'completed']);
    }

    return back()->with('success', 'EMI marked as paid');
}
}
