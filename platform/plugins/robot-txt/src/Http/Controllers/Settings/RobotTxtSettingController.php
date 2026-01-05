<?php

namespace Botble\RobotTxt\Http\Controllers\Settings;

use Botble\Base\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class RobotTxtSettingController extends BaseController
{
  public function edit()
  {
    $this->pageTitle('robots.txt');

    $path = public_path('robots.txt');
    $content = '';

    if (File::exists($path)) {
      $content = File::get($path);
    }

    return view('plugins/robot-txt::settings.edit', compact('content'));
  }

  public function update(Request $request)
  {
    $request->validate([
      'content' => 'nullable|string',
    ]);

    $path = public_path('robots.txt');

    try {
      File::put($path, (string)$request->input('content', ''));

      return redirect()->route('robot-txt.settings')->with('success_msg', 'Saved successfully');
    } catch (Exception $exception) {
      return redirect()->route('robot-txt.settings')->with('error_msg', $exception->getMessage());
    }
  }
}
