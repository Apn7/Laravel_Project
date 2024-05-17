<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Meme extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'imgurl',
        'description',
        'tags'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilter($query, array $filters)
    {
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }
        if ($filters['search'] ?? false) {
            $query->where('description', 'like', '%' . request('search') . '%')
                  ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    public function scopeTrending($query)
    {
        $now = now();
        return $query->withCount('likes')
                     ->withCount('comments')
                     ->orderByDesc(DB::raw('
                         (likes_count + (comments_count * 2)) /
                         POWER(TIMESTAMPDIFF(SECOND, created_at, "' . $now . '"), 1.5)
                     '));
    }

    public function reportedMemes()
    {
        return $this->hasMany(ReportedMeme::class);
    }
    
}
