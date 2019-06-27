<?php

namespace App\Http\Middleware;

use App\Category;
use Closure;

class VerifyCsrfCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if (Category::all()->count()==0)
      {
         session()->flash('error','you need create category befor create post');
          return redirect(url('/categories/create'));
      }
        return $next($request);
    }
}
