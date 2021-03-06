<?php namespace Swapshop\Repositories;

abstract class DbBaseRepository extends BaseRepository {

	protected $model;

	public function __construct($model)
	{
		$this->model = $model;
	}

	public function all()
	{
		return $this->model->all()->toArray();
	}

	public function allWith(array $with)
	{
		return $this->model->with($with)->get()->toArray();
	}

	public function create($input)
	{
		return $this->model->create($input)->toArray();
	}

	public function update($id, $input)
	{
		return $this->model->find($id)->update($input);
	}

	public function find($id)
	{
		$model = $this->model->find($id);

		if($model)
		{
			return $model->toArray();
		}

		return null;
	}

	public function findSlug($slug)
	{
		return $this->model->where('slug', '=', $slug)->first()->toArray();
	}

	public function findWith($id, array $with)
	{
		return $this->model->with($with)->find($id)->toArray();
	}

	public function findSlugWith($slug, array $with)
	{
		return $this->model->where('slug', '=', $slug)->with($with)->first()->toArray();
	}

	public function delete($id)
	{
		return $this->model->find($id)->delete();
	}

}