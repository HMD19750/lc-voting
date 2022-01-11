<?php

namespace App\Models;

use App\Models\Idea;
use App\Models\Like;
use App\Models\User;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function idea()
    {
        return $this->belongsTo(Idea::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    // Returns list of user that liked this comment
    public function likes()
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    public function isLikedByUser(?User $user)          //? is to make class optional
    {
        if (!$user) {                                    // Check for no user logged in
            return false;
        }

        return Like::where('user_id', $user->id)
            ->where('comment_id', $this->id)
            ->exists();
    }

    public function like(User $user)
    {
        Like::create([
            'user_id' => $user->id,
            'comment_id' => $this->id
        ]);
    }

    public function removeLike($user)
    {
        $likeToDelete = Like::where('user_id', $user->id)
            ->where('comment_id', $this->id)
            ->first();

        if ($likeToDelete) {
            $likeToDelete->delete();
        } else {
            throw new NotFoundException;
        }
    }
}
