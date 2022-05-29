<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $search=$request['search'] ?? "";
        if($search!=""){
            $products =Product::with('category')
                    ->where('products.name', 'LIKE', "%$search%")
                    ->get();
                return view('pages/product/manage_product',compact('products','search'));
        }else{

            $products = Product::with('category')->paginate(10);
            
            return view('pages/product/manage_product',compact('products','search'));
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $px=DB::getTablePrefix();
        $category = DB::select("select id,name from {$px}categories");
        return view('pages/product/create_product',["category"=>$category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product=new Product;
        $product->name=$request->txtName;
        $product->category_id=$request->cmbCategory;
        $product->price=$request->price;
        $product->description=$request->description;
        $product->save();
        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $product->photo=$imageName;
                $product->update();
                $request->filePhoto->move(public_path('/img/product'),$imageName);
            }
        return back()->with('save_product','Product Added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::findOrFail($id);
        return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $px=DB::getTablePrefix();
        $category = DB::select("select id,name from {$px}categories");
        $product=Product::find($id);
        return view('pages/product/edit_product',compact('category','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $product=Product::find($id);
        $product->name=$request->txtName;
        $product->category_id=$request->cmbCategory;
        $product->price=$request->price;
        $product->description=$request->description;

        if(isset($request->filePhoto)){
                $imageName = $request->txtName.'.'.$request->filePhoto->extension();
                $product->photo=$imageName;
                $request->filePhoto->move(public_path('/img/product'),$imageName);
            }
        $product->update();
        return back()->with('update_product','Product Updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //return $id;
        $product=Product::find($id);
        if($product->delete())
        {
            return back()->with('delete_product','product Delete successfully');
        }
    }
    public function get_product(){
        $id=$_GET['id'];
        $product=Product::find($id);
        return json_encode($product);
    }



	public function productDelete(Request $request)
    {
		if ($request->ajax()) {
            $data = $request->all();

            $product = Product::find($data['id']);
            if (!is_null($product)) {
                $product->delete();
            }

            return response()->json([
                'success' => true
            ]);
        }

    }

}

