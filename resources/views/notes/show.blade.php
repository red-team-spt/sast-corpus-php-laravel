<x-layout>
    <h1>{{ $note->title }}</h1>
    <div class="body">{{ $note->body }}</div>
    <p>Owner: {{ $note->owner->name }}</p>
</x-layout>
