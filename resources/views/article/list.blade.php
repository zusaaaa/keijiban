@extends("layout")
@section("content")
<div id="main">
<form action="" method="GET">
  @foreach($articles as $article)
    <div id="article_title"><a href="/article/{{ $article->id }}">{{ $article->title}}</a></div>
  @endforeach
</form>
</div>
@endsection