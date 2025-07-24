<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\Customer;
use App\Models\Person;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with(['customer', 'person'])->get();
        return Inertia::render('Quotations/Index', ['quotations' => $quotations]);
    }

    public function create()
    {
        $customers = Customer::all();
        $people = Person::all();
        $products = Product::all();
        return Inertia::render('Quotations/Create', [
            'customers' => $customers,
            'people' => $people,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'person_id' => 'required|exists:people,id',
            'quotation_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request) {
            $totalAmount = 0;
            foreach ($request->items as $item) {
                $totalAmount += $item['quantity'] * $item['unit_price'];
            }

            $quotation = Quotation::create([
                'customer_id' => $request->customer_id,
                'person_id' => $request->person_id,
                'quotation_date' => $request->quotation_date,
                'total_amount' => $totalAmount,
            ]);

            foreach ($request->items as $item) {
                $quotation->quotationItems()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }
        });

        return redirect()->route('quotations.index');
    }

    public function show(Quotation $quotation)
    {
        $quotation->load(['customer', 'person', 'quotationItems.product']);
        return Inertia::render('Quotations/Show', ['quotation' => $quotation]);
    }

    public function edit(Quotation $quotation)
    {
        $quotation->load(['quotationItems']); // Load items for editing
        $customers = Customer::all();
        $people = Person::all();
        $products = Product::all();
        return Inertia::render('Quotations/Edit', [
            'quotation' => $quotation,
            'customers' => $customers,
            'people' => $people,
            'products' => $products,
        ]);
    }

    public function update(Request $request, Quotation $quotation)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'person_id' => 'required|exists:people,id',
            'quotation_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $quotation) {
            $totalAmount = 0;
            foreach ($request->items as $item) {
                $totalAmount += $item['quantity'] * $item['unit_price'];
            }

            $quotation->update([
                'customer_id' => $request->customer_id,
                'person_id' => $request->person_id,
                'quotation_date' => $request->quotation_date,
                'total_amount' => $totalAmount,
            ]);

            // Delete existing items and re-create them
            $quotation->quotationItems()->delete();
            foreach ($request->items as $item) {
                $quotation->quotationItems()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                ]);
            }
        });

        return redirect()->route('quotations.index');
    }

    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return redirect()->route('quotations.index');
    }
}
