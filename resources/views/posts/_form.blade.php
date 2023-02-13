<div class="form-group py-2">
    <label>Title</label>
    <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
        value="{{ old('title', $post->title ?? null) }}"/>
</div>

<div class="form-group py-2">
    <label>Content</label>
    <input type="text" name="content" class="form-control  @error('content') is-invalid @enderror"
        value="{{ old('content', $post->content ?? null) }}"/>
</div>
<div class="form-group py-2">
    <label>Youtube url</label>
    <input type="text" name="youtube" class="form-control  @error('youtube') is-invalid @enderror"
        value="{{ old('youtube', $post->youtube ?? null) }}"/>
    <span class="text-muted">Like : https://www.youtube.com/watch?v=<span class="text-dark h5">MAfbqODXTzM</span></span>
</div>

<div class="form-group py-4">
    <label for="picture">Picture</label>
    <input type="file" name="picture" id="picture" class="form-control">
</div>
    
<x-errors></x-errors>