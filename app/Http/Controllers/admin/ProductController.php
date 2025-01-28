<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    function getProduct()
    {
        $products = Product::orderBy('product_name', 'desc')->get()->map(function ($product) {
            if ($product->product_image) {
                $product->product_image = Storage::url('products/' . $product->product_image);
            } else {
                $product->product_image = null; // Or a placeholder image URL
            }
            return $product;
        });

        return view('admin.product.product', ['products' => $products]);
    }

    function subCategoriesList()
    {
        $subCategories = \App\Models\Category::select(
            'sub.category_id',
            'sub.category_name',
            'main.category_name as main_category_name'
        )
            ->from('categories as sub')
            ->join('categories as main', 'sub.parent_category_id', '=', 'main.category_id')
            ->where('sub.parent_category_id', '>', 0)
            ->orderBy('sub.updated_at', 'desc')
            ->get();

        return $subCategories;
    }
    function getProductCreate()
    {
        $subCategories = $this->subCategoriesList();
        return view('admin.product.product-create', ['subCategories' => $subCategories]);
    }

    function getInitials($name)
    {
        // Split the name into words
        $words = explode(' ', $name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return $initials; // Return the generated category code
    }

    function generateSKU($productName, $category_id)
    {
        $category_name = \App\Models\Category::select('category_name')
            ->where('category_id', $category_id)
            ->first()->category_name;

        $categoryCode = $this->getInitials($category_name);

        // Generate a slug from the product name
        $slug = strtoupper(preg_replace('/[^A-Z0-9]+/', '', trim($productName)));

        // Generate a unique identifier
        $uniqueId = strtoupper(substr(uniqid(), -5)); // Get last 5 characters

        // Combine to create the SKU
        $product_sku = "{$categoryCode}{$slug}{$uniqueId}";

        // Ensure product_sku is unique
        while (Product::where('product_sku', $product_sku)->exists()) {
            $uniqueId = strtoupper(substr(uniqid(), -5)); // Regenerate unique ID
            $product_sku = "{$categoryCode}{$slug}{$uniqueId}";
        }

        return $product_sku;
    }



    function createProduct(Request $req)
    {
        $validatedData = $req->validate([
            'product_name' => 'required|string|max:255|min:2',
            'product_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'category_id' => 'required|integer',
            'product_description' => 'required|string|max:255|min:2',
        ]);

        $product_sku = $this->generateSKU($validatedData['product_name'], $validatedData['category_id']);


        if ($req->file('product_image')) {
            $extension = $req->file('product_image')->getClientOriginalExtension();
            $product_image_name = $product_sku . '.' . $extension;
            $product_image_path = $req->file('product_image')->storeAs('products', $product_image_name, 'public');
        }


        $Product = new Product;
        $Product->product_sku = $product_sku;
        $Product->product_name = $validatedData['product_name'];
        $Product->product_price = $validatedData['product_price'];
        $Product->product_veg_non_veg = $req->product_veg_non_veg;
        $Product->category_id = $validatedData['category_id'];
        $Product->product_description = $validatedData['product_description'];
        $Product->product_image = $product_image_name ?? null;
        $Product->save();

        if ($Product) {
            session()->flash('create_msg', 'Product created successfully!');
        }

        return redirect('/admin/product');
    }

    function changeProductStatus(Request $req)
    {
        $Product = Product::find($req->product_id);
        $Product->product_status = $req->product_status;
        $Product->save();

        if ($Product) {
            return 1;
        } else {
            return 0;
        }
    }


    function getProductSingle($id)
    {
        $subCategories = $this->subCategoriesList();
        $product = Product::find($id);

        if ($product) {
            if ($product->product_image) {
                $product->product_image = Storage::url('products/' . $product->product_image);
            } else {
                $product->product_image = null; // Or a placeholder image URL
            }
        }

        return view('admin.product.product-update', ['product' => $product, 'subCategories' => $subCategories]);
    }

    function updateProduct(Request $req)
    {
        $validatedData = $req->validate([
            'product_name' => 'required|string|max:255|min:2',
            'product_price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|min:1',
            'category_id' => 'required|integer',
            'product_description' => 'required|string|max:255|min:2',
        ]);

        $Product = Product::find($req->product_id);
        $Product->product_name = $validatedData['product_name'];
        $Product->product_price = $validatedData['product_price'];
        $Product->product_veg_non_veg = $req->product_veg_non_veg;
        $Product->category_id = $validatedData['category_id'];
        $Product->product_description = $validatedData['product_description'];
        if ($req->file('product_image')) {
            $extension = $req->file('product_image')->getClientOriginalExtension();
            $product_image_name = $Product->product_sku . '.' . $extension;
            $product_image_path = $req->file('product_image')->storeAs('products', $product_image_name, 'public');
            $Product->product_image = $product_image_name;
        }
        $Product->save();

        if ($Product) {
            session()->flash('update_msg', 'Product updated successfully!');
        }

        return redirect('/admin/product');
    }

    function deleteProduct($id)
    {
        $Product = Product::find($id);
        // Delete product image from storage
        if ($Product->product_image) {
            $product_image_path = 'products/' . $Product->product_image;
            Storage::disk('public')->delete($product_image_path);
        }

        $Product->delete();

        if ($Product) {
            session()->flash('delete_msg', 'Product deleted successfully!');
        }
        return redirect('/admin/product');
    }

    function uploadBulkProductImages(Request $req)
    {
        $uploadedFiles = [];
        foreach ($req->file('product_images') as $file) {
            $originalName = $file->getClientOriginalName();
            $product_image_path = $file->storeAs('products', $originalName, 'public');
            $uploadedFiles[] = $product_image_path;
        }
        return $uploadedFiles;
    }

    public function productSampleDownload()
    {
        $file = public_path('storage/download/sample-product.csv');
        return response()->download($file);
    }
}
