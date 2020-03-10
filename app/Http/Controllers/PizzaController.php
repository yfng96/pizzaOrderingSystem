<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Pizza;

class PizzaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$pizzas = Pizza::orderBy('name', 'asc')->get();
        $pizzas = Pizza::when($request->query('name'), function($query) use ($request) {
                return $query->where('name', 'like', '%'.$request->query('name').'%');
            })
            ->when($request->query('description'), function($query) use ($request) {
                return $query->where('description', 'like','%'.$request->query('description').'%');
            })
            ->paginate(10);

        return view('admin.pizzas.index', [
            'pizzas' => $pizzas,
            'request' => $request,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pizza = new Pizza;

        return view('admin.pizzas.create', [
            'pizza' => $pizza
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'base_price' => 'required|numeric|between:0,99.99',
            'photo' => 'nullable|image|mimes:jpg,jpeg|max:2000'
          ]);
  
          //Handle file upload
          if($request->hasFile('image')){
              $filename = trim($request->input('name'));
              $filenameToStore = $filename.'.jpg';
              $path = $request->file('image')->storeAs('public/pizzas', $filenameToStore);
          } else {
              $filenameToStore = 'noimage.jpg';
          }
  
          $pizza = new Pizza;
          $pizza->fill($request->all());
          $pizza->image = $filenameToStore;
          $pizza->save();
  
          return redirect()->route('admin.pizza.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pizza = Pizza::find($id);
        if(!$pizza) throw new ModelNotFoundException;

        return view('admin.pizzas.show', [
            'pizza' => $pizza
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pizza = Pizza::find($id);
        if(!$pizza) throw new ModelNotFoundException;

        return view('admin.pizzas.edit', [
            'pizza' => $pizza
        ]);
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
        $request->validate([
            'name' => 'required|max:100',
            'base_price' => 'required|numeric|between:0,99.99',
          ]);
  
          $pizza = Pizza::find($id);
          if(!$pizza) throw new ModelNotFoundException;
  
          $pizza->fill($request->all());
          $pizza->save();
  
          return redirect()->route('admin.pizza.show', ['id' => $id]);
    }

    public function upload($id)
    {
        $pizza = Pizza::find($id);
        if(!$pizza) throw new ModelNotFoundException;

        return view('admin.pizzas.upload', [
            'pizza' => $pizza,
        ]);
    }

    public function saveUpload(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'nullable|image|mimes:jpg,jpeg|max:2000'
        ]);

        $pizza = Pizza::find($id);

        //Handle file upload
        if($request->hasFile('image')){
            $filename = trim($pizza->name);
            $filenameToStore = $filename.'.jpg';
            $path = $request->file('image')->storeAs('public/pizzas', $filenameToStore);
        }else {
            $filenameToStore = 'noimage.jpg';
        }

        $pizza->image = $filenameToStore;
        $pizza->save();
        return redirect()->route('admin.pizza.show', ['id' => $id]);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pizza = Pizza::find($id);
        $pizza->delete();
  
          return redirect()->route('admin.pizza.index')
                          ->with('success','Pizza deleted successfully');
    }
}
