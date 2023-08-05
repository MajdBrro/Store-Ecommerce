<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SubCategoriesController extends Controller
{
    public function index(){
        $categories = Category::child()-> orderBy('id','DESC')-> whereNotNull('parent_id') ->paginate(PAGINATION_COUNT);
        return view('dashboard.subcategories.index',compact('categories'));
    }
###################################################################################################
public function edit($id){
    $subcategory=Category::findorfail($id);
    $maincategories= Category::parent()-> orderBy('id','DESC')-> whereNull('parent_id') ->paginate(PAGINATION_COUNT);
    return view('dashboard.subcategories.edit',compact('subcategory','maincategories'));
}
###################################################################################################
public function update(Request $request, $id){
    #validation
    $category=Category::findorfail($id);
    if(!$category)
    return redirect()->route('admin.subcategories') -> with(['error' => 'it is not found']);
    $category->update([
        // 'slug' => $request->slug,
        'is_active' => $request -> is_active == 1 ? "1" : "0",
        'parent_id' => $request -> input('parent_id'),
    ]);
    $category -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    // $category -> slug  = str_replace(' ', '-', $request -> name); 
    $category -> save();
    return redirect()->route('admin.subcategories') -> with(['success' => 'it was done successful']);
    
}
###################################################################################################
public function create(){
    $categories = Category::parent()-> orderBy('id','DESC')-> whereNull('parent_id') ->paginate(PAGINATION_COUNT);
    return view('dashboard.subcategories.create',compact('categories'));
}
###################################################################################################
public function store(Request $request){
    // return $request;
    $category=new Category();
    $category->name = $request -> name;
    $category->slug = $request -> slug;
    $category->is_active = $request -> is_active;
    $category->parent_id = $request -> parent_id;
    $category->save();
    // Category::create([
    //     'name' => $request -> input('name'),
    //     'slug' => $request -> input('slug'),
    //     'parent_id' => $request -> input('parent_id') ,
    //     'is_active' => $request -> is_active == 1 ? "1" : "0",
    // ]);
    return redirect()->route('admin.subcategories') -> with(['success' => 'it was added successful']);
}
###################################################################################################
public function delete($id){
    $delcat=Category::findorfail($id);
    $delcat -> delete();
    return redirect()->route('admin.subcategories') -> with(['success' => __('admin.it_was_deleted_successfully')]);
}
###################################################################################################
}

