<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionCategoryRequest;
use App\Http\Requests\UpdateQuestionCategoryRequest;
use App\Repositories\QuestionCategoryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class QuestionCategoryController extends AppBaseController
{
    /** @var  QuestionCategoryRepository */
    private $questionCategoryRepository;

    public function __construct(QuestionCategoryRepository $questionCategoryRepo)
    {
        $this->questionCategoryRepository = $questionCategoryRepo;
    }

    /**
     * Display a listing of the QuestionCategory.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->questionCategoryRepository->pushCriteria(new RequestCriteria($request));
        $questionCategories = $this->questionCategoryRepository->all();

        return view('question_categories.index')
            ->with('questionCategories', $questionCategories);
    }

    /**
     * Show the form for creating a new QuestionCategory.
     *
     * @return Response
     */
    public function create()
    {
        return view('question_categories.create');
    }

    /**
     * Store a newly created QuestionCategory in storage.
     *
     * @param CreateQuestionCategoryRequest $request
     *
     * @return Response
     */
    public function store(CreateQuestionCategoryRequest $request)
    {
        $input = $request->all();

        $questionCategory = $this->questionCategoryRepository->create($input);

        Flash::success('Question Category saved successfully.');

        return redirect(route('questionCategories.index'));
    }

    /**
     * Display the specified QuestionCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $questionCategory = $this->questionCategoryRepository->findWithoutFail($id);

        if (empty($questionCategory)) {
            Flash::error('Question Category not found');

            return redirect(route('questionCategories.index'));
        }

        return view('question_categories.show')->with('questionCategory', $questionCategory);
    }

    /**
     * Show the form for editing the specified QuestionCategory.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $questionCategory = $this->questionCategoryRepository->findWithoutFail($id);

        if (empty($questionCategory)) {
            Flash::error('Question Category not found');

            return redirect(route('questionCategories.index'));
        }

        return view('question_categories.edit')->with('questionCategory', $questionCategory);
    }

    /**
     * Update the specified QuestionCategory in storage.
     *
     * @param  int              $id
     * @param UpdateQuestionCategoryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateQuestionCategoryRequest $request)
    {
        $questionCategory = $this->questionCategoryRepository->findWithoutFail($id);

        if (empty($questionCategory)) {
            Flash::error('Question Category not found');

            return redirect(route('questionCategories.index'));
        }

        $questionCategory = $this->questionCategoryRepository->update($request->all(), $id);

        Flash::success('Question Category updated successfully.');

        return redirect(route('questionCategories.index'));
    }

    /**
     * Remove the specified QuestionCategory from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $questionCategory = $this->questionCategoryRepository->findWithoutFail($id);

        if (empty($questionCategory)) {
            Flash::error('Question Category not found');

            return redirect(route('questionCategories.index'));
        }

        $this->questionCategoryRepository->delete($id);

        Flash::success('Question Category deleted successfully.');

        return redirect(route('questionCategories.index'));
    }
}
