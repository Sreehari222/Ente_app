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
        $mainCategories = Category::orderBy('name')->get();
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

        $request->validate([
            'shop_name'        => 'required|string|max:255',
            'main_category_id' => 'required|exists:main_categories,id',
            'category_id'      => 'required|exists:categories,id',
            'mobile'           => 'required|string|max:20',
            'plan_id'          => 'required|exists:plans,id',

            'photo'            => 'nullable|image|max:2048',
            'gallery.*'        => 'nullable|image|max:2048',

            'payment_mode'     => 'required|in:gpay,bank_transfer,cash',
            'transaction_id'   => 'nullable|required_if:payment_mode,gpay,bank_transfer',
        ]);

        /* PHOTO */
        $photo = $request->hasFile('photo')
            ? $request->file('photo')->store('vendors/photos', 'public')
            : null;

        /* GALLERY */
        $gallery = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->gallery as $img) {
                $gallery[] = $img->store('vendors/gallery', 'public');
            }
        }

        /* SOCIAL LINKS */
        /* SOCIAL LINKS */
        $socialLinks = [];

        if ($request->has('social_type') && $request->has('social_link')) {
            foreach ($request->social_type as $index => $type) {
                $link = $request->social_link[$index] ?? null;

                if (!empty($type) && !empty($link)) {
                    $socialLinks[] = [
                        'type' => $type,
                        'link' => $link,
                    ];
                }
            }
        }


        /* CREATE VENDOR */
        $vendor = Vendor::create([
            'provider_id' => Auth::id(),
            'shop_name'   => $request->shop_name,
            'owner_name'  => $request->owner_name,
            'email'       => $request->email,
            'digipin'     => $request->digipin,
            'mobile'      => $request->mobile,
            'whatsapp'    => $request->whatsapp,
            'address'     => $request->address,
            'google_map'  => $request->google_map,
            'service_area' => $request->service_area,

            'main_category_id' => $request->main_category_id,
            'category_id'      => $request->category_id,
            'plan_id'          => $request->plan_id,

            'opening_time' => $request->opening_time,
            'closing_time' => $request->closing_time,
            'mode'            => $request->payment_mode,
            'transaction_id'  => $request->transaction_id,
            'reference_number' => $request->reference_number,

            'photo'  => $photo,
            'gallery' => $gallery,

            'social_links' => $socialLinks,
            'special_recommendation' => $request->special_recommendation,
            'internal_comments'      => $request->internal_comments,

            'verification_status' => 'pending',
            'is_active' => false,
        ]);

        /* PAYMENT */
        Payment::create([
            'vendor_id'       => $vendor->id,
            'mode'            => $request->payment_mode,
            'transaction_id'  => $request->transaction_id,
            'reference_number' => $request->reference_number,
            'status'          => in_array($request->payment_mode, ['gpay', 'bank_transfer'])
                ? 'completed'
                : 'pending',


        ]);

        return redirect()
            ->route('sales.add-vendor')
            ->with('success', 'Vendor added successfully. Waiting for admin approval.');
    }


    /* =======================
     * LIST VENDORS
     * ======================= */
    public function index(Request $request)
    {
        $vendors = Vendor::where('provider_id', Auth::id())
            ->when(
                $request->shop_name,
                fn($q) =>
                $q->where('shop_name', 'like', "%{$request->shop_name}%")
            )
            ->when(
                $request->plan_id,
                fn($q) =>
                $q->where('plan_id', $request->plan_id)
            )
            ->latest()
            ->paginate(10);

        return view('sales.vendor_list', compact('vendors'));
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
