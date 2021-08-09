<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use SoftDeletes;

    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasTimestamps;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $dispatchesEvents = [

    ];

    public function sent_messages()
    {
        return $this->hasManyThrough(Message::class,
            Conversations::class,
            'sender_id',
            'conversation_id'
        );
    }

    public function received_messages()
    {
        return $this->hasManyThrough(Message::class,
            Conversations::class,
            'receiver_id',
            'conversation_id'
        );
    }


    public function all_messages($conversation_id)
    {

        return Message::where('conversation_id', $conversation_id)
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function owining_messages()
    {
        return $this->hasMany(Message::class);
    }

    public function last_conversation_message($sender) {
        $messages = $this->conversation_messages($sender);
        if(!$messages) {
            return false;
        }
        return $messages->first();
    }

    public function conversation_all_messages($sender) {
        $messages = $this->conversation_messages($sender);
        if(!$messages) {
            return false;
        }
        return $messages->get();
    }

    private function conversation_messages($sender) {
        $array = [$sender, $this->id];
        sort($array);
        $salt = base64_encode(implode(',', $array));
        $conversation = Conversations::where('conversation_salt', $salt)->first();

        if(!$conversation) {
            return false;
        }
        return Message::where('conversation_id', $conversation->id)->orderBy('created_at', 'asc');
    }


}
