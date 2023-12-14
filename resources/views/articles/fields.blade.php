<input type="text" name="title" value="{{ $article->title }}">
@error('title')
  <div class="alert alert-danger">{{ $message }}</div>
@enderror
<textarea name="body">
    {{ $article->body }}
</textarea>
@error('body')
  <div class="alert alert-danger">{{ $message }}</div>
@enderror
