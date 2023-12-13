@extends('dashBoard.dashboard')

@section('container')
<h2>Tambah Berita</h2>

<div class="col-lg-8">
    <form method="post" action="#">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                {{-- @foreach ($categories as $category) --}}
                    <option value="_">i</option>
                {{-- @endforeach --}}
            </select>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <input id="x" type="hidden" name="content">
            <trix-editor input="x"></trix-editor>
        </div>
        <button type="submit" class="btn btn-primary">Buat Berita</button>
    </form>
</div>



@endsection