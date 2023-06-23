<h1 style="margin: 10px 0px;">{{ $data['title'] }}</h1>

<p style="margin: 7px 0px;">{{ $data["excerpt"] }}</p>
<a style="margin: 7px 0px;" href="{{ route('post.single-post', [$data['slug'], $category]) }}">View More</a>