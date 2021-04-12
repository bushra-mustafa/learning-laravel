@extends('teacherindex.layout')

@section('content')


    <table class="table table-striped container">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($teacher as $item)
                <tr>
                    <th scope="row">{{ ++$i }}</th>
                    <td>{{ $item->neme }}</td>
                    <td>{{ $item->password }}</td>
                    <td>
                        {{-- <a href="{{ route('teachers.edit') }}"></a> --}}


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



@endsection
