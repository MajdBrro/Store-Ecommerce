<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Http\Requests\GeneralProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        //
    }
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
    public function store(GeneralProductRequest $request)
    {
    $data =[];
    $data['brands']=Brand::active()->get();
    $data['tags']=Tag::get();
    $data['categories']=Category::active()->get();
    return view('dashboard.products.general.create',$data);

    }
}
