<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;
use SebastianBergmann\Type\NullType;

class MainCategoriesController extends Controller
{
    public function index(){
        // $categories = Category::get();
        // $categories = Category::parent()-> orderBy('id','DESC')-> whereNull('parent_id') ->paginate(PAGINATION_COUNT);
        $categories = Category::paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index',compact('categories'));
    }
###################################################################################################
public function edit($id){
    $category_edit=Category::findorfail($id);
    // dd($category_edit);
    $categories=Category::all();
    return view('dashboard.categories.edit',compact('categories','category_edit'));
}
###################################################################################################

public function update(Request $request, $id){
#######   واحدة للجميع View سيناريو توحيد الأقسام جميعها بكونترولر واحد و  #######
####### واحد View يجمع فيها تعديل كل الاقسام مع بعضها ب  Categories  السيناريو الثاني يوجد فقط  #######
    if($request->type ==1)
    {
    $request->except('parent_id');
    $category=Category::findorfail($id);
    if(!$category)
    return redirect()->route('admin.maincategories') -> with(['error' => 'it is not found']);
    $category->update([
        $category->is_active = $request -> is_active == 1 ? "1" : "0",
        $category->slug = $request -> slug,
        $category->parent_id = null,
    ]);
    $category -> name = $request -> name; // يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    $category -> save();
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was done successful']);
    }
    elseif($request->type ==2){
    // return $request;
    // $request->except('parent_id');
    $category=Category::findorfail($id);
    if(!$category)
    return redirect()->route('admin.maincategories') -> with(['error' => 'it is not found']);
    $category->update([
        $category->is_active = $request -> is_active == 1 ? "1" : "0",
        $category->slug = $request -> slug,
        $category->parent_id = $request -> parent_id,
    ]);
    $category -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    $category -> save();
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was done successful']);
    }
#######   واحدة للجميع View سيناريو توحيد الأقسام جميعها بكونترولر واحد و  #######
####### واحد View يجمع فيها تعديل كل الاقسام مع بعضها ب  Categories  السيناريو الثاني يوجد فقط  #######
#############################################################################################
##############################MainCategories & SubCategoriesالسيناريو الأول يوجد ####################
// $category=Category::findorfail($id);
// if(!$category)
    // return redirect()->route('admin.maincategories') -> with(['error' => 'it is not found']);
    // $category->update([
    //     // 'slug' => $request->slug,
    //     'is_active' => $request -> is_active == 1 ? "1" : "0",
    // ]);
    // $category -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    // // $category -> slug  = str_replace(' ', '-', $request -> name); 
    // $category -> save();
    // return redirect()->route('admin.maincategories') -> with(['success' => 'it was done successful']);
    
}
###################################################################################################
public function create(){
    $categories=Category::all();
    return view('dashboard.categories.create',compact('categories'));
}
###################################################################################################
public function store(Request $request){
####### واحدة للجميع View سيناريو توحيد الأقسام جميعها بكونترولر واحد و #######
#######     By My self  حل التاسك تبع شجرة الافرع الي تتبع لبعضها:  السيناريو الأول #######
// if($request->type ==1)
//     {
//         $category=new Category();
//         $category->name = $request -> name;
//         $category->slug = $request -> slug;
//         $category->is_active = $request -> is_active == 1 ? "1" : "0";
//         $category->save();
//         return redirect()->route('admin.maincategories') -> with(['success' => 'it was added successful']);
//     }
// elseif($request->type ==2)
// {
//         $categories=Category::all();
//         $name        =$request -> name;
//         $slug        =$request -> slug;
//         $is_active   =$request -> is_active == 1 ? "1" : "0";
//         return view('dashboard.subcategories.create',compact('categories','name','slug','is_active'));
//     }   
#######     By My self  حل التاسك تبع شجرة الافرع الي تتبع لبعضها:  السيناريو الأول #######
#############################################################################################
#######     By Emmam  حل التاسك تبع شجرة الافرع الي تتبع لبعضها:  السيناريو الثاني #######
// return $request;
    if($request->type ==1)
    {
    $request->except('parent_id');
    $category=new Category();
    $category->name = $request -> name;
    $category->slug = $request -> slug;
    $category->is_active = $request -> is_active == 1 ? "1" : "0";
    $category->save();
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was added successful']);
    }
    elseif($request->type ==2){
    // return $request;
    $category=new Category();
    $category->name = $request -> name;
    $category->slug = $request -> slug;
    $category->is_active = $request -> is_active == 1 ? "1" : "0";
    $category->parent_id = $request -> parent_id;
    $category->save();
    return redirect()->route('admin.maincategories') -> with(['success' => 'it was added successful']);
}
#######     By Emmam  حل التاسك تبع شجرة الافرع الي تتبع لبعضها:  السيناريو الثاني #######
#######   واحدة للجميع View سيناريو توحيد الأقسام جميعها بكونترولر واحد و  #######


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

