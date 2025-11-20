<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\Category;
use App\Models\Orders;
use App\Models\Order_Item;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard
    public function adminDashboard()
    {
        $products = Product::with(['supplier', 'category'])->get();
        return view('admin.admin-dashboard', compact('products'));
    }

    

    // View Product
    public function adminViewProduct(Product $product)
    {
        return view('admin.admin-view-product', compact('product'));
    }

    // Delete Product
    public function adminDeleteProduct(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Product deleted successfully!');
    }

    // CREATE PRODUCT FORM
    public function adminCreateProduct()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('admin.admin-create-product', compact('suppliers', 'categories'));
    }

    // STORE PRODUCT
    public function adminStoreProduct(Request $request)
    {
        $attr = $request->validate([
            'name'        => ['required', 'string', 'min:3', 'max:55'],
            'Qty'         => ['required', 'integer', 'min:0'],
            'unit_price'  => ['required', 'numeric', 'min:0'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'status'      => ['required', 'boolean'],
        ]);

        Product::create($attr);

        return redirect()->route('admin.dashboard')->with('success', 'Product Created successfully!');
    }

    // EDIT PRODUCT FORM
    public function adminEditProduct(Product $product)
    {
        $suppliers = Supplier::all();
        $categories = Category::all();

        return view('admin.admin-edit-product', compact('product', 'suppliers', 'categories'));
    }

    // UPDATE PRODUCT
    public function adminUpdateProduct(Request $request, Product $product)
    {
        $attr = $request->validate([
            'name'        => ['required', 'string', 'min:3', 'max:55'],
            'Qty'         => ['required', 'integer', 'min:0'],
            'unit_price'  => ['required', 'numeric', 'min:0'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'status'      => ['required', 'boolean'],
        ]);

        $product->update($attr);

        return redirect()->route('admin.dashboard')->with('success', 'Product Updated successfully!');
    }

    // --------------------------
    // SUPPLIER CRUD
    // --------------------------

    public function adminSupplierIndex()
    {
        $suppliers = Supplier::with('products')->get();

        return view('admin.admin-index-supplier', compact('suppliers'));
    }

    public function adminSupplierView(Supplier $supplier)
    {
        return view('admin.admin-view-supplier', compact('supplier'));
    }

    public function adminCreateSupplier()
    {
        return view('admin.admin-create-supplier');
    }

    public function adminStoreSupplier(Request $request)
    {
        $attr = $request->validate([
            'name'     => ['required', 'string'],
            'phone_no' => ['required', 'digits:11'],
            'address'  => ['required', 'string', 'max:255'],
        ]);

        Supplier::create($attr);

        return redirect()->route('admin.dashboard')->with('success', 'Supplier Info Created!');
    }

    public function adminEditSupplier(Supplier $supplier)
    {
        return view('admin.admin-edit-supplier', compact('supplier'));
    }

    public function adminUpdateSupplier(Request $request, Supplier $supplier)
    {
        $attr = $request->validate([
            'name'     => ['required', 'string'],
            'phone_no' => ['required', 'digits:11'],
            'address'  => ['required', 'string', 'max:255'],
        ]);

        $supplier->update($attr);

        return redirect()->route('admin.dashboard')->with('success', 'Supplier Info Updated!');
    }

    public function adminDeleteSupplier(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Supplier Deleted!');
    }

    // --------------------------
    // Category CRUD
    // --------------------------
    public function adminCategoryIndex(){
        $categories = Category::all();
        return view('admin.admin-category-index', compact('categories'));
    }

    public function adminCategoryShow(Category $category)   {
        
        return view('admin.admin-category-show', compact('category'));
    }
    public function adminCategoryCreate(){
        return view('admin.admin-category-create');
    }
    public function adminCategoryStore(Request $request, Category $category)   {
        $attr = $request->validate([   
            'name'=> ['required', 'string'],
            'description'=> ['required', 'string'], 
         ]);
         Category::create($attr);
         return redirect()->route('admin.dashboard')->with('success','Category Created');
    }
    public function adminCategoryEdit(Category $category){
        return view('admin.admin-edit-category', compact('category'));
    }
    public function adminCategoryUpdate(Request $request, Category $category) {
        $attr = $request->validate([   
            'name'=> ['required', 'string'],
            'description'=> ['required', 'string'], 
         ]);
         $category->update($attr);
         return redirect()->route('admin.dashboard')->with('success','Category Created');
        }
    public function adminCategoryDelete(Category $category) {
        $category->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Category Deleted!');
    }
    public function adminOrderIndex()
    {
        // Eager load the 'user' relationship to show who ordered
        $orders = Orders::with('user')->latest()->get(); 
        
        return view('admin.admin-order-index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function adminOrderShow(Orders $order)
    {
        // Eager load related user and order items with their products
        $order->load(['user', 'items.product']);

        return view('admin.admin-order-show', compact('order'));
    }

    /**
     * Update the specified order's status.
     */
    public function adminOrderUpdateStatus(Request $request, Orders $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,processing,completed,cancelled'],
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated to ' . $request->status . '!');
    }




}
