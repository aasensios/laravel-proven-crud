<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    // Define some regex.
    // Notes:
    //     \w equals to [A-Za-z]
    //     \s equals to any whitespace character, like space or tab
    //     \d equals to [0-9]
    //     \. equals to the dot of the floating point numbers
    const ALPHABETIC = '/^[\w\s]*$/i';
    const DECIMAL = '/^\d{1,6}(\.\d{1,2})?$/';

    public function listAll()
    {
        // Get all products from database.
        $products = Product::all();

        // // Only for debug mode (like var_dump() + die()).
        // dd($products);

        // Prepare the content for the view
        $message = count($products) . ' products found';

        // Go to the view named 'list', products array is passed as parameter.
        return view('product.list', array('products' => $products, 'message' => $message));
    }

    public function check_create(Request $request)
    {
        $alphabetic = self::ALPHABETIC;
        $decimal = self::DECIMAL;

        // Call the built-in validate laravel method.
        $request->validate([
            'name' => "required|unique:products|min:1|max:50|regex:$alphabetic", // Double quotes to variable expansion!
            'price' => "required|between:0,999999.99|regex:$decimal", // Double quotes to variable expansion!
            'description' => 'nullable|string|max:100',
        ]);

        // --- Is it possible to get the minimums and maximums from the model, to avoid hard-code?
    }

    public function check_find(Request $request)
    {
        $alphabetic = self::ALPHABETIC;
        $decimal = self::DECIMAL;

        // Call the built-in validate laravel method.
        $request->validate([
            'id' => "nullable|numeric",
            'name' => "nullable|max:50|regex:$alphabetic",
            'price' => "nullable|regex:$decimal",
        ]);
    }

    // check_update is the same as check_create
    public function check_update(Request $request)
    {
        $alphabetic = self::ALPHABETIC;
        $decimal = self::DECIMAL;

        // Call the built-in validate laravel method.
        $request->validate([
            'name' => "required|min:1|max:50|regex:$alphabetic",
            'price' => "required|numeric|between:0,999999.99|regex:$decimal",
            'description' => "nullable|string|max:100",
        ]);

        // --- Is it possible to get the minimums and maximums from the model, to avoid hard-code?
    }

    public function create(Request $request)
    {
        // Validation
        $this->check_create($request);

        try {
            // Save to dabase all fillable form fields in one action.
            Product::create($request->all());

            // Alternative: If we would not want to save all form fillable fields to database.
            // $product = new Product();
            // $product->name = $request->name;
            // $product->description = $request->description;
            // $product->save(); // Automatically assigns incremental to id.
            // $id = $Product->id; // Get that automatic id.

            // Prepare the content for the view
            $message = 'Product has been created successfully.';
        } catch (\Exception $e) {
            $message = 'No product has been created. ' . $e->getMessage();

        }

        // Go to the view 'create', message is passed as parameter as well as all the categories.
        return view('product.create', ['message' => $message, 'categories' => \App\Models\Category::all()]);
    }

    public function find(Request $request)
    {
        // Use the new check_find method
        $this->check_find($request);
        $message = null;

        try {
            // Check what form field has been filled and perform a customized validate per each field
            if ($request->id != null) {
                $product = Product::findOrFail($request->id);
            } else if ($request->name != null) {
                $product = Product::where('name', $request->name)->first();
            } else if ($request->price != null) {
                $product = Product::where('price', $request->price)->first();
            }
            // Go to the edit view, with the current id in the URL
            return redirect()->route('product-edit', ['id' => $product->id]);
        } catch (\Exception $e) {
            // The '\' before Exception is needed because it is outside of the current namespace
            $message = 'No data found. ' . $e->getMessage();
        }
        // Go to the view with the generated messages
        return view('product.find', ['id' => $request->id, 'message' => $message]);
    }

    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            // Get the session message (come from update method)
            $message = Session::get('session_message');
            return view('product.edit', ['product' => $product, 'message' => $message, 'categories' => \App\Models\Category::all()]);
        } catch (\Exception $e) {
            $message = 'No data found. ' . $e->getMessage();
        }
        return redirect()->to('fallback');
    }

    public function modify(Request $request)
    {
        switch ($request->action) {
            case 'update':
                return $this->update($request);
            case 'delete':
                return $this->delete($request);
        }
    }

    public function update($request)
    {
        // Validation
        $this->check_update($request);

        try {
            $product = Product::findOrFail($request->id);
            $product->update($request->all());
            $message = 'Data updated successfully';
            // return redirect()->back()->with(['session_message' => $message]);
            return redirect()->back()->with('session_message', $message);
        } catch (\Exception $e) {
            $message = 'No data updated. ' . $e->getMessage();
        }
        return view('product.edit', ['product' => $product, 'message' => $message, 'categories' => \App\Models\Category::all()]);
    }

    public function delete($request)
    {
        try {
            $product = Product::findOrFail($request->id);
            $product->delete();
            $message = 'Data deleted successfully';
            // return view('product.find', ['message' => $message]);
            // return redirect()->to(route('product-list'));
            return redirect()->to('/product/list');
        } catch (\Exception $e) {
            $message = 'No data deleted. ' . $e->getMessage();
        }
        return view('product.edit', ['product' => $product, 'message' => $message]);
    }
}
