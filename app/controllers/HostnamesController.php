<?php

class HostnamesController extends BaseController
{

    protected $hostname;

    public function __construct(Hostname $hostname)
    {
        $this->hostname = $hostname;

    }

    public function index($objectId)
    {
        $object = Object::findOrFail($objectId);
        $hostnames = $object->hostnames;

        return View::make('hostnames.index', compact('hostnames', 'objectId'));
    }

    public function create($objectId)
    {
        Object::findOrFail($objectId);

        return View::make('hostnames.create', compact('objectId'));
    }

    public function store($objectId)
    {
        Object::findOrFail($objectId);

        $input = Input::all();
        $validation = Validator::make($input, Hostname::$rules);

        if ($validation->passes()) {
            // if checkbox is not checked
            if (!isset($input['block'])) $input['block'] = 0;

            // will return the model hostname as array
            $hostname = $this->hostname->firstOrNew($input)->toArray();
            // with true to don't duplicate items
            Object::where('_id', $objectId)->push('hostnames', $hostname, true);

            return Redirect::route('objects.hostnames.index', array($objectId));
        }

        return Redirect::route('objects.hostnames.create', array($objectId))
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function show($objectId, $id)
    {
        $object = Object::findOrFail($objectId);

        if (isset($object->hostnames[$id])) {
            $hostname = $object->hostnames[$id];
        } else {
            return Redirect::route('objects.hostnames.index', $objectId);
        }

        return View::make('hostnames.show', compact('hostname', 'objectId', 'id'));
    }

    public function edit($objectId, $id)
    {
        $object = Object::findOrFail($objectId);
        if (isset($object->hostnames[$id])) {
            $hostname = $object->hostnames[$id];
        } else {
            return Redirect::route('objects.hostnames.index', $objectId);
        }

        return View::make('hostnames.edit', compact('hostname', 'objectId', 'id'));
    }

    public function update($objectId, $id)
    {
        $object = Object::findOrFail($objectId)->toArray();
        if (!isset($object['hostnames'][$id])) {
            return Redirect::route('objects.hostnames.index', $objectId);
        }

        $input = array_except(Input::all(), '_method');
        $validation = Validator::make($input, Hostname::$rules);

        if ($validation->passes()) {
            // if checkbox is not checked
            if (!isset($input['block'])) $input['block'] = 0;

            // will return the model hostname as array
            $hostname = $this->hostname->firstOrNew($input)->toArray();

            // replace with updated hostname
            $object['hostnames'][$id] = $hostname;
            $object = array_except($object, '_id');

            Object::where('_id', $objectId)->update($object);

            return Redirect::route('objects.hostnames.index', $objectId);
        }

        return Redirect::route('objects.hostnames.edit', $objectId, $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function destroy($objectId, $id)
    {
        $object = Object::findOrFail($objectId);

        if (isset($object->hostnames[$id]))
            Object::where('_id', $objectId)->pull('hostnames', $object->hostnames[$id]);

        return Redirect::route('objects.hostnames.index', $objectId);
    }

}
