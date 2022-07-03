<form action="<?= BASE_URL . 'mon-hoc/luu-cap-nhat?id=' . $model->id ?>" method="post">
    <div>
        <label for="">Tên danh mục</label>
        <input type="text" name="name" 
            value="<?= $model->name ?>">
    </div>
    <div>
        <button type="submit">Lưu</button>
    </div>
</form>