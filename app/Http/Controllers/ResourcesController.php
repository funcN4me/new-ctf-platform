<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Resources\StoreResourceRequest;
use App\Models\Action;
use App\Models\Resource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResourcesController extends Controller
{
    public function list(): View
    {
        $resources = Resource::all();

        return view('resources.list', compact('resources'));
    }

    public function show(Resource $resource): View
    {
        return view('resources.resource', compact('resource'));
    }

    public function create(): View
    {
        return view('resources.create');
    }

    public function store(StoreResourceRequest $request): RedirectResponse
    {
        $input = $request->input();
        $currentUser = Auth::user();

        $resource = Resource::create($input);

        foreach ($input['resource_parts'] as $resourcePart) {
            $resource->parts()->create(['name' => $resourcePart]);
        }

        $currentUser->actions()->create([
            'type' => Action::ACTION_CREATED_RESOURCE,
            'target_id' => $resource->id,
            'target_name' => $resource->name,
        ]);

        return redirect()->route('resources.resource.edit', ['resource' => $resource->id])->with('message-success', 'Ресурс создан');
    }

    public function showEdit(Resource $resource): View
    {
        return view('resources.edit', compact('resource'));
    }

    public function edit(StoreResourceRequest $request, Resource $resource): RedirectResponse
    {
        $input = $request->input();

        $resource->parts()->delete();
        if (isset($input['resource_parts'])) {
            foreach ($input['resource_parts'] as $resourcePart) {
                $resource->parts()->firstOrCreate([
                    'name' => $resourcePart
                ]);
            }
        }

        $resource->update($request->input());

        return back()->with('message-success', 'Ресурс изменён');
    }

    public function markAsRead(Resource $resource): RedirectResponse
    {
        $currentUser = Auth::user();

        $currentUser->resources()->attach($resource->id);

        $currentUser->actions()->create([
            'type' => Action::ACTION_READ_RESOURCE,
            'target_id' => $resource->id,
            'target_name' => $resource->name,
        ]);

        return back()->with('message-success', 'Ресурс отмечен как прочитанный');
    }

    public function deleteShow(Resource $resource): View
    {
        return view('resources.modals.delete_resource', compact('resource'));
    }

    public function delete(Resource $resource): RedirectResponse
    {
        $resource->delete();

        return back()->with('message-success', 'Ресурс удалён');
    }
}
