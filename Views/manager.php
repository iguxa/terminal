<div class="d-flex justify-content-center">
    <div class="d-flex flex-column w-75">
        <form action="/manager/update_form" method="post" enctype="multipart/form-data">
            <div class="custom text-center"> <p>Запрос <?php echo $params['order']['id'] ?? '' ?> </p></div>
            <!--<div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>-->
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите категорию</label>
                <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" disabled name = 'categories_id'>
                    <?php if(isset($params['categories'])) :?>
                            <?php if(isset($params['order'])) :?>
                                    <?php foreach ($params['categories'] as $categories):?>
                                            <?php if($categories['id'] == $params['order']['categories_id']):?>
                                            <option  selected value="<?=$categories['id']?>"><?=$categories['categories']?></option>
                                            <?php  break; endif;?>
                                    <?php endforeach;?>
                            <?php endif; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наименование</label>
                    <?php if(isset($params['order'])) :?>
                            <input readonly type="text" value="<?=$params['order']['item']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наименование" name = 'item'>

                    <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Описания состояния</label>
                <?php if(isset($params['order']['description'])) :?>
                    <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="3" placeholder="Описания состояния" name='description'><?=$params['order']['description']?></textarea>

                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Запрос скидки</label>
                <?php if(isset($params['order']['discount'])) :?>
                    <input type="number" readonly value="<?=$params['order']['discount']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='discount'>

                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Загрузить фото</label>

                <?php if(isset($params['order']['images_id'])) :?>
                    <input type="hidden" value="<?=$params['order']['images_id']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='images_id'>
                   <div class="custom_img">
                    <?php foreach ($params['orders_images'] as $orders_images) :?>
                        <img class="mw-100" src="/uploads/<?=$orders_images['images']?>" alt="">
                    <?php endforeach ?>
                   </div>
                <?php endif; ?>


            </div>
            <div class="custom text-center"> <p> Ответ </p></div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Выберите статус</label>
                <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" disabled name = 'status_id'>
                    <?php if(isset($params['order'])) :?>
                        <?php foreach ($params['option_status'] as $status):?>
                            <?php if($status['id'] == $params['order']['status_id']):?>
                                <option readonly selected value="<?=$status['id']?>"><?=$status['status']?></option>
                            <?php endif;?>
                        <?php endforeach;?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Трейд-ин</label>
                <?php if(isset($params['order']['sum1'])) :?>
                    <input type="number" disabled value="<?=$params['order']['sum1']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='sum1'>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <?php if(isset($params['order']['sum2'])) :?>
                    <input type="number" disabled value="<?=$params['order']['sum2']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='sum2'>
                <?php endif; ?>
            </div>


            <div class="form-group">
                <p>Комментарий</p>
                <textarea class="form-control" disabled  id="exampleFormControlTextarea1" rows="3" placeholder="Комментарий" name='admin_comment'><?php if(isset($params['order']['admin_comment'])) :?><?=$params['order']['admin_comment']?><?php endif; ?></textarea>

            </div>
            <div class="custom text-center"> <p> Проверка </p></div>
            <div class="test_desc">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Запрос на проверку</label>

                        <?php if(isset($params['order']['need_check']) and $params['order']['need_check']) :?>
                            <input readonly value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Да" name='check'>
                        <?php else: ?>
                            <input readonly value="" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Нет" name='check'>
                        <?php endif; ?>

                </div>
            </div>
            <div class="test_desc">
                <div class="snippet">
                    <p>Результат проверки товара </p>
                    <p>(неверная информация приводит к штрафу)</p>
                    <div class="form-group">
                        <?php if(isset($params['order']['manager_result_test']) and $params['order']['manager_result_test']) :?>
                            <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="3" placeholder="Результат проверки" name='manager_result_test'><?=$params['order']['manager_result_test']?></textarea>
                        <?php else: ?>
                            <textarea class="form-control"  id="exampleFormControlTextarea1" rows="3" placeholder="Результат проверки" name='manager_result_test'></textarea>
                        <?php endif; ?>
                    </div>
                    <p>Комментарий</p>
                    <div class="form-group">
                        <?php if(isset($params['order']['manager_comment']) and $params['order']['manager_comment']) :?>
                            <textarea class="form-control" readonly id="exampleFormControlTextarea1" rows="3" placeholder="Результат проверки" name='manager_comment'><?=$params['order']['manager_comment']?></textarea>
                        <?php else: ?>
                            <textarea class="form-control"  id="exampleFormControlTextarea1" rows="3" placeholder="Результат проверки" name='manager_comment'></textarea>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="responsible">
                    <p>Ответсвенный: <span>Иванов ИИ (анна тип)</span></p>
                </div>

            </div>
            <div class="custom text-center"> <p>Результат</p></div>

            <div class="form-group">
                <label for="exampleInputEmail1">Трейд-ин</label>
                <?php if(isset($params['order']['sum1'])) :?>
                    <input type="number" disabled value="<?=$params['order']['sum1']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='sum1'>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <?php if(isset($params['order']['sum2'])) :?>
                    <input type="number" disabled value="<?=$params['order']['sum2']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Запрос скидки" name='sum2'>
                <?php endif; ?>
            </div>


            <input type="text" name="bot_check" class="d-none" value="">
                <input type="hidden" name="users_id" value="2"><!--отсылаем на админа-->
                <input type="hidden" name="orders_id" value=" <?php echo $params['order']['id'] ?? '' ?>">


            <input type="submit" class="btn btn-success waves-effect">
        </form>
    </div>
</div>