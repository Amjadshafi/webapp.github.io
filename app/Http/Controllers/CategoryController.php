<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        $categories = $this->category->with('user')->get();
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $request['created_by'] = Auth::user()->id;
        $category = $this->category->create($request->except('_token'));
        if ($category) {
            return redirect()->route('categoriesList')->withSuccess('Category successfully created.');
        }
        return back()->withError('Failed to create category. Please try again.');
    }

    public function edit($id)
    {
        $category = $this->category->findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category = $this->category->findOrFail($id);
        $category->update($request->all());
        return redirect()->route('categoriesList')->withSuccess('Category successfully updated.');
    }
    public function show($id)
    {
        $category = $this->category->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);
        $category->delete();
        return redirect()->route('categoriesList')->withSuccess('Category successfully deleted.');
    }
}
