<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductImagesRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::select('id','slug','price', 'created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index', compact('products'));
    }
####################################################################################################
public function create()
{
    $data =[];
    $data['brands']=Brand::active()->get();
    $data['tags']=Tag::get();
    $data['categories']=Category::active()->get();
    return view('dashboard.products.general.create',$data);
    // $brands=Brand::active()->get();
    // $tags=Tag::get();
    // return [$brands,$tags];
}
####################################################################################################
public function store(GeneralProductRequest $request)
{
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
    DB::beginTransaction();
    
        //validation
        
        if (!$request->has('is_active'))
        $request->request->add(['is_active' => 0]);
        else
        $request->request->add(['is_active' => 1]);

        $product = Product::create([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,
        ]);
        //save translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->save();

        //save product categories
        
        $product->categories()->attach($request->categories);
        $product->tags()->attach($request->tags);
        
        //save product tags
        
        DB::commit();
        return redirect()->route('admin.products')->with(['success' => 'تم ألاضافة بنجاح']);
    }
    ####################################################################################################
    
    public function  getPrice($id)
    {
        $product = Product::findOrfail($id);
        return view('dashboard.products.prices.create', $product);
    }
    ####################################################################################################
    
    public function saveProductPrice(ProductPriceValidation $request )
    {
        Product::whereId($request -> product_id) -> update($request -> only(['price','special_price','special_price_type','special_price_start','special_price_end']));
        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
    }
    ####################################################################################################
    public function  getStock($id)
    {
        $product = Product::findOrfail($id);
        return view('dashboard.products.stock.create', $product);
    }
    ####################################################################################################
    public function saveProductStock (ProductStockRequest $request){
        
        // return $request;
        Product::whereId($request -> product_id) -> update($request -> except(['_token','product_id']));
        
        return redirect()->route('admin.products')->with(['success' => 'تم التحديث بنجاح']);
        
    }
    ####################################################################################################
    public function addImages($product_id){
        return view('dashboard.products.images.create')->with('id',$product_id);
    }
    ####################################################################################################
    
    //to save images to folder only not to Data Base
    public function saveProductImages(Request $request ){
        
        $file = $request->file('dzfile');
        $filename = uploadImage('products', $file);
        
        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
    ####################################################################################################
    public function saveProductImagesDB(ProductImagesRequest $request){
        
        if($request->has('document')&&count($request->document)>0){
            foreach($request -> document as $image){
                Image::create([
                    'product_id' => $request -> product_id,
                    'photo' => $image,
                ]);
            }
        }
        return redirect()->route('admin.products')->with(['success' => 'تم إضافة الصور بنجاح']);
        
    }
    ####################################################################################################
    public function delete($id)
    {

        try {
            //get specific categories and its translations
            $product = Product::orderBy('id', 'DESC')->find($id);

            if (!$product)
                return redirect()->route('admin.products')->with(['error' => 'هذا المنتج غير موجود ']);

            $product->delete();

            return redirect()->route('admin.products')->with(['success' => 'تم  الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('admin.products')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    
}