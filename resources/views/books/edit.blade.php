@extends('books.template')

@section('title','Visualizar Livros')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method='POST' action="{{route('books.update',$bookResource->id)}}" method="POST">
  @method('PUT')
  @csrf
  <div class="form-group">
    <label for="name">Nome do Livro</label>
    <input type="text" class="form-control" value="{{old('name',$bookResource->name)}}" id="name" name="name" placeholder="Adicione o nome do Livro." required="required">
    <small id="nameHelp" class="form-text text-muted">Nome do Livro a ser cadastrado.</small>
  </div>
  <div class="form-group">
    <label for="sinopse">Sinopse do Filme</label>
    <textarea type="text" class="form-control" id="sinopse" name="sinopse" placeholder="Adcionar a Sinopse do Filme." required="required">{{old('sinopse',$bookResource->sinopse)}}</textarea>
  </div>
  <label for="sinopse">Categoria do Filme</label>
  <select class="form-control" id='category_id' name="category_id">
    @foreach($categoriesResource as $category)
      <option value="{{$category->id}}" @if($bookResource->category_id == $category->id) selected="selected" @endif>{{$category->name}}</option>
    @endforeach
  </select>
  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
@push('scripts')
<script>
</script>
@endpush
