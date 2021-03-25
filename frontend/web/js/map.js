
$(document).ready(function () {
//  alert(rate);
//alert(constant);
ymaps.ready(init);

function init() {
    // Стоимость за километр.
    var DELIVERY_TARIFF = rate,
        CONSTANT = constant
    // Минимальная стоимость.
        MINIMUM_COST = minimum,
        myMap = new ymaps.Map('map', {
            center: [60.906882, 30.067233],
            zoom: 9,
            controls: []
        }),
    // Создадим панель маршрутизации.
        routePanelControl = new ymaps.control.RoutePanel({
            options: {
                // Добавим заголовок панели.
                showHeader: true,
                title: 'Расчёт доставки',
                visible:false
            }
        }),
        zoomControl = new ymaps.control.ZoomControl({
            options: {
                size: 'small',
                float: 'none',
                position: {
                    bottom: 145,
                    right: 10
                }
            }
        });
    // Пользователь сможет построить только автомобильный маршрут.
    routePanelControl.routePanel.options.set({
        types: {auto: true}
    });

    // Если вы хотите задать неизменяемую точку "откуда", раскомментируйте код ниже.
 routePanelControl.routePanel.state.set({
        fromEnabled: false,
        from: var_from
     });

     routePanelControl.routePanel.state.set({
           toEnabled: false,
           to: var_to
        });

    myMap.controls.add(routePanelControl).add(zoomControl);

    // Получим ссылку на маршрут.
    routePanelControl.routePanel.getRouteAsync().then(function (route) {

        // Зададим максимально допустимое число маршрутов, возвращаемых мультимаршрутизатором.
        route.model.setParams({results: 1}, true);

        // Повесим обработчик на событие построения маршрута.
        route.model.events.add('requestsuccess', function () {

            var activeRoute = route.getActiveRoute();
            if (activeRoute) {
                // Получим протяженность маршрута.
                var length = route.getActiveRoute().properties.get("distance"),
                // Вычислим стоимость доставки.
                    price = calculate(Math.round(length.value / 1000)),

                // Создадим макет содержимого балуна маршрута.
                    balloonContentLayout = ymaps.templateLayoutFactory.createClass(
                        '<span>Расстояние: ' + length.text + '.</span><br/>' +
                        '<span style="font-weight: bold; font-style: italic">Стоимость доставки: ' + price + ' р.</span>');



                // Зададим этот макет для содержимого балуна.
                route.options.set('routeBalloonContentLayout', balloonContentLayout);
                // Откроем балун.
               activeRoute.balloon.open();
                  $("#price-order-map").html('<h3 style="	color:#3b3865;font-size: 22px;font-family:  ProximaNovaExCnSemibold;">Расстояние - '+ length.text +'  </h3><h3 style="	color:#3b3865;font-size: 30px;font-family:  ProximaNovaExCnSemibold;">Расчетная стоимость доставки - '+ price +' рублей  </h3><p>*Окончательная стоимость доставки может отличаться.</p>');
            }
        });

    });
    // Функция, вычисляющая стоимость доставки.
    function calculate(routeLength) {

        CONSTANT =  Number.parseInt(CONSTANT);
    var calculated_price = Math.max(routeLength * DELIVERY_TARIFF + CONSTANT , MINIMUM_COST);

    $.ajax({
               url: '/order/updateprice',
               type: 'POST',
               data: {order:order, calculated_price:calculated_price, routeLength:routeLength },
               success: function(res){
                   console.log(res);
               },
               error: function(){
                   alert('Error!');
               }
           });
           
        return calculated_price;
    }




  //  $.ajax.db_connect('localhost', 'root', '', 'cn07832_gruz') ;
  //  $.ajax.db_query("UPDATE `t_order` SET  `route_length`= " + routeLength + ",`calculated_price`= " + calculated_price + " WHERE `order_id` = " + order);

}



});
