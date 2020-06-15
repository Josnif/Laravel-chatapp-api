## About Laravel ChatApp



## Get Message

- # Get All Messages
```php
public function getAllConversation(Request $request)
    {
        $id=$request->id;

        $conversations[] = Message::with('receiver')->where('user_id', $id)->get();
        $conversations[] = Message::with('sender')->where('receiver_id', $id)->get();

        $allConversations = json_decode(json_encode($conversations), true);

        return response()->json($allConversations, 200);

    }

```
- # Get Private Messages
```php
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

```
