@php use Illuminate\Support\Facades\Auth; @endphp
@props(['uri', 'name', 'second', 'third'])
<div>
    <x-vertical-dots/>
    <x-vertical-dots/>

    <h1 style="background-color: {{$color}}; color: {{$textColor}};">{{str_replace('/', ' ', $uri)}}</h1>
    <x-horizontal-dots/>

    @if (!request()->is($uri))
        <div>
            <a href="/{{$uri}}"> + create </a>
        </div>
    @endif

    @if (request()->is($uri))
        <div>
            <form method="post">
                @csrf
                <input type="text" name="{{$name}}" style="float: left;width:400px">
                <x-hidden-input name="type" value="{{$name}}"/>
                <button type="submit" style="float:right; margin-top:9px; margin-right:5px">Add</button>
            </form>
        </div>
    @endif

    @if(session($name))
        @foreach (session($name) as $item)
            @if(is_array($item) && isset($item['data'], $item['id'], $item['user_id'], $item['session_id']) && Auth::id() === $item['user_id'])
                @if (!request()->is("edit/" . $item["id"]))

                    <div>
                        <p style="margin-left:10px; border-style: solid; border-color: lightgray;"> {{ $item['data'] }} </p>
                        <a href="/edit/{{$item['id'] }}" class="button right">Edit</a>

                        <form method="post" action="/destroy" class="right">
                            @csrf
                            @method('DELETE')
                            <x-hidden-input name="session_id" value="{{$item['session_id']}}"/>
                            <button type="submit">Delete</button>
                        </form>

                        <form method="post" action="/move/{{$item['id'] }}" onsubmit="return false;">
                            @csrf
                            <select name="newType" onchange="this.form.submit()"
                                    style="float:left;margin:5px 10px;color:{{$textColor}}; background-color:{{$color}}">
                                <option value="{{$name}}" selected disabled
                                        style="background-color:white">{{$name}} </option>
                                <option value="{{$second}}" style="background-color:white">{{$second}}</option>
                                <option value="{{$third}}" style="background-color:white">{{$third}}</option>
                            </select>
                            <x-hidden-input name="session_id" value="{{$item['session_id']}}"/>
                            <x-hidden-input name="data" value="{{$item['data']}}"/>
                            <x-hidden-input name="type" value="{{$name}}"/>
                        </form>

                    </div>
                @endif

                @if (request()->is("edit/" . $item["id"]) )
                    <div>
                        @if ($item['id'] == request()->id)

                            <form action="/update/{{$item['id'] }}" method="post">
                                @csrf
                                @method('PATCH')
                                <input type="text" name="data" value="{{$item['data'] }}"
                                       style="float:left;width:410px">
                                <x-hidden-input name="type" value="{{$name}}"/>
                                <x-hidden-input name="session_id" value="{{$item['session_id']}}"/>

                                <button type="submit"
                                        style="float:right;margin-top:11px; margin-right:4px;padding:0 5px; font-size: 17px">
                                    Edit
                                </button>
                            </form>

                        @else
                            <p style="margin-left:10px; border-style: solid; border-color: lightgray;"> {{ $item['data'] }} </p>
                        @endif

                    </div>
                @endif
            @endif
        @endforeach
    @endif
</div>
