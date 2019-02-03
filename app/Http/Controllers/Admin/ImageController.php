<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;

class ImageController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImage()
    {
        return view('admin.image.resizeImage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function resizeImagePost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $image = $request->file('image');

        $input['imagename'] = time() . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/images/thumbnail');

        $img = Image::make($image->getRealPath());

        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['imagename']);

        $destinationPath = public_path('/images');

        $image->move($destinationPath, $input['imagename']);

        $this->postImage->add($input);

        return back()
            ->with('success', 'Image Upload successful')
            ->with('imageName', $input['imagename']);
    }
}
