@extends("layout")
@section("content")
<div id="main">

  @foreach($posts as $post)
  <div class="card-body">
    <h5 class="card-title">タイトル:{{ $post->title }}</h5>
    <p class="card-text">内容:{{ $post->body }}</p>
    <p class="card-text">ユーザー:{{ $post->user->user_id }}</p>
    <a href="{{ route("posts.show", $post->id) }}" class="btn btn-primary">詳細へ</h5></a>
  </div>
  @endforeach

</div>

@endsection