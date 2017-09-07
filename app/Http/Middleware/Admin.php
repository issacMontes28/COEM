<?php

namespace COEM\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class Admin
{
    protected $auth;
    public function __construct(Guard $auth){
      $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->tipo_usuario != "administrador") {
          Session::flash('message-error','Sin privilegios para esta funcionalidad');
          return redirect()->to('user');
        }
        return $next($request);
    }
}
