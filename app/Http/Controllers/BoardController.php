<?php

namespace App\Http\Controllers;

use App\BoardList;
use App\BoardOfDirectorsSetting;
use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BoardController extends Controller
{
    public function index() {

        $board_settings = BoardOfDirectorsSetting::first();
        $board_settings->phone_icon = Storage::url($board_settings->phone_icon);
        $board_settings->fax_icon = Storage::url($board_settings->fax_icon);
        $board_settings->mail_icon = Storage::url($board_settings->mail_icon);

        $board_members = BoardList::
        with("department")
        ->orderBy("ht_pos")
        ->orderBy("id")
        ->get();

        $departments = Department::orderBy("ht_pos")
        ->orderBy("id")
        ->get();

        return compact("board_settings", "board_members", "department");

    }
}
