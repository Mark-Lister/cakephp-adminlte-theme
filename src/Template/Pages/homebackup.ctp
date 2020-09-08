<?php use Cake\Routing\Router; ?>
<?php echo $this->Html->script('AdminLTE./plugins/jQuery/jquery-2.2.3.min'); ?>
<?php echo $this->Html->script('bootstrap-notify-3.1.3/bootstrap-notify.min'); ?>
<style>
.lds-ring {
  display: block;
  position: absolute;
  left: 45%;
  top: 35%;
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 51px;
  height: 51px;
  margin: 6px;
  border: 6px solid #fff;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: #aaa transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
  </style>
<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->



        <div style="padding:15px">
          <a href="<?php echo $this->Url->build(array('controller' => 'Invoices', 'action' => 'generateBatch')); ?>"target="_self" class="btn btn-success" style="margin-right: 5px"><i class="fa fa-plus"></i>Generate Xero Batch</a>
          <!-- DIRECT CHAT -->
          <div class="box box-warning direct-chat direct-chat-warning ">
            <div class="box-header with-border">
              <h3 class="box-title" id='chatTitle'>Global</h3>

              <div class="box-tools pull-right" id='topBar'>
                
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>

                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle" id="contactsToggle">
                  <i class="fa fa-comments"></i></button>
                <!--button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button-->
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="lds-ring" id="loading"><div></div><div></div><div></div><div></div></div>
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" id="messages">
                
              

              </div>
              <!--/.direct-chat-messages-->



              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts">
                <ul class="contacts-list" id="contacts">
                  
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <form action="#" method="post">
                <div class="input-group">
                  <input type="text" name="message" placeholder="Type Message ..." class="form-control" id='message'>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-warning btn-flat" id='send'>Send</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
        </div>
          <!--/.direct-chat -->
<?php $this->start('scriptBottom'); ?>
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
<?php  $this->end(); ?>

<script src="js/autobahn-js-browser/autobahn.min.js"></script>

<script>

$(document).ready(function(){
  let name = '<?php echo $this->request->session()->read('Auth.User.name') ?>';
  let id = '<?php echo $this->request->session()->read('Auth.User.id') ?>';
  var userPhoto = '<?php echo $this->request->session()->read('Auth.User.photo') ?>';

  var to = 0;
  var csrfToken = $('[name=_csrfToken]').val();

  function read(fromUser){
    $.ajax({
        type: "POST",
        url: '<?php echo Router::url(array("controller" => "MessageNotifications", "action" => "read")); ?>',
        headers: {          
         Accept: "application/json"  
          },  
        data: {'to' : id, 'from' : fromUser},
        beforeSend: function(xhr){
           xhr.setRequestHeader('X-CSRF-Token', csrfToken);
        },
        success: function(data){
          $('#user'+fromUser+'Notifications').remove();
          if(parseInt($('#totalNotifications').text()) - data > 0){
            $('#totalNotifications').text(parseInt($('#totalNotifications').text()) - data);
            $('#totalNotifications').prop('title', parseInt($('#totalNotifications').text()) +' New Messages');
          }
          else{
            $('#totalNotifications').remove();
          }

        }
      });

  }

  function loadMessages(toNew){
    to = toNew;
    read(to);
    $('#messages').empty();
    $('#loading').show();
    $.ajax({
      type: "POST",
      url: '<?php echo Router::url(array("controller" => "Messages", "action" => "loadMessages")); ?>',
      headers: {          
       Accept: "application/json"  
        },  
      data: {'to' : to, 'from' : '<?php echo $this->request->session()->read('Auth.User.id') ?>'},
      beforeSend: function(xhr){
         xhr.setRequestHeader('X-CSRF-Token', csrfToken);
      },
      success: function(messages){
        var messages = jQuery.parseJSON(messages);
        Object.values(messages).forEach(function(message) {
          if(message.from == id){
            var main = $("<div class='direct-chat-msg right'></div>");
            var info = $("<div class='direct-chat-info clearfix'></div>");
            info.append($("<span class='direct-chat-name pull-right'>"+message.name+"</span>"))
            info.append($("<span class='direct-chat-timestamp pull-left'>"+message.time+"</span>"));
            main.append(info);
            main.append($('<img src="'+userPhoto+'"  class="direct-chat-img">'));
            main.append($("<div class='direct-chat-text'>"+message.message+"</div>"));
            main.appendTo($('#messages'));
          }
          else{
            var main = $("<div class='direct-chat-msg'></div>");
            var info = $("<div class='direct-chat-info clearfix'></div>");
            info.append($("<span class='direct-chat-name pull-left'>"+message.name+"</span>"))
            info.append($("<span class='direct-chat-timestamp pull-right'>"+message.time+"</span>"));
            main.append(info);
            //main.append($('<?php echo $this->Html->image("profile/'+args[2]+'.jpg", array("class" => "direct-chat-img", "alt" => "message user image")); ?>'));
            main.append($('<img src="'+message.photo+'"  class="direct-chat-img">'));
            main.append($("<div class='direct-chat-text'>"+message.message+"</div>"));
            main.appendTo($('#messages'));
          }
          
          $('#messages').scrollTop(9e9);
          
        });
        $("#loading").hide();
      }

    });

}


  loadMessages(0);

  function addContact(user){
    var contact = $('<li></li>');
    var clickable = $('<a href="#" ></a>');
    clickable.click(function(){ loadMessages(user.id); return false; });
    clickable.click(function(){ contactsToggle.click(); return false; });
    clickable.click(function(){ $('#chatTitle').text(user.name); return false; });
    

    clickable.append($('<img src="'+user.photo+'"  class="contacts-list-img">'));
    contact.append(clickable);
    var divContainer = $('<div class="contacts-list-info"></div>');
    clickable.append(divContainer);
    divContainer.append($('<span class="contacts-list-name">'+user.name+'<small class="contacts-list-date pull-right">'+user.time+'</small></span>'));
    if(user.notifications){
      divContainer.append($('<span data-toggle="tooltip" id="user'+user.id+'Notifications" title="'+user.notifications+' New Messages" class="badge bg-yellow pull-right">'+user.notifications+'</span>'));
      if($('#totalNotifications').text() > 0){
        $('#totalNotifications').text(parseInt($('#totalNotifications').text()) + user.notifications);
        $('#totalNotifications').prop('title', parseInt($('#totalNotifications').text()) +' New Messages');
      }
      else{

        $('#contactsToggle').append($('<span data-toggle="tooltip" title="'+user.notifications+' New Messages" class="badge bg-yellow" id="totalNotifications">'+user.notifications+'</span>'));
      }
    }
    divContainer.append($('<span class="contacts-list-msg">'+user.message+'</span>'));
    contact.appendTo($('#contacts'));
  }
  ///addContact({id: 0, name: "Global", photo:''});
  

  function loadContacts(){
    $.ajax({
      type: "POST",
      url: '<?php echo Router::url(array("controller" => "Messages", "action" => "loadContacts")); ?>',
      headers: {          
       Accept: "application/json"  
        },  
      data: {'user' : id},
      beforeSend: function(xhr){
         xhr.setRequestHeader('X-CSRF-Token', csrfToken);
      },
      success: function(users){
        $('#contacts').empty();
        $('#totalNotifications').remove();
        var users = jQuery.parseJSON(users);
        Object.values(users).forEach(function(user) {
          addContact(user);
        });

      }
    });
}


loadContacts();
  var connection = new autobahn.Connection({url: 'wss://team.southpacificavionics.com/wss', realm: 'realm1'});
  connection.onopen = function (session) {
     function onevent(args) {
      if(0 == args[4]){
        $.notify({
                message: 'New message in Global Chat: "' + args[0] + ': ' + args[1].substring(0,20) + '"'
            }, {
                type: 'warning'
            });
      }
      else{
      $.notify({
                message: 'New message from ' + args[0] + ': "' + args[1].substring(0,20) + '"'
            }, {
                type: 'warning'
            });
    }
      //stupidly overcomplicated makes sure that it only adds message if looking at the right chat.
        if((0 == args[4] && to == 0) || (to == args[2] && args[4] != 0)){
          let date = new Date();
          let time = date.getHours()+":"+date.getMinutes();
          var main = $("<div class='direct-chat-msg'></div>");
          var info = $("<div class='direct-chat-info clearfix'></div>");
          info.append($("<span class='direct-chat-name pull-left'>"+args[0]+"</span>"))
          info.append($("<span class='direct-chat-timestamp pull-right'>"+time+"</span>"));
          main.append(info);
          //main.append($('<?php echo $this->Html->image("profile/'+args[2]+'.jpg", array("class" => "direct-chat-img", "alt" => "message user image")); ?>'));
          main.append($('<img src="'+args[5]+'"  class="direct-chat-img">'));
          main.append($("<div class='direct-chat-text'>"+args[1]+"</div>"));
          main.appendTo($('#messages'));
          read(to);
          $('#messages').scrollTop(9e9);
        }
      loadContacts();
     }
     session.subscribe('spa.chat.global', onevent);
     session.subscribe('spa.chat.private.'+id, onevent);
     $('#send').click(function(){
      let message = $('#message').val();
        if(message &&  !$.trim(message) == '' ){
          let date = new Date();
          let time = date.getHours()+":"+date.getMinutes();
          if(to > 0){
            session.publish('spa.chat.private.'+to, [name, message, id, time, to, userPhoto]);
          }
          else{
            session.publish('spa.chat.global', [name, message, id, time, to, userPhoto]);
          }
          
          var main = $("<div class='direct-chat-msg right'></div>");
          var info = $("<div class='direct-chat-info clearfix'></div>");
          info.append($("<span class='direct-chat-name pull-right'>"+name+"</span>"))
          info.append($("<span class='direct-chat-timestamp pull-left'>"+time+"</span>"));
          main.append(info);
          main.append($('<img src="/img/profile/'+id+'.jpg"  class="direct-chat-img">'));
          main.append($("<div class='direct-chat-text'>"+message+"</div>"));
          main.appendTo($('#messages'));

          
          $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array("controller" => "Messages", "action" => "send")); ?>',
            headers: {          
             Accept: "application/json"  
              },  
            data: {'to' : to, 'from' : id, 'message' : message},
            beforeSend: function(xhr){
               xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },
            success: function(data){
              loadContacts();
              var data = jQuery.parseJSON(data);
            }
          });

      }
      $('#messages').scrollTop(9e9);
      $('#message').val('');
      
     });


  };

  connection.open();
  //WEBSOCKET END

  $('#message').on('keypress', (event)=> {
        if(event.which === 13){
            $('#send').click();
        }
  });
  
});


</script>