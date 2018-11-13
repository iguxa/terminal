<div class="d-flex justify-content-center">
<div class="d-flex flex-column w-75">
    <form action="/image" method="post" enctype="multipart/form-data">
        <div class="custom text-center"> <p>Запрос</p></div>
        <!--<div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>-->
        <div class="form-group">
            <label for="exampleFormControlSelect1">Выберите категорию</label>
            <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" name = 'categories_id'>
                <?php foreach ($params['categories'] as $categories ):?>
                    <option value="<?=$categories['id']?>"><?=$categories['categories']?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Наименование</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наименование" name = 'item'>

        </div>
        <!--<div class="form-group">
            <label for="exampleFormControlSelect2">Example multiple select</label>
            <select multiple class="form-control" id="exampleFormControlSelect2">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
            </select>
        </div>-->
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Описания состояния</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Описания состояния" name='description'></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Запрос скидки</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='discount'>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Показ.1</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Показ.1" name='sum1'>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Показ.2</label>
            <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Показ.2" name='sum2'>
        </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузить фото</label>
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="array[]" multiple accept="image/*,image/jpeg">
            </div>
        <input type="text" name="bot_check" class="d-none" value="">
        <div class="custom text-center"> <p>Поддержка</p></div>
        <div class="custom_litle">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите статус</label>
                <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" required name = 'status_id'>
                    <option></option>
                    <?php foreach ($params['status'] as $option_status ):?>
                        <option value="<?=$option_status['id']?>"><?=$option_status['status']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Перевести</label>
                <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" required name = 'users_id'>
                    <option></option>
                    <?php foreach ($params['users'] as $users ):?>
                        <option value="<?=$users['id']?>"><?=$users['users']?> - <?= $users['position']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>


        <input type="submit" class="btn btn-success waves-effect">
    </form>
</div>
</div>