<?php

// app/Models/Chat.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'created_by'];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // public function messages()
    // {
    //     return $this->hasMany(Message::class);
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'created_by');
    // }
}
