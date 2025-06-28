<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\OfferAndDiscount;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class OfferAndDiscountOcntroller extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $offersAndDiscounts = OfferAndDiscount::select('id', 'title', 'type', 'value', 'start_date', 'end_date');

            return DataTables::of($offersAndDiscounts)
                ->addColumn('action', function ($offerOrDiscount) {
                    return '<a href="' . route('admin.offer.edit', $offerOrDiscount->id) . '" class="btn btn-sm btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-sm btn-danger delete-btn" data-id="' . $offerOrDiscount->id . '">
                                <i class="fas fa-trash-alt"></i>
                            </a>';
                })
                ->editColumn('value', function ($offerOrDiscount) {
                    return $offerOrDiscount->type === 'percentage' ? $offerOrDiscount->value . '%' : '$' . $offerOrDiscount->value;
                })
                ->make(true);
        }

        return view('admin.offer.index');
    }

    public function fontIndex()
    {
        $offersAndDiscounts = OfferAndDiscount::get();
        // dd($offersAndDiscounts);
        // return view('admin.offer.index', compact('offersAndDiscounts'));
    }

    public function create()
    {
        return view('admin.offer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:percentage,amount',
            'value' => 'required|numeric|min:0',
            'code' => 'required|',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'up_to_off'=>'nullable',
            'complete_off_on'=>'nullable',
            'show_on_site' => 'required|boolean',
            'usage_limit'=> 'nullable|integer|min:1',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('offers', 'public');
            $validated['image'] = $imagePath;
        }

        OfferAndDiscount::create($validated);

        return redirect()->route('admin.offer')
            ->with('success', 'Offer and discount created successfully.');
    }

    public function edit($id)
    {
        $offerAndDiscount = OfferAndDiscount::findOrFail($id);
        return view('admin.offer.edit', compact('offerAndDiscount'));
    }

    public function update(Request $request, $id)
    {
        // Find the existing offer and discount
        $offerAndDiscount = OfferAndDiscount::findOrFail($id);

        // Validate the incoming data
        $validated = $request->validate([
            'type' => 'required|in:percentage,amount',
            'value' => 'required|numeric',
            'code' => 'required|',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|max:2048',
            'up_to_off'=>'nullable',
            'complete_off_on'=>'nullable',
            'show_on_site' => 'required|boolean',
            'usage_limit'=> 'nullable|integer|min:1',
        ]);

        $offerAndDiscount->type = $validated['type'];
        $offerAndDiscount->value = $validated['value'];
        $offerAndDiscount->code = $validated['code'];
        $offerAndDiscount->start_date = $validated['start_date'];
        $offerAndDiscount->end_date = $validated['end_date'];
        $offerAndDiscount->title = $validated['title'];
        $offerAndDiscount->description = $validated['description'];
        $offerAndDiscount->up_to_off= $validated['up_to_off'];
        $offerAndDiscount->complete_off_on= $validated['complete_off_on'];
        $offerAndDiscount->show_on_site = $validated['show_on_site'];
        $offerAndDiscount->usage_limit = $validated['usage_limit'];
        if ($request->hasFile('image')) {
            if ($offerAndDiscount->image) {
                Storage::delete($offerAndDiscount->image);
            }
            $imagePath = $request->file('image')->store('offers', 'public');
            $offerAndDiscount->image = $imagePath;
        }

        $offerAndDiscount->save();

        return redirect()->route('admin.offer')->with('success', 'Offer and Discount updated successfully.');
    }

    public function destroy($id)
    {
        $offerAndDiscount = OfferAndDiscount::findOrFail($id);
        if ($offerAndDiscount->image) {
            Storage::delete($offerAndDiscount->image);
        }
        $offerAndDiscount->delete();
        return redirect()->route('admin.offer')->with('success', 'Offer and Discount deleted successfully.');
    }
}
