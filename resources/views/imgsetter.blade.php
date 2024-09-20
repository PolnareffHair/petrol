<form action="/upload-image" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image">
    <button type="submit">Загрузить изображение</button>
</form>