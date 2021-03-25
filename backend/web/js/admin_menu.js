$(document).ready(function() {

  //=======================
  // обнуление данных
  //=======================

  $('#dedicated-car').on('click', function() {
    update_count('/admin/dedicated-car/clickmenu');
  });
//=======================
  $('#dedicated-truck').on('click', function() {
    update_count('/admin/dedicated-truck/clickmenu');
  });
//=======================
$('#general-one-place').on('click', function() {
  update_count('/admin/general-one-place/clickmenu');
});
//=======================
$('#general-many-places').on('click', function() {
  update_count('/admin/general-many-places/clickmenu');
});
//=======================
$('#general-letter').on('click', function() {
  update_count('/admin/general-letter/clickmenu');
});
//=======================
$('#document-request').on('click', function() {
  update_count('/admin/document-request/clickmenu');
});
//=======================
$('#feedback-request').on('click', function() {
  update_count('/admin/feedback-request/clickmenu');
});
//=======================
$('#documents').on('click', function() {
  update_count('/admin/documents/clickmenu');
});
//=======================
$('#user').on('click', function() {
  update_count('/admin/user/clickmenu');
});

//=======================
// проверка новых данных
//=======================

new_count('/admin/dedicated-car/counter', '#dedicated-car img');
new_count('/admin/dedicated-truck/counter', '#dedicated-truck img');
new_count('/admin/general-one-place/counter', '#general-one-place img');
new_count('/admin/general-many-places/counter', '#general-many-places img');
new_count('/admin/general-letter/counter', '#general-letter img');
new_count('/admin/document-request/counter', '#document-request img');
new_count('/admin/feedback-request/counter', '#feedback-request img');
new_count('/admin/documents/counter', '#documents img');
new_count('/admin/user/counter', '#user img');


var period = 30000;

setInterval(function(){

  new_count('/admin/dedicated-car/counter', '#dedicated-car img');
  new_count('/admin/dedicated-truck/counter', '#dedicated-truck img');
  new_count('/admin/general-one-place/counter', '#general-one-place img');
  new_count('/admin/general-many-places/counter', '#general-many-places img');
  new_count('/admin/general-letter/counter', '#general-letter img');
  new_count('/admin/document-request/counter', '#document-request img');
  new_count('/admin/feedback-request/counter', '#feedback-request img');
  new_count('/admin/documents/counter', '#documents img');
  new_count('/admin/user/counter', '#user img');



}, period);


function update_count(url){
  $.ajax({
               url: url,
               type: 'POST',
               data: '',
               success: function(res){
              //    console.log('новых '+res);
          //   alert(" количество " +res);
               },
               error: function(){
                  console.log('Error!');
               }
           });
}

function new_count(url, id_img){
  $.ajax({
             url: url,
             type: 'POST',
             data:'',
             success: function(res){
              if (res > 0) {
                $(id_img).css('display', 'block');

              }
              //console.log(url+ '   ' +res);
             },
             error: function(){
              console.log('Error!');
             }
         });
}

});
