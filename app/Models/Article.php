<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Watson\Validating\ValidatingTrait;

class Article extends Model
{
    use ValidatingTrait;

    protected $fillable = ['title', 'body', 'published_at', 'archived_at'];
    protected $rules = [
        'title' => 'required|max:255',
        'body' => 'required',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeUnarchived(Builder $query)
    {
        $query->whereNull('archived_at');
    }

    public function scopeArchived(Builder $query)
    {
        $query->whereNotNull('archived_at');
    }

    public function scopeSearchBody(Builder $query, $search)
    {
        $query->where('body', 'LIKE', "%$search%");
    }

    public function archive()
    {
        $this->timestamps = false;
        $this->update(['archived_at' => now()]);
        $this->timestamps = true;
    }
}
