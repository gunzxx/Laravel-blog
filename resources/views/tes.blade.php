{{ dd($article) }}
<form action="/add" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" id="image">
    <button style="display: block" type="submit">Kirim</button>
</form>