<?php
namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInvoiceRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InvoiceController extends Controller
{
    public function create()
    {
        // show checkout page / faktur creation page with cart (assume cart stored in session)
        $cart = session()->get('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();
        return view('invoices.create', compact('cart','products'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();
        $items = $data['items'];

        DB::beginTransaction();
        try {
            $invoiceNumber = $this->generateInvoiceNumber();

            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'user_id' => auth()->id(),
                'shipping_address' => $data['shipping_address'],
                'postal_code' => $data['postal_code'],
                'total' => 0,
            ]);

            $total = 0;
            foreach ($items as $it) {
                $product = Product::lockForUpdate()->findOrFail($it['product_id']);
                if ($product->quantity < $it['quantity']) {
                    DB::rollBack();
                    return back()->withErrors(['quantity' => "Stok tidak cukup untuk produk: {$product->name}"]);
                }
                $unit = $product->price;
                $subtotal = $unit * $it['quantity'];
                InvoiceItem::create([
                    'invoice_id' => $invoice->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $it['quantity'],
                    'unit_price' => $unit,
                    'subtotal' => $subtotal,
                ]);
                // kurangi stok
                $product->decrement('quantity', $it['quantity']);
                $total += $subtotal;
            }

            $invoice->update(['total' => $total]);

            DB::commit();

            // optionally clear cart session
            session()->forget('cart');

            return redirect()->route('invoices.show', $invoice->id)->with('success','Faktur berhasil dibuat.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: '.$e->getMessage()]);
        }
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('items');
        return view('invoices.show', compact('invoice'));
    }

    protected function generateInvoiceNumber()
    {
        // Format: INVYYYYMMDDHHMMSSxxxxxxxx (unique)
        return 'INV' . now()->format('YmdHis') . strtoupper(Str::random(4));
    }
}
