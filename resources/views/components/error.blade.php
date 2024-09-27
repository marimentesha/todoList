@props(['name'])

@error($name)
    <p {{$attributes->merge(['style'=>"color: darkred; font-size: 16px"])}}>{{$message}}</p>
@enderror
