<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Cookie;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $value = Cookie::get('didPass');

        abort_if($value !== "guarded", 403, $message = 'Sorry Please try again');

        return view('layouts.app');
    }
}
