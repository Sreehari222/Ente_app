<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function allOffer()
    {
         $offers = Offer::latest()->get();
        return view('admin.all_offer', compact('offers'));
    }

    public function create()
{
    // get all sub categories (service + shop)
    $categories = \App\Models\Category::all();

    return view('admin.add_offer', compact('categories'));
}
public function store(Request $request)
{
    $request->validate([
        'offerTitle'     => 'required|string|max:255',
        'discountType'   => 'required',
        'discountValue'  => 'required|numeric',
        'startDate'      => 'required|date',
        'endDate'        => 'required|date|after_or_equal:startDate',
        'offerStatus'    => 'required|in:active,inactive',
        'category_ids'   => 'required|array',
        'offerImage'     => 'nullable|image|max:5120',
    ]);

    // ✅ store image correctly
    $imagePath = null;
    if ($request->hasFile('offerImage')) {
        $imagePath = $request->file('offerImage')->store('offers', 'public');
    }

    $offer = Offer::create([
        'title'          => $request->offerTitle,
        'discount_type'  => $request->discountType,
        'discount_value' => $request->discountValue,
        'start_date'     => $request->startDate,
        'end_date'       => $request->endDate,
        'status'         => $request->offerStatus,
        'target_url'     => $request->targetUrl,
        'image'          => $imagePath, // ✅ THIS was missing before
    ]);

    $offer->categories()->sync($request->category_ids);

    return redirect()
        ->route('admin.all-offers')
        ->with('success', 'Offer created successfully.');
}


    public function destroy(Offer $offer)
    {
        if ($offer->image && Storage::disk('public')->exists($offer->image)) {
            Storage::disk('public')->delete($offer->image);
        }
        
        $offer->delete();

        return back()->with('success', 'Offer deleted successfully.');
    }
    public function scheduledOffers()
    {
        return view('admin.scheduled_offer');
    }
}