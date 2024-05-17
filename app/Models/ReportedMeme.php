<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedMeme extends Model
{
    use HasFactory;

    protected $fillable = ['meme_id', 'user_id', 'reason'];

    public function meme()
    {
        return $this->belongsTo(Meme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
