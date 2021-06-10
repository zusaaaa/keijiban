@extends("layout")
@section("content")
<div id="main">
  <div id="contents">
    <div id="title_box">
      <div id="title"><p>{{ $article->title }}</p></div>
      <div id="post_date">{{ $article->date }}</div>
    </div>
    <div id="box">
      {{ $article->content }}
    </div>
  </div>
</div>
@endsection