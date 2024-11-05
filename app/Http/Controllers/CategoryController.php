<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;



class CategoryController extends Controller
{

    function getMainCategoryList()
    {
        $mainCategories = Category::where('parent_category_id', 0)
            ->orWhereNull('parent_category_id')
            ->orderByDesc('updated_at')
            ->get();

        return $mainCategories;
    }

    function getMainCategory()
    {
        $routeName = Route::currentRouteName();
        $routePath = 'admin.main-category.main-category';

        if ($routeName === 'sub-category-create') {
            $routePath = 'admin.sub-category.sub-category-create';
        } elseif ($routeName === 'main-category') {
            $routePath = 'admin.main-category.main-category';
        }

        return view($routePath, ['mainCategories' => $this->getMainCategoryList()]);
    }



    function createMainCategory(Request $req)
    {
        $validatedData = $req->validate([
            'category_name' => 'required|string|max:255|min:2',
            'category_logo' => 'required|string|max:255',
            'category_description' => 'required|string|max:255|min:2',
        ]);

        //Using Query Builder
        // DB::table('categories')->insert([
        //     'category_name' => $req->category_name,
        //     'category_icon' => $req->category_icon,
        // ]);

        // Using Eloquent ORM
        $Category = new Category;
        $Category->category_name = $validatedData['category_name'];
        $Category->category_logo = $validatedData['category_logo'];
        $Category->category_description = $validatedData['category_description'];
        $Category->save();


        if ($Category) {
            session()->flash('create_msg', 'Category created successfully!');
        }

        return redirect('/admin/main-category');
    }

    function getMainCategorySingle($id)
    {
        $Category = Category::find($id);
        return view('admin.main-category.main-category-update', ['mainCategory' => $Category]);
    }


    function updateMainCategory(Request $req)
    {
        $validatedData = $req->validate([
            'category_name' => 'required|string|max:255|min:2',
            'category_logo' => 'required|string|max:255',
            'category_description' => 'required|string|max:255|min:2',
        ]);

        // Using Eloquent ORM
        $Category = Category::find($req->category_id);
        $Category->category_name = $validatedData['category_name'];
        $Category->category_logo = $validatedData['category_logo'];
        $Category->category_description = $validatedData['category_description'];
        $Category->save();


        if ($Category) {
            session()->flash('update_msg', 'Category updated successfully!');
        }

        return redirect('/admin/main-category');
    }


    function deleteMainCategory($id)
    {
        $destroy = Category::destroy($id);
        if ($destroy) {
            session()->flash('delete_msg', 'Category deleted successfully!');
        }
        return redirect('/admin/main-category');
    }


    function getSubCategory($id = null)
    {
        if ($id) {
            $subCategories = Category::select(
                'sub.category_id',
                'sub.category_name',
                'sub.category_description',
                'sub.category_status',
                'sub.created_at',
                'sub.updated_at',
                'main.category_name as main_category_name'
            )
                ->from('categories as sub')  // Alias the table as 'sub'
                ->join('categories as main', 'sub.parent_category_id', '=', 'main.category_id')  // Self-join
                ->where('sub.parent_category_id', '=', $id)
                ->orderByDesc('sub.updated_at')
                ->get();
        } else {
            $subCategories = Category::select(
                'sub.category_id',
                'sub.category_name',
                'sub.category_description',
                'sub.category_status',
                'sub.created_at',
                'sub.updated_at',
                'main.category_name as main_category_name'
            )
                ->from('categories as sub')  // Alias the table as 'sub'
                ->join('categories as main', 'sub.parent_category_id', '=', 'main.category_id')  // Self-join
                ->where('sub.parent_category_id', '>', 0)  // Exclude top-level categories
                ->orderBy('sub.updated_at', 'desc')
                ->get();
        }

        return view('admin.sub-category.sub-category', ['subCategories' => $subCategories]);
    }


    function createSubCategory(Request $req)
    {
        $validatedData = $req->validate([
            'main_category_name' => 'required|integer',
            'category_name' => 'required|string|max:255|min:2',
            'category_description' => 'required|string|max:255|min:2',
        ]);


        $Category = new Category;
        $Category->category_name = $validatedData['category_name'];
        $Category->category_description = $validatedData['category_description'];
        $Category->parent_category_id = $validatedData['main_category_name'];
        $Category->save();


        if ($Category) {
            session()->flash('create_msg', 'Category created successfully!');
        }

        return redirect('/admin/sub-category');
    }

    function getSubCategorySingle($id)
    {
        $Category = Category::find($id);
        return view('admin.sub-category.sub-category-update', ['subCategory' => $Category, 'mainCategories' => $this->getMainCategoryList()]);
    }

    function deleteSubCategory($id)
    {
        $destroy = Category::destroy($id);
        if ($destroy) {
            session()->flash('delete_msg', 'Category deleted successfully!');
        }
        return redirect('/admin/sub-category');
    }


    function updateSubCategory(Request $req)
    {
        $validatedData = $req->validate([
            'main_category_name' => 'required|integer',
            'category_name' => 'required|string|max:255|min:2',
            'category_description' => 'required|string|max:255|min:2',
        ]);

        // Using Eloquent ORM
        $Category = Category::find($req->category_id);
        $Category->category_name = $validatedData['category_name'];
        $Category->parent_category_id = $validatedData['main_category_name'];
        $Category->category_description = $validatedData['category_description'];
        $Category->save();


        if ($Category) {
            session()->flash('update_msg', 'Category updated successfully!');
        }

        return redirect('/admin/sub-category');
    }

    function changeCategoryStatus(Request $req)
    {
        $Category = Category::find($req->category_id);
        $Category->category_status = $req->category_status;
        $Category->save();

        if ($Category) {
            return 1;
        } else {
            return 0;
        }
    }
}
