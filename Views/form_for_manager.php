<div class="d-flex justify-content-center">
<div class="d-flex flex-column w-75">
    <form action="<?=$params['form_action']?>" method="post" enctype="multipart/form-data">
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
        <input type="hidden" name="orders_id" class="d-none" value="<?=$params['order']['id']?>">
        <div class="custom text-center"> <p>Ответ менеджера</p></div>
        <div class="status">Статус: <span><?=$params['order']['status']?></span></div>
        <?php foreach ($params['users'] as $users ):?>
            <?php if($users['position'] == 'Консультант' and $params['order']['users_id'] == $users['id']):?>
                <div class="status">В работе у: <span><?=$users['users']?></span></div>
            <?php elseif($users['position'] == 'Менеджер' and $params['order']['users_id'] == $users['id']) :?>
                <div class="status">В работе у: <span><?=$users['users']?></span></div>
            <?php endif; ?>
        <?php endforeach; ?>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Выберите статус</label>
            <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" name = 'status_id'>
                <?php foreach ($params['option_status'] as $option_status ):?>
                    <?php if($option_status['id'] == $params['order']['status_id'])  :?>
                        <option selected value="<?=$option_status['id']?>"><?=$option_status['status']?></option>
                    <?php else :?>
                        <option value="<?=$option_status['id']?>"><?=$option_status['status']?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Перевести</label>
            <select class="form-control" id="exampleFormControlSelect1" data-categorie="categories" name = 'users_id'>
                <?php foreach ($params['users'] as $users ):?>
                    <?php if($users['id'] == $params['order']['users_id'])  :?>
                        <option selected value="<?=$users['id']?>"><?=$users['users']?> - <?= $users['position']?></option>
                    <?php else :?>
                        <option value="<?=$users['id']?>"><?=$users['users']?> - <?= $users['position']?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="custom_litle">
            <div class="form-group">
                <label for="exampleInputEmail1">Трейд-ин</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Трейд-ин" name='sum1'>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наличка" name='sum2'>
            </div>
            <div class="container">
                <div class="row">
                    <div class="d-flex flex-column w-100 ">
                        <div class="page-header">
                            <h1><small class="pull-right"><?= count($params['chats']) ?></small> Сообщений </h1>
                        </div>
                        <div class="comments-list">
                            <?php if($params['chats']) :?>
                            <?php foreach($params['chats'] as $chat ) :?>
                            <div class="media">
                                <div class="credits d-flex flex-column">
                                    <h4 class="media-heading user_name"><?=$chat['position']?></h4>
                                    <p><small><?=$chat['users']?></small></p>
                                    <p class="pull-right"><small><?=$this->date_format($chat['date']);?></small></p>
                                </div>
                                <div class="media-body">
                                    <?=$chat['messages']?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">

                <label for="exampleFormControlTextarea1">Комментарий</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Комментарий" name='messages'></textarea>
            </div>
        </div>




        <input type="submit" class="btn btn-success waves-effect">
    </form>
</div>
</div>