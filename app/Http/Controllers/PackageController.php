<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use Illuminate\Validation\ValidationException;
use Image;
use File;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $package;

    public function __construct()
    {
        $this->package = Package::class;
    }

    public function index()
    {
        $packages = Package::get();

        return view("package.index", ["packages" => $packages]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'name' => [
                    'required',
                    'max:100',
                    'unique:packages',
                ],
                'comment' => [
                    'required',
                ],
                'price' => [
                    'required',
                    'numeric'
                ],
                'image' => [
                    'required',
                    'mimes:jpg,png,jpeg',
                    'max:5048'
                ],
            ],
            $messages = [
                "price.required" => "Zadejte cenu.",
            ]
        )->validate();

        $image = $request->file('image');
        $imgName = $input['imagename'] = time() . '.' . $image->extension();
        $destinationPath = public_path('img\package-images');

        $img = Image::make($image->path());
        $img->save($destinationPath . '/' . $imgName);

        if ($request->input('is-one-time')) {
            $isOneTime = 1;
        } else {
            $isOneTime = 0;
        }
        $this->package::create([
            'name' => $request->name,
            'sanitized_name' => Helper::instance()->friendly_url($request->name),
            'comment' => $request->comment,
            'price' => $request->price,
            'is_one_time' => $isOneTime,
            'color' => $request->color,
            'image' => 'img/package-images/' . $imgName,
        ]);

        return redirect('/admin/package')->with('message', 'Balíček byl úspěšně vytvořen.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sanitized_name)
    {
        $package = Package::where('sanitized_name', $sanitized_name)->first();

        return view('package.show', ['package' => $package]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($sanitized_name)
    {
        $package = $this->package::where('sanitized_name', $sanitized_name)->first();

        return view('package.edit', ['package' => $package]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Package $package)
    {
        $validator = Validator::make(
            $request->all(),
            $rules = [
                'name' => [
                    'required',
                    'max:100',
                ],
                'comment' => [
                    'required',
                ],
                'price' => [
                    'required',
                    'numeric',
                ],
                'image' => [
                    'mimes:jpg,png,jpeg',
                    'max:5048'
                ],
            ],
            $messages = [
                "price.required" => "Zadejte cenu.",
            ]
        )->validate();

        if ($request->input('is-one-time')) {
            $isOneTime = 1;
        } else {
            $isOneTime = 0;
        }

        $sanitizedName = Helper::instance()->friendly_url($request->name);

        $foundPackage = $this->package::where('sanitized_name', $sanitizedName)->first();


        if ($foundPackage && $foundPackage->name != $package->name) {
            throw ValidationException::withMessages(['name' => 'Tento balíček již existuje.']);
        } else {
            $package->name = $request->name;
            $package->sanitized_name = Helper::instance()->friendly_url($request->name);
            $package->comment = $request->comment;
            $package->price = $request->price;
            $package->is_one_time = $isOneTime;
            $package->color = $request->color;
            if ($request->hasFile('image')) {
                $newImageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path() . '\img\package-images', $newImageName);
                $package->image = 'img/package-images/' . $newImageName;
            }
            $package->save();

            return redirect('/admin/package')->with('message', 'Balíček byl úspěšně editován.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($sanitized_name)
    {
        $package = $this->package::where('sanitized_name', $sanitized_name)->first();
        $image_path = $package->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $package->delete();

        return redirect("/admin/package");
    }
}
