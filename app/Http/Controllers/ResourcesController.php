<?php

declare(strict_types=1);

namespace App\Http\Controllers;

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

    public function showEdit(Resource $resource): View
    {
        return view('resources.edit', compact('resource'));
    }

    public function edit(Request $request, Resource $resource): RedirectResponse
    {
        $resource->update($request->input());

        return back()->with('message-success', 'Ресурс изменён');
    }

    public function markAsRead(Resource $resource): RedirectResponse
    {
        $currentUser = Auth::user();

        $currentUser->resources()->attach($resource->id);

        return back()->with('message-success', 'Ресурс отмечен как прочитанный');
    }
}
