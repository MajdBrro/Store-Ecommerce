<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class MainCategoriesController extends Controller
{
    public function index(){
        // $categories = Category::get();
        $categories = Category::parent()-> orderBy('id','DESC')-> whereNull('parent_id') ->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index',compact('categories'));
    }
###################################################################################################
public function edit($id){
    $category=Category::findorfail($id);
    return view('dashboard.categories.edit',compact('category'));
}
###################################################################################################
public function update(Request $request, $id){
    #validation
    $category=Category::findorfail($id);
    if(!$category)
    return redirect()->route('admin.maincategories') -> with(['error' => 'it is not found']);
    $category->update([
        // 'slug' => $request->slug,
        'is_active' => $request -> is_active == 1 ? "1" : "0",
    ]);
    $category -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    // $category -> slug  = str_replace(' ', '-', $request -> name); 
    $category -> save();
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was done successful']);
    
}
###################################################################################################
public function create(){
    return view('dashboard.categories.create');
}
###################################################################################################
public function store(Request $request){
    // return $request;
    $category=new Category();
    $category->name = $request -> name;
    $category->slug = $request -> slug;
    $category->is_active = $request -> is_active;
    $category->save();
    // Category::create([
    //     'name' => $request -> name,
    //     'slug' => $request -> slug,
    //     'is_active' => $request -> is_active == 1 ? "1" : "0",
    // ]);
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was added successful']);
}
###################################################################################################
public function delete($id){
    $delcat=Category::findorfail($id);
    $delcat -> delete();
    return redirect()->route('admin.maincategories') -> with(['success' => __('admin.it_was_deleted_successfully')]);
}
###################################################################################################
}

