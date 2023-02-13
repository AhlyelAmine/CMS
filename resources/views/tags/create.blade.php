<div class="container justify-content-center py-5">
    <div>
        <h3>Add new categorie</h3>
        <form method="POST" action="{{ route('tags.store') }}">
            @csrf
            <div class="form-group">
                <label>Tag name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
            </div>
    
            <x-errors></x-errors>
            <div class="py-3">
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </div>
        
        </form>
    </div>
    <div>
        <h3>Add child to categorie</h3>
        <form method="POST" action="{{ route('tags.store') }}">
            @csrf

            <select name="parent" class="form-select" aria-label="Default select example">
                <option selected>Parent Tags</option>
                @foreach ($tags as $tag)
                <option value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label>Tag name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"/>
            </div>
    
            <x-errors></x-errors>
            <div class="py-3">
                <button type="submit" class="btn btn-primary btn-block">Ajouter</button>
            </div>
        
        </form>
    </div>
    
</div>