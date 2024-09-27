<x-layout>
    <x-slot:background>
    </x-slot:background>

    <x-list-item-layout uri="to/do" name="todo" second="progress" third="done">
        <x-slot:color>lightgray</x-slot:color>
        <x-slot:textColor>dimgray</x-slot:textColor>
    </x-list-item-layout>

    <x-list-item-layout uri="in/progress" name="progress" second="todo" third="done">
        <x-slot:color>lightskyblue</x-slot:color>
        <x-slot:textColor>midnightblue</x-slot:textColor>
    </x-list-item-layout>

    <x-list-item-layout uri="done" name="done" second="todo" third="progress">
        <x-slot:color>lightgreen</x-slot:color>
        <x-slot:textColor>darkolivegreen</x-slot:textColor>
    </x-list-item-layout>

</x-layout>
