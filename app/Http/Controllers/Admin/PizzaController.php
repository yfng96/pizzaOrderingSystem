<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Pizza;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class PizzaController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pizzas = Pizza::orderBy('created_at', 'desc')
            ->when($request->query('name'), function($query) use ($request) {
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
        if (Gate::allows('isAdmin')) {
            $pizza = new Pizza;

            return view('admin.pizzas.create', [
                'pizza' => $pizza
            ]);
        } else {
            return redirect()->route('admin.pizza.index')->with('unauthorized','Unauthorized Action');
        }
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
            'price' => 'required|numeric|between:0,99.99',
            'photo' => 'nullable|image|mimes:jpg,jpeg|max:2000'
        ]);
    
        //Handle file upload
        if($request->hasFile('image')){
            $filename = $request->input('name');
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
        if (Gate::allows('isAdmin')) {
            $pizza = Pizza::find($id);
            if(!$pizza) throw new ModelNotFoundException;

            return view('admin.pizzas.edit', [
                'pizza' => $pizza
            ]);
        } else {
            return redirect()->route('admin.pizza.index')->with('unauthorized','Unauthorized Action');;
        }
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
            'price' => 'required|numeric|between:0,99.99',
          ]);
  
          $pizza = Pizza::find($id);
          if(!$pizza) throw new ModelNotFoundException;
  
          $pizza->fill($request->all());
          $pizza->save();
  
          return redirect()->route('admin.pizza.show', ['id' => $id]);
    }

    public function upload($id)
    {
        if (Gate::allows('isAdmin')) {
            $pizza = Pizza::find($id);
            if(!$pizza) throw new ModelNotFoundException;

            return view('admin.pizzas.upload', [
                'pizza' => $pizza,
            ]);
        } else {
            return redirect()->route('admin.pizza.show', ['id' => $id])->with('unauthorized','Unauthorized Action');;
        }
    }

    public function saveUpload(Request $request, $id)
    {
        $this->validate($request, [
            'photo' => 'image|mimes:jpg,jpeg|max:2000'
        ]);

        $pizza = Pizza::find($id);

        //Handle file upload
        if($request->hasFile('image')){
            $filename = $pizza->name;
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
        if (Gate::allows('isAdmin')) {
            $pizza = Pizza::find($id);
            $pizza->delete();
    
            return redirect()->route('admin.pizza.index')
                            ->with('success','Pizza deleted successfully');
        } else {
            return redirect()->route('admin.pizza.index')->with('unauthorized','Unauthorized Action');;
        }
    }
}
