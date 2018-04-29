<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class QuestionCategory
 * @package App\Models
 * @version April 21, 2018, 1:07 pm UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection Question
 * @property string name
 * @property string banner
 */
class QuestionCategory extends Model
{
    use SoftDeletes;

    public $table = 'question_categories';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'banner'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'banner' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function questions()
    {
        return $this->hasMany(\App\Models\Question::class);
    }
}
