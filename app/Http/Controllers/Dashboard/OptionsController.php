<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Models\Attribute as ModelsAttribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OptionsController extends Controller
{
    public function index()
    {
        // $options = Option::all();
        $options = Option::with(['product'=> function($prod){
            // $prod -> makeHidden(['translations']);
            $prod -> select('id');
        }, 'attribute'=> function($attr){
            $attr -> select('id');
        }])->select('id','product_id','attribute_id','price')->paginate(PAGINATION_COUNT);
        // return $options;
        // $options = Option::with(['product', 'attribute'])->select('id','product_id','attribute_id','price')->paginate(PAGINATION_COUNT);
        return view('dashboard.options.index', compact('options'));
    }
####################################################################################################
public function create()
{
    $data=[];
    $data['attributes']= Attribute::get();
    $data['products']= Product::get();
    return view('dashboard.options.create', $data );
    // $products= Product::active()->get();
    // $attributes= Attribute::get();
    // return view('dashboard.options.create', $products , $attributes );
    // $attributes=Attribute::all();
    // $products=Product::all();
    // $brands=Brand::active()->get();
    // $tags=Tag::get();
    // return [$brands,$tags];
}
####################################################################################################
public function store(Request $request)
{
    $option = Option::create([
        'price' => $request->price,
        'product_id' => $request->product_id,
        'attribute_id' => $request->attribute_id,
    ]);
    //save options
    $option->name = $request->name;
    $option->save();
    
    return redirect()->route('admin.options')->with(['success' => 'تم ألاضافة بنجاح']);

    // return $request;
    // DB::beginTransaction();
    
    // $product=new Product();
    // $product->name = $request -> name;
    // $product->slug = $request -> slug;
    // $product->brand_id = $request -> brand_id;
    // $product->description = $request -> description;
    // $product->short_description = $request -> short_description;
    // $product->is_active = $request -> is_active == 1 ? "1" : "0";
    // $product->save();
    // $product->categories()->attach($request->categories);
    // $product->tags()->attach($request->tags);
    
    // return redirect()->route('admin.products') -> with(['success' => 'it was added successful']);
    
        //validation
        
    }
    ####################################################################################################
    public function edit($id){
        // $data=[];
        // $data['attributes']= Attribute::get();
        // $data['products']= Product::get();
        // $data['options']= Option::findorfail($id);
        // return view('dashboard.options.edit', $data);
        $attributes=Attribute::all();
        $products=Product::all();
        $options=Option::findorfail($id);
        return view('dashboard.options.edit',compact('attributes','options','products'));
    }
    ####################################################################################################
    public function update(Request $request){
        // return $request;
        //validation
        $option=Option :: findOrfail($request -> id);
        if(!$option)
        return redirect()->route('admin.options') -> with(['error' => 'it is not found']);
        else
        $option->update([

            'product_id' => $request -> product_id,
            'attribute_id' => $request -> attribute_id,
            'price' => $request -> price,
        ]);
        $option -> name= $request -> name;
        $option -> save();
        return redirect()->route('admin.options') -> with(['success' => 'it is done successfully']);

    }
    ####################################################################################################
    public function delete($id)
    {
            $delopt=Option::findorfail($id);
            $delopt -> delete();
            return redirect()->route('admin.options') -> with(['success' => __('admin.it_was_deleted_successfully')]);
    }
    
}