<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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
        $search = $request['search'] ?? "";
        if ($search != "") {
            $categories = Category::where('categories.name', 'LIKE', "%$search%")
                ->get();
            return view('pages/category/manage_category', compact('categories', 'search'));
        } else {
            $categories = Category::paginate(10);
            $categories = Category::orderBy('id', 'DESC')->get();
            return view('pages/category/manage_category', compact('categories', 'search'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pages/category/create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->txtName;
        $category->save();
        if (isset($request->filePhoto)) {
            $imageName = $request->txtName . '.' . $request->filePhoto->extension();
            $category->photo = $imageName;
            $category->update();
            $request->filePhoto->move(public_path('/img/category'), $imageName);
        }
        return back()->with('save_category', 'category Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = category::findOrFail($id);
        return $category;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$categorys=category::where('id',$id)->first();
        $categories = Category::find($id);
        // return view('pages/category/edit_category', compact('categories'));
        return view('pages.category.edit_category', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->txtName;
        if (isset($request->filePhoto)) {
            $imageName = $request->txtName . '.' . $request->filePhoto->extension();
            $category->photo = $imageName;
            $request->filePhoto->move(public_path('/img/category'), $imageName);
        }
        $category->update();
        return back()->with('update_category', 'category Updated successfully');
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
        $category = category::find($id);
        if ($category->delete()) {
            return back()->with('delete_category', 'category Delete successfully');
        }
    }
    public function get_category(Request $request)
    {
        $id = $request->id;
        $category = Category::find($id);
        return json_encode($category);
    }



    public function categoryDelete(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $category = Category::find($data['id']);
            if (!is_null($category)) {
                $category->delete();
            }

            return response()->json([
                'success' => true
            ]);
        }
    }
}
