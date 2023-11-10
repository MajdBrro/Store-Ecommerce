<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use App\Models\AttributeTranslation;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller
{
    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));
    }
#################################################################################
    public function create(){
        return view('dashboard.attributes.create');
    }
#################################################################################
    public function store(AttributeRequest $request)
    {
        // DB::beginTransaction();
        $attribute = Attribute::create([]);
        //save translations
        $attribute->name = $request->name;
        $attribute->save();
        return redirect()->route('admin.attributes')->with(['success' => 'تم ألاضافة بنجاح']);
    }
#################################################################################
    public function edit($id){
        $attributes=Attribute::findorfail($id);
        return view('dashboard.attributes.edit',compact('attributes'));
    }
#################################################################################
    public function update(AttributeRequest $request, $id){
        #validation
        // return $request;
        $attributes=Attribute::findorfail($request->id);
        if(!$attributes)
        return redirect()->route('admin.attributes') -> with(['error' => 'it is not found']);
        // else
        // $attributes->update([
        //         // 'is_active' => $request -> is_active == 1 ? "1" : "0",
        //         // 'photo' => $filename,
        //     ]);
            $attributes -> name = $request -> name;// يونيك name هنا يوجد ملاحظة انو الباكج نفسها تعتبر ال
            $attributes -> save();
            return redirect()->route('admin.attributes') -> with(['success' => 'it was done successful']);
        }
#################################################################################
public function destroy($id)
{
    // try {
        //get specific attributes and its translations
        $attribute = Attribute::find($id);
        
        // if (!$attribute)
        // return redirect()->route('admin.attributes')->with(['error' => 'هذا الخاصية غير موجود ']);
        // else
        $attribute->delete();
            
        return redirect()->route('admin.attributes')->with(['success' => 'تم  الحذف بنجاح']);
            
        // } catch (\Exception $ex) {
        //     return redirect()->route('admin.attributes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        // }
        
    }
#################################################################################
    }
