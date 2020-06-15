## About Laravel ChatApp

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:


## Get Message

- # Get All Messages
```php
public function getAllMessage(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $message = Message::where('user_id', $user->id)
                            ->orWhere('receiver_id', $user->id)->get();

        if($message) {
            return response()->json($message, 200);
        }

    }

// Route for all messages
Route::get('allMessage/{id}', 'MessageController@getAllMessage');
// This should be called for displaying all the messages of the user on the home page for  sender($user_id) and reciever if $user->id == receiver_id
```
- # Get Private Messages

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
