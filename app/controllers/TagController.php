<?php

use Swapshop\Repositories\TagRepositoryInterface;
use Swapshop\Services\Validators\TagValidator;

class TagController extends BaseController {

	public $restful = true;

	protected $tagRepository;
	protected $tagValidator;

	public function __construct(TagRepositoryInterface $tagRepository, TagValidator $tagValidator)
	{
		$this->tagRepository = $tagRepository;
		$this->tagValidator = $tagValidator;
	}

	// CRUD Functions

	public function getIndex()
	{

		$tags = $this->tagRepository->all();

		return View::make('tags.index', compact('tags'));
	}

	public function getShow($tagID)
	{
		$tag = $this->tagRepository->find($tagID);

		return View::make('tags.show', compact('tag'));
	}

	public function getCreate()
	{
		return View::make('tags.create');
	}

	public function postCreate()
	{
		$input = Input::all();

		$v = new $this->tagValidator($input);

		if($v->passes())
		{
			$this->tagRepository->create($input);

			return Redirect::action('TagController@getIndex')
				->with('message','Tag created');
		}

		return Redirect::action('TagController@getIndex')
			->withErrors($v->errors)
			->with('error','Error creating Tag');

	}

	public function getEdit($tagID)
	{
		$tag = $this->tagRepository->find($tagID);

		return View::make('tags.edit', compact('tag'));
	}

	public function postEdit($tagID)
	{
		$input = Input::all();

		$v = new TagValidator($input);
		
		if($v->passes())
		{
			$this->tagRepository->update($tagID, $input);

			return Redirect::action('TagController@getIndex')
				->with('message','Tag Created');
		}

		return Redirect::action('TagController@getEdit')
			->withErrors($v->errors())
			->with('error','Error updating Tag');
	}

	public function getDelete($tagID)
	{
		$tag = $this->tagRepository->find($tagID);

		return View::make('tags.delete', compact('tag'));
	}

	public function deleteDelete($tagID)
	{
		$this->tagRepository->delete($tagID);

		return Redirect::action('TagController@getIndex')
			->with('message','Tag Deleted');
	}

	// Get listings for Tag

	public function getProducts($tagID)
	{
		$tag = $this->tagRepository->findWith($tagID, array('products','products.listings'));

		return View::make('tags.products', compact('tag'));
	}


}


