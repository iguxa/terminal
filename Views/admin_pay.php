<a class="btn btn-primary" href="/admin" role="button">Все запросы </a>
<div class="d-flex justify-content-center">
    <div class="d-flex flex-column w-75">
        <form action="/admin/pay_fill" method="post" enctype="multipart/form-data">
            <div class="custom text-center"> <p>Запросить платеж <?php echo $params['order']['id'] ?? '' ?></p></div>
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <?php if(isset($params['order']['item']) and $params['order']['item']) :?>
                    <input type="text" disabled readonly value="<?=$params['order']['item']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Результат" name=''>

                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1"></label>
                <?php if(isset($params['order']['description']) and $params['order']['description']) :?>
                    <textarea disabled class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Описания состояния" name='description'><?=$params['order']['description']?></textarea>

                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <?php if(isset($params['order']['discount']) and $params['order']['discount']) :?>
                    <input type="number" disabled readonly value="<?=$params['order']['discount']?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Результат" name=''>

                <?php endif; ?>
            </div>
            <input type="text" name="bot_check" class="d-none" value="">
            <div class="custom text-center"> <p>Результат</p></div>
            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <?php if(isset($params['order']['sum2'])) :?>
                    <input type="number" value="<?=$params['order']['sum2']?>" class=" form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Результат" name='sum2'>
                <?php endif; ?>
            </div>
            <input type="hidden" name="users_id" value="1">
            <input type="hidden" name="orders_id" value="<?=$params['order']['id']?>">
            <input type="hidden" name="status_id" value="2">
            <input type="hidden"  class="orders_id" name="orders_id" value=" <?php echo $params['order']['id'] ?? '' ?>">
            <input type="submit" class="btn btn-success waves-effect">
        </form>
        <?php if(isset($params['order']['status_id']) and $params['order']['status_id'] == 2):?>
            <a class="btn btn-primary btn-success trigger_delete" href="/admin" role="button">Отключить уведомления по заказу <?=$params['order']['id']?></a>
        <?php endif; ?>
    </div>
</div>