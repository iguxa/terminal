
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Заказ</th>
            <th scope="col">Статус</th>
            <th scope="col">Дата</th>
            <th scope="col">Модель</th>
            <th scope="col">Показ.1</th>
            <th scope="col">Показ.2</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($params as $order) :?>
        <tr>
            <th scope="row"><a href="/admin/open/<?=$order['id']?>"><?=$order['id']?></a></th>
            <td><?=$order['status']?></td>
            <td><?=$this->date_format($order['date']);?></td>
            <td><?=$order['item']?></td>
            <td><?=$order['sum1']?></td>
            <td><?=$order['sum1']?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>