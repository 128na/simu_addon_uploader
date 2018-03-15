<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(Request $request)
  {
    $user = Auth::user();
    return view('user.index', compact('user'));
  }
  public function edit(Request $request)
  {
    $user = Auth::user();
    return view('user.edit', compact('user'));
  }
  public function update(Request $request)
  {
    $user = Auth::user();
    $request->validate([
        'name' => 'required|max:255',
        'email' => "required|unique:users,email,{$user->id}",
    ]);

    $user->fill([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
    ])->save();
    $request->session()->flash('success', __('messages.success.update'));
    return redirect()->route('user.edit', ['lang' => \App::getLocale()]);
  }
  public function delete(Request $request)
  {
    $user = Auth::user();
    try {
      $user->addons->each(function($addon) {
        unlink(static::getAddonPath($addon->path));
      });
    } catch(\Exception $e) {
      return static::errorReportAndRedirect($e, $request, __('messages.error.delete'), 'user.index');
    }

    $user->delete();
    $request->session()->flush();
    $request->session()->flash('success', __('messages.success.delete_account'));
    return redirect()->route('addon.index', ['lang' => \App::getLocale()]);
  }
}
