<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ListSessions;
use Illuminate\Contracts\View\{Factory, View};
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class HomeController
{

    public function index(): View|Factory|Application
    {
        $todoItems = [
            'todo',
            'progress',
            'done',
        ];

        foreach ($todoItems as $todoItem) {

            request()->session()->forget($todoItem);
            $todos[$todoItem] = [];

            foreach (ListSessions::all() as $value) {

                $unserializedItems = unserialize($value['data']);

                foreach ($unserializedItems as $key => $item) {

                    $todos[$key][] = [
                        'session_id' => $value->id,
                        'id' => $item['id'],
                        'data' => $item['data'],
                        'user_id' => $value->user_id,
                    ];
                }
            }

            request()->session()->put($todoItem, $todos[$todoItem]);

            $items[$todoItem] = session($todoItem);
        }

        return view('index', $items);
    }


    public function store(): Application|Redirector|RedirectResponse
    {
        $type = request('type');
        $session = request()->session();
        $session->get($type, []);

        request()->validate([
            $type => 'required'
        ]);

        $session->put($type, [
            'id' => uniqid(),
            'data' => request()->{$type},
            'user_id' => Auth::getUser()->getAuthIdentifier(),
        ]);

        $serializedItems = serialize([$type => session($type)]);

        (new ListSessions)->create([
            'id' => session()->getId(),
            'data' => $serializedItems,
            'user_id' => Auth::getUser()->getAuthIdentifier()
        ]);

        $session->regenerate();
        return redirect('/');

    }

    public function move($id): Application|Redirector|RedirectResponse
    {
        $type = request('type');
        $newType = request()->input('newType');
        $session = (new ListSessions())->findOrFail(request()->input('session_id'));
        $data = [];

        foreach (session($type) as $value) {
            if ($value['id'] === $id) {
                $data[$newType] = [
                    'id' => $id,
                    'data' => $value['data'],
                ];
            }
        }

        $data = serialize($data);

        $session->update([
            'data' => $data,
        ]);

        session()->regenerate();
        return redirect('/');
    }

    public function update($id): Application|Redirector|RedirectResponse
    {
        $session = (new ListSessions())->findOrFail(request()->input('session_id'));
        $type = request('type');

        request()->validate([
            'data' => 'required'
        ]);

        $data = [
            $type => [
                'id' => $id,
                'data' => request()->input('data'),
            ]
        ];

        $data = serialize($data);

        $session->update([
            'data' => $data,
        ]);

        session()->regenerate();
        return redirect('/');
    }

    public function destroy(): Application|Redirector|RedirectResponse
    {
        $session = (new ListSessions())->findOrFail(request()->input('session_id'));

        $session->delete();
        return redirect('/');
    }
}
