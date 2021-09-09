@extends('books.template')

@section('title','Visualizar Livros')

@section('content')
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('warning'))
    <div class="alert alert-warning">
        <ul>
            <li>{!! \Session::get('warning') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif
<button type="button" class="btn btn-success btn-icon btn-sm" title='Adicionar' onclick='location.href="{{ route('books.create')}}"'>
  Adicionar
  <i class="fa fa-pen"></i>
</button>
<br>
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nome</th>
        <th scope="col">Categoria</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($books->items() as $book)
        <tr>
          <th scope="row">{{$book->id}}</th>
          <td>{{$book->name}}</td>
          <td>{{$book->category->name}}</td>
          <td>
            <button type="button" class="btn btn-info btn-icon btn-sm" title='Editar' onclick='location.href="{{ route('books.edit', $book)}}"'>
              Editar
              <i class="fa fa-pen"></i>
            </button>
            <br>
            <form action="{{route('books.destroy',[$book->id])}}" method="POST">
              @method('DELETE')
              @csrf
              <button  type="submit" class="btn btn-danger btn-icon btn-sm" title='Deletar'>
                Deletar
                <i class="fa fa-pen"></i>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{$books->links()}}
@endsection