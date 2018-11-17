
<div class="table-responsive">
    <div class="d-flex justify-content-center"><a href="/" class="btn btn-primary" href="#" role="button"> Создать Запрос</a></div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Запрос</th>
            <th scope="col">Статус</th>
            <th scope="col">Дата</th>
            <th scope="col">Модель</th>
            <th scope="col">Трейд-ин</th>
            <th scope="col">Наличка</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params['orders'] as $order) :?>
            <?php if($order['status_id'] != 2){
                $order['sum1'] = '';
                $order['sum2'] = '';
                $style = 'orange';
            }else{
                $style = 'green';
            } ?>
        <tr>
            <th scope="row"><a href="/manager/open/<?=$order['id']?>"><?=$order['id']?></a></th>
            <td class="<?=$style?>" ><?=$order['status']?></td>
            <td><?=$this->date_format($order['date']);?></td>
            <td><?=$order['item']?></td>
            <td><?=$order['sum1']?></td>
            <td><?=$order['sum2']?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="paginator d-flex justify-content-center">
    <nav aria-label="...">
        <ul class="pagination pagination-lg">
            <?php if($params['links']) :?>
                <?php foreach($params['links'] as $link) :?>
                    <?php if(isset($_GET['page']) and $_GET['page'] == $link) :?>
                        <li class="page-item disabled">
                            <a class="page-link" href="?page=<?=$link?>"><?=$link?></a>
                        </li>
                    <?php else :?>
                        <li class="page-item"><a class="page-link" href="?page=<?=$link?>"><?=$link?></a></li>
                    <?php endif; ?>


                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </nav>
</div>