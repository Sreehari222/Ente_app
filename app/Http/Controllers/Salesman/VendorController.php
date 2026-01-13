<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MainCategory;
use App\Models\Payment;
use App\Models\Plan;
use App\Models\User;
use App\Models\Vendor;
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
        $validated = $request->validate([
            'shop_name' => 'required|string|max:255',
            'owner_name' => 'nullable|string|max:255',
            'mobile' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'digipin' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'google_map' => 'nullable|url',
            'service_area' => 'nullable|string',
            'main_category_id' => 'required|integer',
            'category_id' => 'required|integer',
            'plan_id' => 'required|integer',
            'opening_time' => 'nullable',
            'closing_time' => 'nullable',
            'payment_mode' => 'required|string',
            'transaction_id' => 'nullable|string',
            'reference_number' => 'nullable|string',
            'special_recommendation' => 'nullable|string',
            'internal_comments' => 'nullable|string',
            'denominations.*' => 'nullable|integer|min:0',
            'photo' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        // ================= PHOTO =================
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('vendors/profile', 'public');
        }

        // ================= GALLERY =================
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('vendors/gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        // ================= SOCIAL LINKS =================
        if ($request->has('social_links')) {
            $validated['social_links'] = $request->social_links;
        }

        // ================= DENOMINATIONS =================
        $denominations = $request->input('denominations', []);
        $totalAmount = 0;
        foreach ($denominations as $value => $count) {
            $totalAmount += $value * $count;
        }
        $validated['denominations'] = $denominations;
        $validated['total_amount'] = $totalAmount;

        // ================= META =================
        $validated['created_by'] = auth()->id();
        $validated['status'] = 'pending';

        Vendor::create($validated);

        return back()->with('success', 'Vendor submitted for admin approval');
    }



    /* =======================
     * EDIT FORM
     * ======================= */
    public function edit(Vendor $vendor)
    {
        $this->authorizeVendor($vendor);

        // Main categories (parent_id = NULL)
        $mainCategories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        $categories = Category::where('parent_id', $vendor->main_category_id)
            ->orderBy('name')
            ->get();

        $plans = Plan::orderBy('amount')->get();

        return view('salesman.vendors.edit_vendor', compact(
            'vendor',
            'mainCategories',
            'categories',
            'plans'
        ));
    }


    /* =======================
     * UPDATE VENDOR
     * ======================= */
    public function update(Request $request, Vendor $vendor)
{
    $validated = $request->validate([
        'shop_name' => 'required|string|max:255',
        'owner_name' => 'nullable|string|max:255',
        'mobile' => 'required|string|max:20',
        'whatsapp' => 'nullable|string|max:20',
        'email' => 'nullable|email',
        'digipin' => 'nullable|string|max:10',
        'address' => 'nullable|string',
        'google_map' => 'nullable|url',
        'service_area' => 'nullable|string',
        'main_category_id' => 'required|integer',
        'category_id' => 'required|integer',
        'plan_id' => 'required|integer',
        'opening_time' => 'nullable',
        'closing_time' => 'nullable',
        'payment_mode' => 'required|string',
        'transaction_id' => 'nullable|string',
        'reference_number' => 'nullable|string',
        'special_recommendation' => 'nullable|string',
        'internal_comments' => 'nullable|string',
        'denominations.*' => 'nullable|integer|min:0',
        'photo' => 'nullable|image|max:2048',
        'gallery.*' => 'nullable|image|max:2048',
    ]);

    // ================= PHOTO =================
     if ($request->hasFile('photo')) {
        if ($vendor->photo && Storage::disk('public')->exists($vendor->photo)) {
            Storage::disk('public')->delete($vendor->photo);
        }
        $validated['photo'] = $request->file('photo')->store('vendors/profile', 'public');
    } else {
        $validated['photo'] = $vendor->photo; // keep old photo
    }

    // ================= GALLERY =================
    if ($request->hasFile('gallery')) {
        $gallery = $vendor->gallery ?? []; // existing images
        foreach ($request->file('gallery') as $image) {
            $gallery[] = $image->store('vendors/gallery', 'public');
        }
        $validated['gallery'] = $gallery;
    } else {
        $validated['gallery'] = $vendor->gallery; // preserve old
    }

    // ================= SOCIAL LINKS =================
    if ($request->has('social_links')) {
        $validated['social_links'] = $request->social_links;
    } else {
        $validated['social_links'] = $vendor->social_links; // preserve old
    }

    // ================= DENOMINATIONS =================
    $denominations = $request->input('denominations', $vendor->denominations ?? []);
    $totalAmount = 0;
    foreach ($denominations as $value => $count) {
        $totalAmount += $value * $count;
    }
    $validated['denominations'] = $denominations;
    $validated['total_amount'] = $totalAmount;

    // ================= META =================
    $validated['created_by'] = $vendor->created_by; // keep original creator
    $validated['status'] = $vendor->status;        // preserve current status

    $vendor->update($validated);

   return redirect()->route('salesman.vendor-list')->with('success', 'Vendor updated successfully');

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
}
