<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;
use App\Models\User;

class IndexController extends Controller
{
    public function home()
    {
        return view('home', [
            'users' => User::get(),
        ]);
    }

    public function freshSeed()
    {
        Artisan::call('migrate:fresh --seed');
        return redirect()->back()
            ->with('success', 'Migrate fresh and Seed generated');
    }
}