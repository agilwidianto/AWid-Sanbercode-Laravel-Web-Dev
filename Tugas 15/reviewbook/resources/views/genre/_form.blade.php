@csrf
<div class="mb-3">
  <label class="form-label">Nama Genre</label>
  <input type="text" name="name" class="form-control" value="{{ old('name', $genre->name ?? '') }}" required>
  @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<div class="mb-3">
  <label class="form-label">Deskripsi</label>
  <textarea name="description" rows="3" class="form-control">{{ old('description', $genre->description ?? '') }}</textarea>
  @error('description')<div class="text-danger small">{{ $message }}</div>@enderror
</div>
<button class="btn btn-success">Simpan</button>
<a href="{{ route('genre.index') }}" class="btn btn-secondary">Batal</a>
