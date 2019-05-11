<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CatalogController extends Controller
{
    public function edit($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            // Get the possible session message (it may come from the update method below).
            $message = Session::get('session_message');
            // Go to the form view with a single movie and the possible session message.
            return view('movie.form', ['movie' => $movie, 'message' => $message]);
        } catch (\Exception $e) {
            // Set up the error message.
            $message = 'No data found. ' . $e->getMessage();
        }
        // If error occurs, go back.
        return redirect()->to('fallback');
    }

    public function update($request)
    {
        // Previous field validation.
        $this->check($request);
        try {
            // Search the movie by its id inside the database.
            $movie = Movie::findOrFail($request->id);
            // Update only some specific fields.
            $movie = new Movie();
            $movie->title = $request->title;
            $movie->year = $request->year;
            $movie->synopsis = $request->synopsis;
            // Save the changes. Automatically assigns incremental to id.
            $movie->save();
            // Get that automatic id.
            $id = $movie->id;
            // Set up the success message.
            $message = 'Data updated successfully';
            // Go back to the edit view form with the resulting message.
            return redirect()->back()->with('session_message', $message);
        } catch (\Exception $e) {
            // Set up the error message.
            $message = 'No data updated. ' . $e->getMessage();
        }
        // Error case flow: according message is shown.
        return view('movie.form', ['movie' => $movie, 'message' => $message]);
    }

    public function show()
    {
        // Get all movies from database.
        $movies = Movie::all();
        // Prepare the message (total number of movies).
        $message = count($movies) . ' movies found';
        // Go to the view named 'list', passing the movies array as parameter.
        return view('movie.form', ['movies' => $movies, 'message' => $message]);
    }

    public function check(Request $request)
    {
        // Regular expression for letters and whitespaces only, case insensitive.
        $alphabetic = '/^[\w\s]*$/i';
        // Call the built-in validate laravel method.
        $request->validate([
            'title' => "required|max:25|regex:$alphabetic",
            'year' => "required|numeric|digits_between:4,4", // Must be 4 digits long.
            'synopsis' => "nullable|string|max:100",
        ]);
    }
}
