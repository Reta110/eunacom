<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Question
 * @package App\Models
 * @version April 21, 2018, 1:08 pm UTC
 *
 * @property \App\Models\QuestionCategory questionCategory
 * @property integer code
 * @property longText title
 * @property string options
 * @property longText positive_feddback
 * @property longText feddback_positive
 * @property longText feddback_wrong
 * @property string status
 * @property integer category_id
 */
class Question extends Model
{
    use SoftDeletes;

    public $table = 'questions';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'code',
        'title',
        'options',
        'positive_feddback',
        'feddback_positive',
        'feddback_wrong',
        'status',
        'category_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'code' => 'integer',
        'options' => 'string',
        'status' => 'string',
        'category_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'options' => 'required',
        'positive_feddback' => 'required',
        'feddback_positive' => 'required',
        'feddback_wrong' => 'required',
        'status' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function questionCategory()
    {
        return $this->belongsTo(\App\Models\QuestionCategory::class, 'category_id', 'id');
    }
}
