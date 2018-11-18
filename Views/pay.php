<div class="d-flex justify-content-center">
    <div class="d-flex flex-column w-75">
        <form action="/pay_form" method="post" enctype="multipart/form-data">
            <div class="custom text-center"> <p>Запросить платеж</p></div>
            <!--<div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>-->

            <div class="form-group">
                <label for="exampleInputEmail1"></label>
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
                <label for="exampleFormControlTextarea1"></label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Описания состояния" name='description'></textarea>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Наличка</label>
                <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Наличка" name='discount'>
            </div>
            <input type="text" name="bot_check" class="d-none" value="">
            <div class="custom text-center"> <p>Результат</p></div>
            <div class="form-group">
                <label for="exampleInputEmail1">Трейд-ин</label>
                <?php if(isset($params['order']['sum2']) and $params['order']['sum2']) :?>
                        <input type="number" disabled readonly value="<?=$params['order']['sum2']?>" class="green form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Результат" name=''>
                    <?php else : ?>
                        <input type="number" disabled value="0" class="red form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Результат" name=''>
                <?php endif; ?>
            </div>
            <input type="hidden" name="users_id" value="2">
            <input type="hidden" name="type_link" value="pay_open">
            <input type="hidden" name="categories_id" value="3">
            <input type="submit" class="btn btn-success waves-effect">
        </form>

    </div>
</div>