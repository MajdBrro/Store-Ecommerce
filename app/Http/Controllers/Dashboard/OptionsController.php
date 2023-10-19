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
    
   
    ####################################################################################################
    public function delete($id)
    {

        try {
            //get specific categories and its translations
            $option = Option::findOrfail($id);

            if (!$option)
                return redirect()->route('admin.options')->with(['error' => 'هذا المنتج غير موجود ']);

            $option->delete();

            return redirect()->route('admin.options')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.options')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    
}