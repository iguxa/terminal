console.log('im here');
var users_id = 2,arrays;
var fn=function(){
    var text = [],link = [];
    $.ajax({
        url: '/trigger123',
        data: {users_id: users_id},
        type: 'POST',
        dataType: 'html',
        success: function(data){
            console.log(data);
            arrays = JSON.parse(data);
            if(arrays){
                $(".ccc1").html(' Сюда приходят уведомления');

            }
            for(var i = 0;i<arrays.length;i++){
                if(arrays[i]['orders_id']){
                    soundClick();
                }
                if(text.indexOf(arrays[i]['orders_id']) == -1){
                    text.push(arrays[i]['orders_id']);
                    link.push("<a class='link' href='/manager/open/" + arrays[i]['orders_id'] +"'> Заказ " +arrays[i]['orders_id'] + "</a>");

                }
                $(".ccc1").html(link.join(' '));
            }
            console.log(arrays);

           //
        }
    });
    setTimeout(arguments.callee,2000);
};
setTimeout( fn,1000 );


function soundClick() {
    var audio = new Audio(); // Создаём новый элемент Audio
    audio.src = 'audio/audio.mp3'; // Указываем путь к звуку "клика"
    audio.autoplay = true; // Автоматически запускаем
}