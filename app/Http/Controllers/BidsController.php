<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use Illuminate\Http\Request;

class BidsController extends Controller
{
    public function delete(Request $request){
        $id = $request->input('id');
        $bid = Bid::find($id);
        $bid->delete();
    }

    public function store(Request $request){
        $bid = new Bid();
        $bid->FIO = $request->name;
        $bid->Email = $request->email;
        $bid->Phone = $request->telephone;
        $bid->Text = $request->text;

        $bid->save();
        return redirect()->route('main_page')->with('success', 'Заявка успешно отправлена!');
    }
}
