<x-layout>
    <h1>My notes</h1>
    @foreach ($notes as $note)
        <p><a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a></p>
    @endforeach
    {{ $notes->links() }}
</x-layout>
