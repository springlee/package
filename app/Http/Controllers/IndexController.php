<?php

namespace App\Http\Controllers;



class IndexController extends Controller
{

    public function index()
    {
        return view('index.index');
    }

    public function main()
    {

        return view('index.main');
    }


    public function changeLocale($locale)
    {
        if (in_array($locale, ['en', 'zh-CN'])) {
            session()->put('locale', $locale);
        }
        return redirect()
            ->back()
            ->withInput();
    }

}
