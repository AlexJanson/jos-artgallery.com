<?php

use App\Mail\ContactConfirm;
use App\Mail\ContactOrder;
use App\Models\Painting;
use Illuminate\Foundation\Application;
use Illuminate\Mail\Markdown;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return inertia('Site/Home');
})->name('home');

Route::get('/gallery', function () {
    $paintings = Painting::orderBy('order', 'ASC')->get();

    return inertia('Site/Gallery', [
        'paintings' => $paintings
    ]);
})->name('gallery');

Route::get('/gallery/{painting:slug}', function (Painting $painting) {
    return inertia('Site/Detail', [
        'painting' => $painting
    ]);
})->name('gallery.detail');

Route::get('/about', function () {
    return inertia('Site/About');
})->name('about');

Route::get('/leasing', function () {
    return inertia('Site/Leasing');
})->name('leasing');

Route::get('/contact', function () {
    return inertia('Site/Contact');
})->name('contact');

Route::post('/contact', function () {
    $validated = request()->validate([
        'name' => 'required',
        'lastname' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required|max:500',
    ]);

    Mail::to($validated["email"])->send(new ContactConfirm($validated));
    Mail::to("info@jos-artgallery.com")->send(new ContactOrder($validated));

    session()->flash('flash.banner', 'Uw bericht is goed aangekomen 😊!');
    session()->flash('flash.bannerStyle', 'success');

    return back();
})->name('contact.send');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return inertia('Dashboard/Show', [
        'paintings' => Painting::orderBy('order', 'ASC')->get()
    ]);
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->post('/paintings', function () {
    $validated = request()->validate([
        'photo' => 'required|image',
        'name' => ['required', Rule::unique('paintings', 'name')],
        'make' => 'required',
        'price' => 'required|numeric',
        'width' => 'required|numeric',
        'height' => 'required|numeric'
    ]);

    $validated['photo'] = request()->file('photo')->store('photos');
    $validated['slug'] = Str::slug($validated['name'], '-');
    $validated['order'] = 9999;

    Painting::create($validated);

    return redirect('/dashboard');
})->name('painting.create');

Route::middleware(['auth:sanctum', 'verified'])->delete('/paintings', function () {
    $painting = Painting::find(request()->id);
    $painting->delete();

    return redirect('/dashboard');
})->name('painting.delete');

Route::middleware(['auth:sanctum', 'verified'])->put('/paintings', function () {
    $painting = Painting::find(request()->id);
    $painting->sold = request()->sold;
    $painting->save();

    return redirect('/dashboard');
})->name('painting.sold');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/edit/{painting:slug}', function (Painting $painting) {
    return inertia('Painting/Edit/Show', [
        'painting' => $painting
    ]);
})->name('painting.edit');

Route::middleware(['auth:sanctum', 'verified'])->post('/painting', function () {
    $validated = request()->validate([
        'photo' => 'image',
        'name' => ['required', Rule::unique('paintings', 'name')->ignore(request()->id)],
        'make' => 'required',
        'price' => 'required|numeric',
        'width' => 'required|numeric',
        'height' => 'required|numeric'
    ]);

    $painting = Painting::find(request()->id);
    $painting->name = $validated["name"];
    $painting->make = $validated["make"];
    $painting->price = $validated["price"];
    $painting->width = $validated["width"];
    $painting->height = $validated["height"];

    if (request()->photo) {
        $painting->photo = request()->file('photo')->store('photos');
        $painting->slug = Str::slug($validated['name'], '-');
    }

    $painting->save();

    return redirect('/dashboard');
})->name('painting.update');

Route::middleware(['auth:sanctum', 'verified'])->put('/paintings/order', function () {
    for ($i = 0; $i < count(request()->ids); $i++) {
        $project = Painting::find(request()->ids[$i]);
        $project->order = request()->orders[$i];
        $project->save();
    }

    return back();
})->name('paintings.order');

Route::post('/painting/view', function () {
    $painting = Painting::find(request()->id);
    $painting->increment('views');

    return back();
})->name('painting.view');
