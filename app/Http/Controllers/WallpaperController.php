<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallpaper;

class WallpaperController extends Controller {
    public function index() {
        $wallpapers = Wallpaper::all();
        $selectedWallpaper = Wallpaper::where('is_selected', true)->first();
        return view('admin.AdminWallpaper', compact('wallpapers', 'selectedWallpaper'));
    }

    public function changeWallpaper(Request $request) {
        // Unselect all wallpapers
        Wallpaper::query()->update(['is_selected' => false]);

        // Set the selected wallpaper
        $wallpaper = Wallpaper::find($request->wallpaper_id);
        if ($wallpaper) {
            $wallpaper->is_selected = true;
            $wallpaper->save();
            return response()->json(['success' => true, 'video_path' => asset($wallpaper->video_path)]);
        }

        return response()->json(['success' => false]);
    }
}

