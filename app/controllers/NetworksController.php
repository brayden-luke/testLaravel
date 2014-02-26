<?php

class NetworksController extends BaseController
{

    protected $network;

    public function __construct(Network $network)
    {
        $this->network = $network;

    }

    public function index($objectId)
    {
        $object = Object::findOrFail($objectId);
        $networks = $object->networks;

        return View::make('networks.index', compact('networks', 'objectId'));
    }

    public function create($objectId)
    {
        Object::findOrFail($objectId);

        return View::make('networks.create', compact('objectId'));
    }

    public function store($objectId)
    {
        Object::findOrFail($objectId);

        $input = Input::all();
        $validation = Validator::make($input, Network::$rules);

        if ($validation->passes()) {
            // if checkbox is not checked
            if (!isset($input['n_status'])) $input['n_status'] = 0;

            // will return the model Network as array
            $network = $this->network->firstOrNew($input)->toArray();
            // with true to don't duplicate items
            Object::where('_id', $objectId)->push('networks', $network, true);

            return Redirect::route('objects.networks.index', array($objectId));
        }

        return Redirect::route('objects.networks.create', array($objectId))
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function show($objectId, $id)
    {
        $object = Object::findOrFail($objectId);

        if (isset($object->networks[$id])) {
            $network = $object->networks[$id];
        } else {
            return Redirect::route('objects.networks.index', $objectId);
        }

        return View::make('networks.show', compact('network', 'objectId', 'id'));
    }

    public function edit($objectId, $id)
    {
        $object = Object::findOrFail($objectId);
        if (isset($object->networks[$id])) {
            $network = $object->networks[$id];
        } else {
            return Redirect::route('objects.networks.index', $objectId);
        }

        return View::make('networks.edit', compact('network', 'objectId', 'id'));
    }

    public function update($objectId, $id)
    {
        $object = Object::findOrFail($objectId)->toArray();
        if (!isset($object['networks'][$id])) {
            return Redirect::route('objects.networks.index', $objectId);
        }

        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Network::$rules);

        if ($validation->passes()) {
            // if checkbox is not checked
            if (!isset($input['n_status'])) $input['n_status'] = 0;

            // will return the model Network as array
            $network = $this->network->firstOrNew($input)->toArray();

            // replace with updated Network
            $object['networks'][$id] = $network;
            $object = array_except($object, '_id');

            Object::where('_id', $objectId)->update($object);

            return Redirect::route('objects.networks.index', $objectId);
        }

        return Redirect::route('objects.networks.edit', $objectId, $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function destroy($objectId, $id)
    {
        $object = Object::findOrFail($objectId);

        if (isset($object->networks[$id]))
            Object::where('_id', $objectId)->pull('networks', $object->networks[$id]);

        return Redirect::route('objects.networks.index', $objectId);
    }

}
