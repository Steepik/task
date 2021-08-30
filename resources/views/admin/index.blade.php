@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Описание</th>
            <th scope="col">Автор</th>
            <th scope="col">Url</th>
            <th scope="col">Картинка</th>
            <th scope="col">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($records as $record)
        <tr>
            <th scope="row">{{ $record->id }}</th>
            <td>{{ $record->title }}</td>
            <td>{{ $record->short_description }}</td>
            <td>{{ $record->author ?? 'Не указан' }}</td>
            <td>{{ $record->url }}</td>
            <td> @if($record->image) <img src="{{ $record->image }}" width="100"> @else Нет @endif</td>
            <td>
                <form action="{{ route('records.destroy', $record->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mt-2 mb-5 d-flex justify-content-center align-items-center">
        <div class="pagination">{{ $records->render() }}</div>
    </div>
@endsection