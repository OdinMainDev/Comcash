<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isRootAdmin() {
        return in_array("admin", $this->roles->pluck('name')->toArray());
    }

    protected $appends = ['isNowRegistered'];
    public function getIsNowRegisteredAttribute(){
        return false;
    }

    public function getUserCredentials() {
        if($this->email)
            return $this->email;
        if($this->telegram)
            return $this->telegram;
        
        return "(".$this->id.") ".$this->first_name." ".$this->second_name." ".$this->last_name;
    }

    public function getCountExchanges() {
        return Exchange::where("user_id", $this->id)->where("status", 5)->count();
    }

    public function getTelegramUsers() {
        return $this->hasMany(TelegramUser::class, "telegram_id", "telegram_id")->with("getBot");
    }
}
