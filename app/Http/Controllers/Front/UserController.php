<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class UserController extends Controller
{
  public function showUserName(){
      return 'Ahmed Fathy';
  }
}
