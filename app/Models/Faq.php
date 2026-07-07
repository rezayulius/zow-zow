<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Sanitize rich-text HTML from the admin editor before it's persisted,
    // so a compromised/malicious admin account can't stash a stored-XSS
    // payload in a field rendered unescaped ({!! !!}) on the public site.
    public function setAnswerAttribute($value)
    {
        $this->attributes['answer'] = $value === null ? null : clean($value);
    }
}
