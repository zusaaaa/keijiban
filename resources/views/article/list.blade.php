@extends("layout")
@section("content")
<div id="main">
<form action="" method="GET">
  @foreach($posts as $post)
  <div class="card-body">
    <h5 class="card-title">タイトル:{{ $post->title }}</h5>
    <a href="#" class="btn btn-primary">詳細へ</a>
  </div>
    <div  id="article_title"><a href="/article/{{ $post->id }}">{{ $post->title}}</a></div>
  @endforeach
</form>
</div>
@endsection