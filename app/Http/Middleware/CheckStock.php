<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Product;

class CheckStock
{
    public function handle(Request $request, Closure $next)
    {
        $productId = $request->route('product') ?? $request->input('product_id');
        if ($productId) {
            $p = Product::find($productId);
            if ($p && $p->quantity <= 0) {
                return back()->with('error', 'Barang sudah habis, silakan tunggu hingga barang di-restock ulang');
            }
        }
        return $next($request);
    }
}
