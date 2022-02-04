<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

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
                'smsprice' => [
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
                "smsprice.required" => "Zadejte cenu sms.",
            ]
        )->validate();

        // $image = $request->file('image');
        // $imgName = $input['imagename'] = time() . '.' . $image->extension();
        // $destinationPath = public_path('img\package-images');

        // $img = Image::make($image->path());
        // $img->save($destinationPath . '/' . $imgName);
        // $path = Storage::putFileAs(
        //     'img',
        //     $request->image,
        //     time() . '.' . $request->image->extension(),
        // );
        $path = $request->file('image')->storeAs('img/package-images',  time() . '.' . $request->image->extension(),  'public');

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
            'sms_price' => $request->smsprice,
            'is_one_time' => $isOneTime,
            'color' => $request->color,
            'image' =>  '/storage/' . $path,
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
                'smsprice' => [
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
                "smsprice.required" => "Zadejte cenu SMS.",
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
            $package->sms_price = $request->smsprice;
            $package->is_one_time = $isOneTime;
            $package->color = $request->color;
            if ($request->hasFile('image')) {
                $oldPath = str_replace('storage', 'public', $package->image);
                if (Storage::exists($oldPath)) {
                    Storage::delete($oldPath);
                }
                $path = $request->file('image')->storeAs('img/package-images',  time() . '.' . $request->image->extension(),  'public');
                $package->image = '/storage/' . $path;
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
        $oldPath = str_replace('storage', 'public', $package->image);
        if (Storage::exists($oldPath)) {
            Storage::delete($oldPath);
        }
        $package->delete();

        return redirect("/admin/package");
    }
}
