<?php


namespace Habib\Commentable\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commentable extends Model
{

    use SoftDeletes;

    protected $table = 'commentables';

    protected $casts = [
        'active' => 'boolean',
        'user_id' => 'integer',
        'commentable_id' => 'integer',
        'commentable_type' => 'string',
        'comment' => 'string',
    ];

    protected $fillable = [
        'active',
        'user_id',
        'commentable_id',
        'commentable_type',
        'comment',
    ];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function makeActive()
    {
        $this->active = true;
        return $this;
    }

    public function makeNotActive()
    {
        $this->active = false;
        return $this;
    }

    public function ActiveToggle()
    {
        $this->active = (boolean)!$this->active;
        return $this;
    }

    public function scopeActiveStatus(Builder $query, $status = true)
    {
        return $query->where('active', $status);
    }

    public function scopeSearchComment(Builder $query, $column, $like = false)
    {
        $value = request($column, null);
        return $query->when($value, function (Builder $builder) use ($value, $like, $column) {
            $mark = $like ? '%' : '';
            return $builder->where($column, $like ? 'LIKE' : '=', $mark . $value . $mark);
        });
    }

    public function comments()
    {
        return $this->hasMany(self::class, 'comment_id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'comment_id');
    }

}
