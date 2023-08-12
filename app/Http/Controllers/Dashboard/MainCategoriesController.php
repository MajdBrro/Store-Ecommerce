<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

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
    $categories=Category::all();
    return view('dashboard.categories.create',compact('categories'));
}
###################################################################################################
public function store(Request $request){
    // return $request;
    if($request->type ==1)
    {
    $category=new Category();
    $category->name = $request -> name;
    $category->slug = $request -> slug;
    $category->is_active = $request -> is_active;
    $category->save();
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was added successful']);
    }
    else
    $name=$request -> name;
    $slug=$request -> slug;
    return redirect()->route('admin.subcategories.create',compact('name','slug'));
    

    // Category::create([
    //     'name' => $request -> name,
    //     'slug' => $request -> slug,
    //     'is_active' => $request -> is_active == 1 ? "1" : "0",
    // ]);
}
###################################################################################################
public function delete($id){
    $delcat=Category::findorfail($id);
    $delcat -> delete();
    return redirect()->route('admin.maincategories') -> with(['success' => __('admin.it_was_deleted_successfully')]);
}
###################################################################################################
}

