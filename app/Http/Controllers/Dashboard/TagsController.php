<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(){
        // $tags = tag::get();
        $tags = Tag::orderBy('id','DESC')->paginate(PAGINATION_COUNT);
        // return $tags;
        return view('dashboard.tags.index',compact('tags'));
    }
###################################################################################################
public function create(){
    return view('dashboard.tags.create');
}
###################################################################################################
public function store(Request $request){
    // return $request;
    // $filename=uploadImage('tags',$request->photo);
    // $filepath='public/assets/images/tags/'. $filename;
    $tag=new Tag();
    $tag->name = $request -> name;
    $tag->slug = $request -> slug;
    // $tag->is_active = $request -> is_active == 1 ? "1" : "0";
    // $tag->photo=$filename;
    $tag->save();
    // tag::create([
    //     'name' => $request -> input('name'),
    //     'is_active' => $request -> is_active == 1 ? "1" : "0",
    //     'photo'=> $request ->input('photo')
    // ]);
    return redirect()->route('admin.tags') -> with(['success' => 'it was added successful']);
}
###################################################################################################
public function edit($id){
    $tags=Tag::findorfail($id);
    return view('dashboard.tags.edit',compact('tags'));
}
###################################################################################################
public function update(Request $request, $id){
    #validation
    $tags=Tag::findorfail($id);
    if(!$tags)
    return redirect()->route('admin.tags') -> with(['error' => 'it is not found']);
    
   
    $tags -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
    // $tags -> slug  = str_replace(' ', '-', $request -> name); 
    $tags -> save();
    return redirect()->route('admin.tags') -> with(['success' => 'it was done successful']);
    
}
###################################################################################################
public function delete($id)
{
    $del=Tag::Find($id);
    // return $del;
    $del -> delete();
    return redirect()->route('admin.tags') -> with(['success' =>'تم الحذف بنجاح']);
}
###################################################################################################
// public function destroy($id)
// {
//     try {
//         //get specific categories and its translations
//         $tag = tag::find($id);

//         if (!$tag)
//             return redirect()->route('admin.tags')->with(['error' => 'هذا الماركة غير موجود ']);
            
//             $tag->delete();
            
//         return redirect()->route('admin.tags')->with(['success' => 'تم  الحذف بنجاح']);

//     } catch (\Exception $ex) {
//         return redirect()->route('admin.tags')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
//     }
    
// }
###################################################################################################

}
