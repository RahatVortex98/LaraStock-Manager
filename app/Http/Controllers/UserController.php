<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Orders; // Import the Orders model
use App\Models\OrderItem; // Import the OrderItem model
use Illuminate\Support\Facades\DB; // Use DB for transaction
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
public function dashboard(){
    $user = Auth::user();

    // 1. Check if the user is an admin and redirect them away from the user dashboard
    if ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // 2. Only proceed if the user role is 'user' (or if you allow other roles)
    if ($user->role == 'user') {
        // Load products for the table
        $products = Product::with(['supplier', 'category'])->get();
        return view('dashboard', compact('products'));
    }

    // If, for some reason, the user is logged in but has neither 'user' nor 'admin' role, 
    // it's safer to log them out or send them to a generic landing page.
    return abort(403, 'Unauthorized role.');
}

    public function userProductIndex(){
        $products = Product::with(['supplier','category'])->get();
        return view('user.product-index',compact('products'));
    }
    public function userProductShow(Product $product){  
        
        return view('user.product-show',compact('product'));
    }

 
    public function userStoreOrder(Request $request)
    {
        // 1. Retrieve order data from the Session (the Cart)
    $order_items_data = Session::get('cart', []);
    
    // Check if the cart is empty
    if (empty($order_items_data)) {
        return redirect()->route('user.cart.index')->with('error', 'Your order is empty. Please add items before submitting.');
    }

    // Prepare lists of product IDs and retrieve them from the database
    $product_ids = array_column($order_items_data, 'product_id');
    // Ensure all products are still available/valid in the DB
    $products = Product::whereIn('id', $product_ids)->get()->keyBy('id');
    $total_price = 0;

    // 2. Start a database transaction
    DB::beginTransaction();

    try {
        // 3. Calculate total price and prepare final order items array
        $finalOrderItems = [];
        
        foreach ($order_items_data as $item) {
            $product = $products->get($item['product_id']);
            
            // Re-validate availability/existence
            if (!$product || $product->Qty < $item['qty']) {
                throw new \Exception("Product '{$item['name']}' is out of stock or unavailable for the requested quantity ({$item['qty']}).");
            }

            $price = $product->unit_price; // Use price stored in DB or Session price
            $line_total = $price * $item['qty'];
            $total_price += $line_total;

            $finalOrderItems[] = [
                'product_id' => $product->id,
                'Qty' => $item['qty'],
                'price' => $price, 
            ];
            
            // OPTIONAL: Reduce stock in the Product table
            // $product->decrement('Qty', $item['qty']); 
        }

        // 4. Create the main Order
        $order = Orders::create([
            'user_id' => Auth::id(),
            'total_price' => $total_price,
            'status' => 'pending', 
        ]);

        // 5. Create the Order Items and link them to the Order
        foreach ($finalOrderItems as $item) {
            // NOTE: Change 'orderItems()' to 'items()' to match your Orders model
            $order->items()->create($item); 
        }
        
        // 6. Clear the session cart after successful order creation
        Session::forget('cart');

        // 7. Commit the transaction
        DB::commit();

        // NOTE: If you implemented the stock reduction, this is where it would be safe.

        return redirect()->route('dashboard')->with('success', 'Order placed successfully! Total: ' . number_format($total_price, 2));

    } catch (\Exception $e) {
        // 8. Rollback on error
        DB::rollBack();
        return back()->with('error', 'Failed to place order: ' . $e->getMessage());
    }
    }
    public function userAddToCart(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::findOrFail($request->product_id);
        $qty = $request->qty;
        $cart = Session::get('cart', []);

        // Check if the product is already in the cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "qty" => $qty,
                "price" => $product->unit_price,
                "product_id" => $product->id,
            ];
        }

        Session::put('cart', $cart);

        return redirect()->route('user.product')->with('success', $product->name . ' added to your order!');
    }

    /**
     * Displays the current contents of the session cart.
     */
    public function userViewCart()
    {
        $cart = Session::get('cart', []);
        return view('user.cart-index', compact('cart'));
    }

    /**
     * Removes an item from the session cart.
     */
    public function userRemoveFromCart($productId)
    {
        $cart = Session::get('cart');

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return back()->with('success', 'Item removed from order.');
        }

        return back()->with('error', 'Item not found in order.');
    }

}
