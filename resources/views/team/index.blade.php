<x-app-layout>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Abbreviation</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
            @foreach($teams as $team)
            <tr>
                <td>{{ $team->fullName() }}</td>
                <td>{{ $team->abbreviation }}</td>
                <td>{{-- button --}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-app-layout>
