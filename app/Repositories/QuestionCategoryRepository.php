<?php

namespace App\Repositories;

use App\Models\QuestionCategory;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class QuestionCategoryRepository
 * @package App\Repositories
 * @version April 21, 2018, 1:07 pm UTC
 *
 * @method QuestionCategory findWithoutFail($id, $columns = ['*'])
 * @method QuestionCategory find($id, $columns = ['*'])
 * @method QuestionCategory first($columns = ['*'])
*/
class QuestionCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return QuestionCategory::class;
    }
}
