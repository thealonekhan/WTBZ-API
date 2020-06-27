<?php

namespace App\Http\Controllers;
use App\Http\Requests\Request;
use Illuminate\Support\Str;

/**
 * Class LanguageController.
 */
class LanguageController extends Controller
{
    /**
     * @param $lang
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function swap($lang)
    {
        session()->put('locale', $lang);

        return redirect()->back();
    }

    public function generate_slug(Request $request)
    {
        return Str::slug($request['text']);
    }
}
