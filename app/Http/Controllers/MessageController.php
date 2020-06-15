<?php

namespace App\Http\Controllers;

use App\User;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Message::get()->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'messages' => 'required'
        // ]);

        $message = Message::create([
            'messages' => $request->messages,
            // 'user_id' => auth()->user()->id,
            'user_id' => $request->user,
            'receiver_id' => $request->receiver
        ]);

        return response()->json($message, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    // Output all messages for the user with the information of the friend
    public function getAllConversation(Request $request)
    {
        $id=$request->id;

        $conversations[] = Message::with('receiver')->where('user_id', $id)->get();
        $conversations[] = Message::with('sender')->where('receiver_id', $id)->get();

        $allConversations = json_decode(json_encode($conversations), true);

        return response()->json($allConversations, 200);

    }


    public function privateMessage(Request $request)
    {
        $userId = $request->user;
        $friend = $request->friend;



        // Get messages for private chat
            $messages = Message::where(['user_id' => $userId, 'receiver_id' => $friend])
                                ->orWhere(function($query) use($userId, $friend) {
                                    $query->where(['user_id' => $friend, 'receiver_id' => $userId]);
            })->get();

        return response()->json($messages, 200);

    }

    public function update(Request $request, $id)
    {
        $message = Message::findOrFail($id);

    }

    public function markAsRead($userId, $friend) {
        // $id is the authenticated friend id
        $messages = Message::where(['user_id' => $userId, 'receiver_id' => $friend])
                            ->orWhere(function($query) use($userId, $friend) {
                                $query->where(['user_id' => $friend, 'receiver_id' => $userId]);
        })->get();

        foreach ($messages as $message) {
            if($message->receiver_id == $userId || $message->user_id == $userId) {
                $message->is_read = 1;
                $message->save();
            }
        }

        return response()->json('Change made', 401);
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);

        $message->delete();

        return ['message' => 'Deleted successfully'];
    }
}
