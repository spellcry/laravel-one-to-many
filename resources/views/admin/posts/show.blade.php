@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->slug }}</p>
                <ul class="list-group flex-row mb-3">
                    <li class="list-group-item rounded mr-4">
                        Created at: {{ $post->created_at }}
                    </li>
                    <li class="list-group-item border-top rounded">
                        Updated at: {{ $post->updated_at }}
                    </li>
                </ul>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">            
                <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-primary btn-sm mr-3">Modifica</a>
                <form action="{{ route('admin.posts.destroy', $post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Elimina" class="btn btn-danger btn-sm">
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12">
                {!! $post->content !!}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">                
                <h5>Categoria: {{ $post->category ? $post->category->name : 'Nessuna categoria' }}</h5>
            </div>
        </div>
        @if ( isset($post->category->posts) )
            <div class="row">
                <div class="col-12">                
                    <h5 class="mb-3">Altri post della stessa categoria</h5>
                    <ul>
                        @foreach ($post->category->posts as $postSameCategory)
                            @if ($postSameCategory->slug != $post->slug)
                                <li>                                
                                    <a href="{{ route('admin.posts.show', $postSameCategory) }}">{{ $postSameCategory->title }}</a>
                                </li>                                
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>            
        @endif
    </div>
@endsection