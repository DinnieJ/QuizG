<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Quiz;
class CheckIfRightUser
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
        $quiz = Quiz::find($request->route('id'));
        if($quiz == null){
            return response([
                'error' => 'Not found',
            ],404);
        }
        if($quiz->user_id != Auth::user()->id){
            return response([
                'error' => 'Unauthorized',
            ],403);
        }

        return $next($request);
    }
}
