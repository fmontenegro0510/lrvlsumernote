<?php

namespace App\Http\Controllers;

use DOMDocument;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
    public function create (){
        return view('posts.create');
    }
    public function store(Request $request){

        $description = $request->description;
        $dom = new DOMDocument();
        $dom->loadHtml($description,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',',explode(';',$img->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . time(). $key.'.png';
            file_put_contents(public_path().$image_name,$data);
 
            $img->removeAttribute('src');
            $img->setAttribute('src',$image_name);
        }

        $description = $dom->saveHTML();

        Post::create([
            'title' => $request->title,
            'description' => $description
        ]);

        return redirect()->route('posts.index');
    }

    public function show($id){
        $post = Post::find($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id){
        
        $post = Post::find($id);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, $id){

        $post = Post::find($id);
        $description = $request->description;
        $dom = new DOMDocument();
        $dom->loadHtml($description,9);

        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            // Check if the image is a new one
            if (strpos($img->getAttribute('src'), 'data:image/') === 0) {

                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time() . $key . '.png';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
        }

        $description = $dom->saveHTML();

        $post->update([
            'title' => $request->title,
            'description' => $description
        ]);
        return redirect()->route('posts.index');
    }

    public function destroy($id){

        $post = Post::find($id);
        $dom= new DOMDocument();
        $dom->loadHTML($post->description,9);
        $images = $dom->getElementsByTagName('img');
 
        foreach ($images as $key => $img) {
             
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');
 
 
            if (File::exists($path)) {
                File::delete($path);
                
            }
        }
 
        $post->delete();
        return redirect()->back();

    }

}
