<div class="d-flex justify-content-center">
    <div class="d-flex flex-column w-75">
        <form action="/manager/form_fill" method="post" enctype="multipart/form-data">
            <div class="custom text-center"> <p>Запрос <?php echo $params['order']['id'] ?? '' ?> </p></div>
            <!--<div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>-->
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите категорию</label>
                <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" name = 'categories_id'>
                    <?php if(isset($params['categories'])) :?>
                            <?php if(isset($params['order'])) :?>
                                    <?php foreach ($params['categories'] as $categories):?>
                                            <?php if($categories['id'] == $params['order']['categories_id']):?>
                                            <option  selected value="<?=$categories['id']?>"><?=$categories['categories']?></option>
                                            <?php  break; endif;?>
                                    <?php endforeach;?>
                            <?php else :?>
                                   <?php foreach ($params['categories'] as $categories):?>
                                           <option value="<?=$categories['id']?>"><?=$categories['categories']?></option>
                                   <?php endforeach;?>
                            <?php endif; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наименование</label>
                    <?php if(isset($params['order'])) :?>
                            <input readonly type="text" value="<?=$params['order']['item']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наименование" name = 'item'>
                    <?php else: ?>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наименование" name = 'item'>
                    <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Описания состояния</label>
                <?php if(isset($params['order']['description'])) :?>
                    <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="3" placeholder="Описания состояния" name='description'><?=$params['order']['description']?></textarea>
                <?php else: ?>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Описания состояния" name='description'></textarea>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Запрос скидки</label>
                <?php if(isset($params['order']['discount'])) :?>
                    <input type="number" readonly value="<?=$params['order']['discount']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='discount'>
                <?php else: ?>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='discount'>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузить фото</label>

                <?php if(isset($params['order']['images_id'])) :?>
                    <input type="hidden" value="<?=$params['order']['images_id']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='images_id'>
                   <div class="custom_img">
                    <?php foreach ($params['orders_images'] as $orders_images) ?>
                        <img class="mw-100" src="/uploads/<?=$orders_images['images']?>" alt="">
                    <?php ?>
                   </div>
                <?php else: ?>
                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="array[]" multiple accept="image/*,image/jpeg">
                <?php endif; ?>


            </div>
            <div class="custom text-center"> <p> Ответ </p></div>
            <div class="form-group">
                <label for="exampleInputEmail1">Трейд-ин</label>
                <input type="number" class="form-control" readonly id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Трейд-ин" name='sum1'>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <input type="number" class="form-control" readonly  id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наличка" name='sum2'>
            </div>
            <div class="form-group">
                <p>Комментарий</p>
                <textarea class="form-control" readonly  id="exampleFormControlTextarea1" rows="3" placeholder="Комментарий" name='messages'></textarea>

            </div>
            <div class="custom text-center"> <p> Проверка </p></div>
            <div class="test_desc">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Запрос на проверку</label>
                    <select readonly  class="form-control" id="exampleFormControlSelect1" data-categorie="categories" name = 'check'>

                        <option value="0">Нет</option>
                        <option value="1">Да</option>
                    </select>
                </div>
            </div>
            <div class="test_desc">
                <div class="snippet">
                    <p>Результат проверки товара </p>
                    <p>(неверная информация приводит к штрафу)</p>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Результат проверки" name='manager_result_test'></textarea>
                    </div>
                    <p>Комментарий</p>
                    <div class="form-group">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Комментарий" name='manager_comment'></textarea>
                    </div>
                </div>
                <div class="responsible">
                    <p>Ответсвенный: <span>Иванов ИИ (анна тип)</span></p>
                </div>

            </div>
            <div class="custom text-center"> <p>Результат</p></div>

            <div class="form-group">
                <label for="exampleInputEmail1">Трейд-ин</label>
                <input type="number" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Трейд-ин" name='sum1'>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <input type="number" readonly class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наличка" name='sum2'>


            <input type="text" name="bot_check" class="d-none" value="">
            <input type="hidden" name="users_id" value="2">


            <input type="submit" class="btn btn-success waves-effect">
        </form>
    </div>
</div>