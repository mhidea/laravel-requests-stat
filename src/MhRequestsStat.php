<?php

namespace Mhidea\LaravelRequestsStat;

use Illuminate\Database\Eloquent\Model;

class MhRequestsStat extends Model
{
    protected $fillable = ['path'];
    public  $appends = ['diffInDays'];

    public function getDiffInDaysAttribute()
    {
        if (!empty($this->created_at) && !empty($this->updated_at)) {
            return $this->updated_at->diffForHumans();
        }
    }
}
