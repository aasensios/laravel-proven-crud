<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function listAll()
    {
        // Get all categories from database.
        $categories = Category::all();

        // // Get only the first 5 categories
        // $categories = Category::take(5)->get();

        // // Get some categories doing a SELECT WHERE.
        // $categories = Category::where('id', '>', '3')->get();

        // // Get some categories doing a SELECT WHERE LIKE.
        // $categories = Category::where('name', 'like', '%$name%')->get();

        // // Get some cateogries ordered by some ccriteria.
        // $categories = Category::where('id', '>', '3')->orderBy('name')->get();

        // // Only for debug mode (like vardump() + die()).
        // dd($categories);

        // Prepare the content for the view.
        $message = count($categories) . ' categories found';

        // Go to the view 'list', categories array is passed as parameter.
        return view('category.list', array('categories' => $categories, 'message' => $message));
    }

    public function check_create(Request $request)
    {
        // Define some regex.
        $alphabetic = '/^[a-z ]*$/i';
        // $numeric = '/^[0-9]*$/';
        // $postalocde = '/^[0-9]{5}*$/';

        // Call the built-in validate laravel method.
        $request->validate([
            'name' => "required|unique:categories|min:1|max:50|regex:$alphabetic",
            'description' => "nullable|string|max:100",
        ]);

        // --- Is it possible to get the minimums and maximums from the model, to avoid hard-code?
    }

    public function check_find(Request $request)
    {
        $alphabetic = '/^[a-z ]*$/i';

        $request->validate([
            'id' => "numeric|nullable",
            'name' => "max:50|regex:$alphabetic|nullable",
        ]);
    }

    // check_update is the same as check_create
    public function check_update(Request $request)
    {
        // Define some regex.
        $alphabetic = '/^[a-z ]*$/i';
        // $numeric = '/^[0-9]*$/';
        // $postalocde = '/^[0-9]{5}*$/';

        // Call the built-in validate laravel method.
        $request->validate([
            'name' => "required|min:1|max:50|regex:$alphabetic",
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
            Category::create($request->all());

            // If we would not want to save all form fillable fields to database.
            // $category = new Category();
            // $category->name = $request->name;
            // $category->description = $request->description;
            // $category->save(); // Automatically assigns incremental to id.
            // $id = $category->id; // Get that automatic id.

            // Prepare the message for the view
            $message = trans('messages.created-success');
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                $message = 'Name already exists';
            } else {
                $message = 'No data created. ' . $e->getCode();
            }
        }

        // Go to the view 'create', message is passed as parameter.
        return view('category.create', ['message' => $message]);
    }

    public function find(Request $request)
    {
        // Use the new check_find method
        $this->check_find($request);
        $message = null;

        try {
            // // Get the form field
            // $category = Category::find($request->id);
            // // Control if searched object exists in database
            // if (isset($category)) {
            //     // Go to edit
            //     // TODO
            //     $message = 'Data found.';
            // } else {
            //     $message = 'No data found.';
            // }

            // Check what form field has been filled and perform a customized validate per each field
            if ($request->id != null) {
                $category = Category::findOrFail($request->id);
            } else if ($request->name != null) {
                // $alphabetic = '/^[\w\s]*$/i';
                // $alphabetic = '/^[\p{L}]*$/iu'; // PROBLEMAS CON LAS TILDES e.g. Lucía
                // $request->validate(['name' => "regex:$alphabetic"]);
                $category = Category::where('name', $request->name)->first();
            }
            // Go to the edit view, with the current id in the URL
            // return redirect()->to('/category/edit/' . $request->id);
            // return redirect()->to(url('/category/edit/' . $category->id));
            return redirect()->route('category-edit', ['id' => $category->id]);
        } catch (\Exception $e) {
            // The '\' before Exception is needed because it is outside of the current namespace
            $message = 'No data found. ' . $e->getMessage();
        }

        // Go to the view with the generated messages
        return view('category.find', ['id' => $request->id, 'message' => $message]);
    }

    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            // Get the session message (come from update method)
            $message = Session::get('session_message');
            return view('category.edit', ['category' => $category, 'message' => $message]);
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
            $category = Category::findOrFail($request->id);
            $category->update($request->all());
            $message = 'Data updated successfully';
            // return redirect()->back()->with(['session_message' => $message]);
            return redirect()->back()->with('session_message', $message);
        } catch (\Exception $e) {
            $message = 'No data updated. ' . $e->getMessage();
        }
        return view('category.edit', ['category' => $category, 'message' => $message]);
    }

    public function delete($request)
    {
        try {
            $category = Category::findOrFail($request->id);
            $category->delete();
            $message = 'Data deleted successfully';
            // return view('category.find', ['message' => $message]);
            // return redirect()->to(route('category-list'));
            return redirect()->to('/category/list');
        } catch (\Exception $e) {
            $message = 'No data deleted. ' . $e->getMessage();
        }
        return view('category.edit', ['category' => $category, 'message' => $message]);
    }
}
