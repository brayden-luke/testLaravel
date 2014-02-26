<?php

class ObjectsController extends BaseController {

	protected $object;

	public function __construct(Object $object)
	{
		$this->object = $object;
	}

	public function index()
	{
		$objects = $this->object->all();

		return View::make('objects.index', compact('objects'));
	}

	public function create()
	{
		return View::make('objects.create');
	}

	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Object::$rules);

		if ($validation->passes())
		{
			$this->object->create($input);

			return Redirect::route('objects.index');
		}

		return Redirect::route('objects.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	public function show($id)
	{
		$object = $this->object->findOrFail($id);

		return View::make('objects.show', compact('object'));
	}

    public function json($id)
    {
        return $this->object->findOrFail($id)->toJson();

    }

	public function edit($id)
	{
		$object = $this->object->find($id);

		if (is_null($object))
		{
			return Redirect::route('objects.index');
		}

		return View::make('objects.edit', compact('object'));
	}

	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Object::$rules);

		if ($validation->passes())
		{
			$object = $this->object->find($id);
			$object->update($input);

			return Redirect::route('objects.show', $id);
		}

		return Redirect::route('objects.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	public function destroy($id)
	{
		$this->object->find($id)->delete();

		return Redirect::route('objects.index');
	}

}
