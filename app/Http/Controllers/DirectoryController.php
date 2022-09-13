<?php

namespace App\Http\Controllers;

use App\Directory as MembershipDirectory;
use App\DirectoryList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectoryController extends Controller
{
    public function index() {
        $directory_settings = MembershipDirectory::first();
        $directory_settings->image = Storage::url($directory_settings->image);

        $directory_list = DirectoryList::orderBy("ht_pos")->orderBy("id")->get();

        return compact("directory_settings", "directory_list");
    }
}
