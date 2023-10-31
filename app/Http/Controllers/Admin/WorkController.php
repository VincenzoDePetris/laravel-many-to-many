<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use App\Models\Work;
use App\Models\Category;
use App\Models\Tag;

class WorkController extends Controller
{

    private function validation($data) {
        $validator = Validator::make(
          $data,
          [
            'title' => 'required|string|max:20',
            'cover_image' => 'nullable|image|max:512',
            'link' => "required|string",
            "description" => "required|string",
            "slug" => "nullable|string",
            "category_id" => "nullable|integer",
            "tags" => "nullable",
          ],
          [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo deve massimo di 20 caratteri',

            'cover_image.image' => 'Il file caricato deve essere un immagine',
            'cover_image.max' => 'Il file caricato deve avere una dimensione inferiore a 512Kb',
            
            'link.required' => 'Il link è obbligatorio',
            'link.string' => 'Il link deve essere una stringa',

            'description.required' => 'La descrizione è obbligatoria',
            'description.string' => 'La descrizione deve essere una stringa',

            'slug.string' => 'Lo slug deve essere una stringa',

            'category_id.exist' => 'La categoria inserita non è valida',

            'tag.exist' => 'I tag inseriti non sono validi',
            
          ]
        )->validate();
      
        return $validator;
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $works = Work::all();
        return view('admin.works.index', compact('works'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.works.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->validation($request->all());
        
        $work = new Work;
        $work->fill($data);

        if(Arr::exist($data, 'cover_image')) {
            $cover_image_path = Storage::put('uploads/works/cover_image', $data['cover_image']);
            $work->cover_image = $cover_image_path;
        }
        
        $work->save();

        $work->tags()->attach($data['tags']);
        return redirect()->route('admin.works.show', $work);    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function show(Work $work)
    {
        return view('admin.works.show', compact('work'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function edit(Work $work)
    {
        $categories = Category::all();
        $tags = Tag::all();

        

        return view('admin.works.edit', compact('work', 'categories', 'tags',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Work $work)
    {
        $data = $this->validation($request->all(), $work->id);
        $work->update($data);

        if(Arr::exist($data, 'cover_image')){
            if($work->cover_image) {
                Storage::delete($work->cover_image);
            }
            
            $cover_image_path = Storage::put('uploads/works/cover_image', $data['cover_image']);
            $work->cover_image = $cover_image_path;
        }   

        $work->save();
        return redirect()->route('admin.works.show', $work);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Work  $work
     * @return \Illuminate\Http\Response
     */
    public function destroy(Work $work)
    {
        $work->tags()->detach();

        if($works->cover_image){
            Storage::delete($work->cover_image);
        }
        $work->delete();
        return redirect()->route('admin.works.index');
    }


   
}
