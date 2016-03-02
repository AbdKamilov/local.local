<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Message;

class FormController extends Controller
{
    //
    public function index()
    {

        $data = ['title'=>'Конок китепчеси..',
            'action'=>'message/add',
            'messages'=>Message::orderBy('updated_at','desc')->paginate(3),//bir barakta kancha maalimat chygaruu
            'count'=>Message::count(),//sanap beruu

        ];

        return view('pages.messages.index',$data);
    }

    public function edit($id)
    {
            $data = ['title' => 'Озгортуу',
                'action'=>'up',
                'message' => Message::findOrFail($id),
            ];
            return view('pages.messages.edit')->with($data);

    }

    public function update($id,Request $request)
    {
        $m = Message::findOrFail($id);
        $m->username = $request->f_name;
        $m->email = $request->f_email;
        $m->message = $request->f_message;
        $m->save();

        return redirect ('/form');
    }
    public function add(Request $request)
    {
        $m = new Message;
        $m->username = $request->f_name;
        $m->email = $request->f_email;
        $m->message = $request->f_message;
        $m->save();

        return redirect ('/form');
    }

    public function delete($id)
    {
        Message::findOrFail($id)->delete();
        return redirect('/form');
    }
}
