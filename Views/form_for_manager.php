<?php
$test = 1;
?>
<div class="d-flex justify-content-center">
<div class="d-flex flex-column w-75">
    <form action="/image" method="post" enctype="multipart/form-data">
        <div class="custom text-center"> <p>Запрос <?=$params['order']['id']?></p></div>
        <!--<div class="form-group">
            <label for="exampleFormControlInput1">Email address</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>-->
        <div class="form-group">
            <div class="status">Категория: <span><?=$params['order']['categories']?></span></div>
        </div>
        <div class="form-group">
            <div class="status">Продукт: <span><?=$params['order']['item']?></span></div>

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
            <div class="status">Состояние: <span><?=$params['order']['description']?></span></div>
        </div>
        <div class="form-group">
            <div class="status">Скидка: <span><?=$params['order']['discount']?></span></div>
        </div>
        <div class="form-group">
            <div class="status">Трейд-ин: <span><?=$params['order']['sum1']?></span></div>
        </div>
        <div class="form-group">
            <div class="status">Наличка: <span><?=$params['order']['sum2']?></span></div>
        </div>
            <?php if($params['orders_images']):?>
            <?php foreach ($params['orders_images'] as $image):?>
                <div class="img">
                    <img class="mw-100" src="/uploads/<?=$image['images']?>" alt="">
                </div>
            <?php endforeach;?>
            <?php endif ?>
        <input type="text" name="bot_check" class="d-none" value="">
        <div class="custom text-center"> <p>Ответ менеджера</p></div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Выберите статус</label>
            <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" name = 'status'>
                <?php foreach ($params['option_status'] as $option_status ):?>
                <option value="<?=$categories['id']?>"><?=$categories['categories']?></optionname>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="custom_litle">
            <div class="status">Статус: <span><?=$params['order']['status']?></span></div>
            <div class="status_info">Трейд-ин: <span>0</span></div>
            <div class="status_info">Наличка: <span>0</span></div>
            <div class="status">Комментарий</div>
            <div class="comment">Хз</div>
        </div>
        <div class="custom text-center"> <p>Проверка</p></div>
        <div class="custom_litle">
            <div class="status">Запрос на проверку </div>
            <div class="check">Нет</div>
            <div class="status_info">Результат проверки товара (неверная информация приводит к штрафу)</div>
            <div class="info">
                какая то проверка
            </div>
            <div class="status_info">Комментарий</div>
            <div class="info">
                какая то проверка
            </div>
            <div class="bad">
                <div class="status">Ответственный: <span>Дмитрий Иванов</span></div>
            </div>
        </div>
        <div class="custom text-center">Результат </div>
        <div class="status_info">Трейд-ин: <span>0</span></div>
        <div class="status_info">Наличка: <span>0</span></div>

        <input type="submit" class="btn btn-success waves-effect">
    </form>
</div>
</div>