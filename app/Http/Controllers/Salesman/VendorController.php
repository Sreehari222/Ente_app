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

        return view('sales.add_vendor', compact('mainCategories', 'plans'));
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

            'photo' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
        ]);

        /* ================= PHOTO ================= */
        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')
                ->store('vendors/profile', 'public');
        }

        /* ================= GALLERY ================= */
        if ($request->hasFile('gallery')) {
            $gallery = [];
            foreach ($request->file('gallery') as $image) {
                $gallery[] = $image->store('vendors/gallery', 'public');
            }
            $validated['gallery'] = $gallery;
        }

        /* ================= SOCIAL LINKS ================= */
        if ($request->has('social_links')) {
            $validated['social_links'] = $request->social_links;
        }

        /* ================= META ================= */
        $validated['created_by'] = Auth::id();
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

        $mainCategories = Category::orderBy('name')->get();
        $categories = Category::where('main_category_id', $vendor->main_category_id)->get();
        $plans = Plan::orderBy('amount')->get();

        return view('sales.edit_vendor', compact(
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
        $this->authorizeVendor($vendor);

        $request->validate([
            'shop_name'        => 'required',
            'main_category_id' => 'required|exists:main_categories,id',
            'category_id'      => 'required|exists:categories,id',
            'mobile'           => 'required',
            'plan_id'          => 'required|exists:plans,id',
        ]);

        $data = $request->only([
            'shop_name',
            'main_category_id',
            'category_id',
            'owner_name',
            'referral_number',
            'mobile',
            'whatsapp',
            'address',
            'google_map',
            'opening_time',
            'closing_time',
            'service_area',
            'special_recommendation',
            'plan_id',
        ]);

        /* ---------- Replace Photo ---------- */
        if ($request->hasFile('photo')) {
            if ($vendor->photo) {
                Storage::disk('public')->delete($vendor->photo);
            }
            $data['photo'] = $request->file('photo')->store('vendors/photos', 'public');
        }

        /* ---------- Replace Gallery ---------- */
        if ($request->hasFile('gallery')) {
            if ($vendor->gallery) {
                foreach ($vendor->gallery as $old) {
                    Storage::disk('public')->delete($old);
                }
            }

            $gallery = [];
            foreach ($request->gallery as $img) {
                $gallery[] = $img->store('vendors/gallery', 'public');
            }
            $data['gallery'] = $gallery;
        }

        $vendor->update($data);

        return back()->with('success', 'Vendor updated successfully.');
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
}
