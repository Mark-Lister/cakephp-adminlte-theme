<?php use Cake\Core\Configure; ?>
<?php use Cake\Routing\Router; ?>
<!DOCTYPE html>
<!-- Custom styles to disable animation temporarily (inlined for show) -->
<style>
/* Probably doesn't need all these prefixes but oh well */
.disable-animations, .disable-animations * {
  /* CSS transitions */
  -o-transition-property: none !important;
  -moz-transition-property: none !important;
  -webkit-transition-property: none !important;
  transition-property: none !important;
  /* CSS transforms */
  -o-transform: none !important;
  -moz-transform: none !important;
  -webkit-transform: none !important;
  transform: none !important;
  /* CSS animations */
  -webkit-animation: none !important;
  -moz-animation: none !important;
  -o-animation: none !important;
  animation: none !important;
}
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
.chat_box{
    position:fixed;
    right:20px;
    bottom:0px;
    width:350px;
    z-index: 500; 
}
.chat_body{
    height:400px;
    border-right: 1px solid rgba(0, 0, 0, 0.28);
    border-left: 1px solid rgba(0, 0, 0, 0.28);

}

.required label:after {
    color: #d00;
    content: " *"
}

.ball {

  animation: bounce 0.6s infinite alternate;
  -webkit-animation: bounce 0.6s infinite alternate;

}

@keyframes bounce {
  from {
    transform: translateY(-5px) scale(1, 1);
  }
  to {
    transform: translateY(-20px) scale(1.2, 1.2);
  }
}
@-webkit-keyframes bounce {
  from {
    transform: translateY(-5px) scale(1, 1);
  }
  to {
    transform: translateY(-20px) scale(1.2, 1.2);
  }
}


</style>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <title>SPA <?php echo $this->request->params["controller"]?> <?php echo ($this->request->getParam('pass') ?  $this->request->getParam('pass')[0] : '') ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <?php echo $this->Html->css('AdminLTE./bootstrap/css/bootstrap.min'); ?>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
<!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <?php echo $this->Html->css('AdminLTE.skins/skin-'. Configure::read('Theme.skin') .'.min'); ?>

    <?php echo $this->fetch('css'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body class="hold-transition skin-<?php echo Configure::read('Theme.skin'); ?> sidebar-mini fixed" >
    <!-- Site wrapper -->
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo $this->Url->build('/'); ?>" class="logo hidden-xs">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="<?php echo '/img/matchlogo.jpg';?>" class="brandlogo-image" width=40></span>
                <!--<?php echo Configure::read('Theme.logo.mini'); ?>-->
                <!-- logo for regular state and mobile devices -->
                <!--<?php echo Configure::read('Theme.logo.large'); ?> -->
                <span class="logo-lg"><img src="<?php echo '/img/matchlogo.jpg';?>"  class="brandlogo-image" width=120></span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <?php echo $this->element('nav-top') ?>
        </header>

        <!-- Left side column. contains the sidebar -->
        <?php echo $this->element('aside-main-sidebar'); ?>

        <!-- =============================================== -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" >

            <?php echo $this->Flash->render(); ?>
            <?php echo $this->Flash->render('auth'); ?>
            <?php echo $this->fetch('content'); ?>

        </div>
        <!-- /.content-wrapper -->

        <?php echo $this->element('footer'); ?>

        <!-- Control Sidebar -->
        <?php echo $this->element('aside-control-sidebar'); ?>
        <!-- /.control-sidebar -->
<!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
        <!-- Chatbox -->
      <div class="chat_box">
    <div class="box box-warning direct-chat direct-chat-warning" style="margin-bottom:0px;padding:0px">
            <div class="box-header with-border chat_head">
            <div id="chat-toggle" style="margin-top:-5px;margin-bottom:-5px; cursor:pointer;">
             <h3 class="box-title" id='chatTitle'>Global</h3>
          </div>

              <div class="box-tools pull-right" id='topBar'>

                <button style="margin-top:-5px;margin-bottom:-5px" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle" id="chat-contacts-toggle">
                  <i class="fa fa-comments"></i></button>
                <!--button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                </button-->
              </div>
            </div>
            <div style="display: none;" class="chat_body"> 
            <!-- /.box-header -->
            <div class="box-body" style="height:86%;overflow:hidden">
              <div class="lds-ring" id="loading"><div></div><div></div><div></div><div></div></div>
              <!-- Conversations are loaded here -->
              <div class="direct-chat-messages" id="chat-messages" style="height:100%">
               
              </div>
              <!--/.direct-chat-messages-->

              <!-- Contacts are loaded here -->
              <div class="direct-chat-contacts" style="height:100%">
                <ul class="contacts-list" id="contacts-list">
                  
                </ul>
                <!-- /.contatcts-list -->
              </div>
              <!-- /.direct-chat-pane -->
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
              <form action="#" method="post">
                <div class="input-group">
                  <input type="text" name="message" placeholder="Type Message ..." class="form-control" id='chat-message'>
                      <span class="input-group-btn">
                        <button type="button" class="btn btn-warning btn-flat" id='chat-send'>Send</button>
                      </span>
                </div>
              </form>
            </div>
            <!-- /.box-footer-->
          </div>
      </div>
    </div>
        
</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<?php echo $this->Html->script('AdminLTE./plugins/jQuery/jquery-2.2.3.min'); ?>
<!-- jQuery UI 1.11.4 -->
<?php echo $this->Html->script('AdminLTE./plugins/jQueryUI/jquery-ui.min'); ?>
<!--script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script--> 
<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->script('AdminLTE./bootstrap/js/bootstrap.min'); ?>

<!-- X-Editable for inline edit -->
<!--link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/-->
<!--script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script-->
<?php echo $this->Html->script('AdminLTE./plugins/x-editable/bootstrap3-editable/js/bootstrap-editable.min'); ?>


<?php echo $this->Html->css('AdminLTE./plugins/x-editable/bootstrap3-editable/css/bootstrap-editable.min'); ?>
<?php echo $this->Html->script('AdminLTE./plugins/x-editable/inputs-ext/wysihtml5/wysihtml5'); ?>

<!-- Bootstrap 3.3.5 WSY -->
<?php echo $this->Html->script('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all'); ?>

<?php echo $this->Html->css('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min'); ?>
<!-- CaretJS for showing who's typing -->
<?php echo $this->Html->script('AdminLTE./plugins/Caret.js/src/jquery.caret'); ?>


<!-- SlimScroll -->
<?php echo $this->Html->script('AdminLTE./plugins/slimScroll/jquery.slimscroll.min'); ?>
<!-- FastClick -->
<?php echo $this->Html->script('AdminLTE./plugins/fastclick/fastclick'); ?>

<!-- autobahn for websockets -->
<?php echo $this->Html->script('autobahn-js-browser/autobahn.min.js'); ?>
<!-- Web notifications -->
<?php echo $this->Html->script('bootstrap-notify-3.1.3/bootstrap-notify.min'); ?>
<!-- Desktop notifications-->
<?php echo $this->Html->script('AdminLTE./plugins/push.js/bin/push.min'); ?>
<!-- Mobile notifications-->
<?php echo $this->Html->script('AdminLTE./plugins/push.js/bin/serviceWorker.min'); ?>

<!-- AdminLTE App -->
<?php echo $this->Html->script('AdminLTE./js/app.min'); ?>

<!-- AdminLTE for demo purposes -->
<?php echo $this->fetch('script'); ?>
<?php echo $this->fetch('scriptBottom'); ?>

<script type="text/javascript">
var chatOpened = false;
var contactsOpen = false;
var chatFirstOpened = false;
var chatToLoad = 0;
  //var body = document.getElementsByTagName('body')[0];
  //$(body).addClass('fixed');
  $(window).resize(function(){
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
  });
    (function ($) {
        /* Store sidebar state */
        $('.sidebar-toggle').click(function(event) {
            
            
            setTimeout(function(){$($.fn.dataTable.tables(true)).DataTable().columns.adjust();},500);

            event.preventDefault();
            if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {
                localStorage.setItem('sidebar-toggle-collapsed', '');
             } else {
                localStorage.setItem('sidebar-toggle-collapsed', '1');
             }
         });

    })(jQuery);
  
  /* Recover sidebar state */
     (function () {
        if (Boolean(localStorage.getItem('sidebar-toggle-collapsed'))) {

            var body = document.getElementsByTagName('body')[0];
            //body.className = body.className + ' disable-animations sidebar-collapse';
      $(body).addClass('disable-animations');
      $(body).addClass('sidebar-collapse');
      
      requestAnimationFrame(function () {
        $(body).removeClass('disable-animations');
      });
        }
    })();

    /* Recover chat box state */
    (function () {
      if (Boolean(localStorage.getItem('chat-box-toggle'))) {
  
      $('.chat_body').toggle(1);
      $('.direct-chat-contacts').toggle(1);
      chatOpened = true;
      chatFirstOpened = true;
      $('.direct-chat-contacts').toggle(1);
        }
        if(localStorage.getItem('chat-to-load')){
          chatToLoad = localStorage.getItem('chat-to-load');
        $('#chatTitle').text(localStorage.getItem('chat-title'));
        }
        
    })();

  if(window.location.hash == "#scrolldown"){
            $(window).load(function() {
              $("html, body").animate({ scrollTop: $(document).height() }, 1000);
              });  
            }

    $(document).ready(function(){
      //$(".content-wrapper, .right-side").css('min-height', window_height - footer_height);
        //$('.content-wrapper').css("min-height", "100%")
        $(".navbar .menu").slimscroll({
            height: "200px",
            alwaysVisible: false,
            size: "3px"
        }).css("width", "100%");

        
        setTimeout(function(){$($.fn.dataTable.tables(true)).DataTable().columns.adjust();},500);
        ////////////////////////////////////////////////////
        function removeHash () { 
          var scrollV, scrollH, loc = window.location;
          if ("pushState" in history)
            history.pushState("", document.title, loc.pathname + loc.search);
          else {
            // Prevent scrolling by storing the page's current scroll offset
            scrollV = document.body.scrollTop;
            scrollH = document.body.scrollLeft;

            loc.hash = "";

            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scrollV;
            document.body.scrollLeft = scrollH;
          }
        }
        if(window.location.hash) {

          localStorage.setItem('tab<?php echo $this->request->params["controller"].$this->request->getParam("action") ?>',window.location.hash);
          removeHash();
        }
        
        $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
          localStorage.setItem('tab<?php echo $this->request->params["controller"].$this->request->getParam("action") ?>', $(e.target).attr('href'));
        });
        var activeTab = localStorage.getItem('tab<?php echo $this->request->params["controller"].$this->request->getParam("action") ?>');
        if(activeTab){
          $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
        ////////////////////////////////////////////////////
        var a = $('a[href="<?php echo $this->request->webroot . $this->request->url ?>"]');
        if (!a.parent().hasClass('treeview') && !a.parent().parent().hasClass('pagination')) {
            a.parent().addClass('active').parents('.treeview').addClass('active');
        }
  $('form input').on('keypress', function(e) {
    return e.which !== 13;      
  });


  //Global variables of information of the logged in user
  let name = '<?php echo $this->request->session()->read('Auth.User.name') ?>';
  let id = '<?php echo $this->request->session()->read('Auth.User.id') ?>';
  var userPhoto = '<?php echo $this->request->session()->read('Auth.User.photo') ?>';
  //Global variable to show which chatbox the user is viewing
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
  

  //Adds messages into the chatbox depending if they're sent or recieved
  function addMessage(message, position){
      if(message.from == id){
        var main = $("<div class='direct-chat-msg right'></div>");
        var info = $("<div class='direct-chat-info clearfix'></div>");
        info.append($("<span class='direct-chat-name pull-right'>"+message.name+"</span>"))
        info.append($("<span class='direct-chat-timestamp pull-left'>"+message.time+"</span>"));
        main.append(info);
        main.append($('<img src="'+userPhoto+'"  class="direct-chat-img">'));
        main.append($("<div class='direct-chat-text'>"+message.message+"</div>"));
        if(position == 'after'){
          main.appendTo($('#chat-messages'));
    }
    else{
      main.prependTo($('#chat-messages'));
    }
      }
      else{
        var main = $("<div class='direct-chat-msg'></div>");
        var info = $("<div class='direct-chat-info clearfix'></div>");
        info.append($("<span class='direct-chat-name pull-left'>"+message.name+"</span>"))
        info.append($("<span class='direct-chat-timestamp pull-right'>"+message.time+"</span>"));
        main.append(info);
        main.append($('<img src="'+message.photo+'"  class="direct-chat-img">'));
        main.append($("<div class='direct-chat-text'>"+message.message+"</div>"));
        if(position == 'after'){
          main.appendTo($('#chat-messages'));
    }
    else{
      main.prependTo($('#chat-messages'));
    }
      }
  }


  //loads some messages toNew is used to pick from what chat
  function loadMessages(toNew){
    $("#chat-messages").unbind();
    var moreRequests = 0;
    to = toNew;
    read(to);
    $('#chat-messages').empty();
    $('#loading').show();
    $.ajax({
      type: "POST",
      url: '<?php echo Router::url(array("controller" => "Messages", "action" => "loadMessages")); ?>',
      headers: {          
       Accept: "application/json"  
        },  
      data: {'to' : to, 'from' : id, 'moreCount': moreRequests},
      beforeSend: function(xhr){
         xhr.setRequestHeader('X-CSRF-Token', csrfToken);
      },
      success: function(messages){
        console.log(messages);
        var messages = jQuery.parseJSON(messages);
        Object.values(messages).forEach(function(message) {
          addMessage(message, 'after');
      });
        $('#chat-messages').scrollTop(9e9);
        
        $("#loading").hide();
        $('#chat-messages').on('scroll', function() {
          //This loads more messages when the chat box it scrolled to the top
      if($(this).scrollTop() == 0){
        $('#chat-messages').scrollTop(1);
        if(moreRequests != null){
          moreRequests += 1;
          $.ajax({
            type: "POST",
            url: '<?php echo Router::url(array("controller" => "Messages", "action" => "loadMessages")); ?>',
            headers: {          
             Accept: "application/json"  
              },  
            data: {'to' : to, 'from' : id, 'moreCount': moreRequests},
            beforeSend: function(xhr){
               xhr.setRequestHeader('X-CSRF-Token', csrfToken);
            },
            success: function(messages){
              var messages = jQuery.parseJSON(messages);
              if(messages.length != 0){
                Object.values(messages).forEach(function(message) {
                  addMessage(message, 'before');
              });
            }
            else{
              moreRequests = null;
            }
              $("#loading").hide();

          }

        });
      }
    }
    });

      }

    });
     

}
  


  


  function isMobileDevice() {
    return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
};

  function addContact(user){
    var contact = $('<li></li>');
    var clickable = $('<a href="#" id="contact'+user.id+'" ></a>');
    clickable.click(function(){ loadMessages(user.id); return false; });
    clickable.click(function(){ $('#chat-contacts-toggle').click(); return false; });
    clickable.click(function(){ $('#chatTitle').text(user.name); return false; });
    clickable.click(function(){  localStorage.setItem('chat-to-load', user.id);; return false; });
    clickable.click(function(){  localStorage.setItem('chat-title', user.name);; return false; });
    clickable.append($('<img src="'+user.photo+'"  class="contacts-list-img">'));
    contact.append(clickable);
    var divContainer = $('<div class="contacts-list-info"></div>');
    clickable.append(divContainer);
    divContainer.append($('<span class="contacts-list-name">'+user.name+'<small class="contacts-list-date pull-right">'+user.time+'</small></span>'));
    if(user.notifications){
      divContainer.append($('<span data-toggle="tooltip" id="user'+user.id+'Notifications" title="'+user.notifications+' New Messages" class="badge bg-red pull-right">'+user.notifications+'</span>'));
      if($('#totalNotifications').text() > 0){
        $('#totalNotifications').text(parseInt($('#totalNotifications').text()) + user.notifications);
        $('#totalNotifications').prop('title', parseInt($('#totalNotifications').text()) +' New Messages');
      }
      else{

        $('#chat-contacts-toggle').append($('<span data-toggle="tooltip" data-placement="left" title="'+user.notifications+' New Messages" class="badge bg-red ball" id="totalNotifications">'+user.notifications+'</span>'));
      }
    }
    divContainer.append($('<span class="contacts-list-msg">'+user.message+'</span>'));
    contact.appendTo($('#contacts-list'));
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
        $('#contacts-list').empty();
        $('#totalNotifications').remove();
        var users = jQuery.parseJSON(users);
        Object.values(users).forEach(function(user) {
          addContact(user);
        });

      }
    });
}


//if the chats closed and contacts is clicked open chat and toggle contacts
$('#chat-contacts-toggle').click(function(e){
  contactsOpen = !contactsOpen;
  if(!chatOpened){
    chatOpened = true;
    $('.chat_body').slideToggle('slow');
  }
});

//Used to load the messages only when the chatbox is opened and toggles the chatbox
$('#chat-toggle').click(function(){
  $('.chat_body').slideToggle('slow');
  if(!chatFirstOpened){
    loadMessages(chatToLoad);
    chatFirstOpened = true;
    $('#chat-messages').scrollTop(9e9);
  }
  if(!chatOpened){
    chatOpened = true;
    read(to);
    localStorage.setItem('chat-box-toggle', '1');

  }
  else{
    chatOpened = false;
    localStorage.setItem('chat-box-toggle', '');
  }

});

loadContacts(); //First load required to load contacts and total notifications even if the chat hasn't been opened



if(chatFirstOpened){ //Loads the messages if the chat will be opened on page start
    loadMessages(chatToLoad);
}


  //Websocket connection setup
  var connection = new autobahn.Connection({url: 'wss://team.southpacificavionics.com/wss', realm: 'realm1'});
  connection.onopen = function (session) {
    var snd = new Audio("data:audio/wav;base64,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qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqTEFNRTMuOTguMqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq");  
    
     function onevent(args) {
      snd.play();
      var viewing = document.hasFocus();
      if(0 == args[4]){
        $.notify({
                message: 'New message in Global Chat from "' + args[0] + ': ' + args[1].substring(0,20) + '"'
            }, {
                type: 'warning'
            });
            if(!viewing){
            Push.create('New message in Global Chat: ' + args[0], {
                body: args[1].substring(0,100),
                icon: args[5],
                tag: 'global',
                //requireInteraction: true,
                timeout: 4000,
                onClick: function () {
                    window.focus();
                    if(!chatOpened){
                      $('#chat-toggle').click();
                    }
                     console.log(contactsOpen);
                    if(contactsOpen){
                        $("#chat-contacts-toggle").click();
                      }
                    $('#chatTitle').text("Global");
                    loadMessages(0);
                    
                    this.close();
                }
            });
          }
      }
      else{
      $.notify({
                message: 'New message from ' + args[0] + ': "' + args[1].substring(0,20) + '"'
            }, {
                type: 'warning'
            });
      
      if(!viewing){
        Push.create('New message from ' + args[0], {
                  body: args[1].substring(0,100),
                  tag: args[0],
                  requireInteraction: true,
                  icon:  args[5],
                 // timeout: 4000,
                  onClick: function () {
                      window.focus();
                      if(!chatOpened){
                        $('#chat-toggle').click();
                      }
                      c
                      if(contactsOpen){
                        $("#chat-contacts-toggle").click();
                      }
                      $('#chatTitle').text(args[0]);
                      loadMessages(args[2]);
                      
                      this.close();
                  }
              });
    }
    }
        //stupidly overcomplicated makes sure that it only adds message if looking at the right chat.
        if((0 == args[4] && to == 0) || (to == args[2] && args[4] != 0)){
          let date = new Date();
          let time = date.getHours()+":"+date.getMinutes();
          if(chatOpened){
            read(to);
          }
          addMessage({'name': args[0], 'message':args[1], 'from':args[2], 'time':args[3], 'photo':args[5]}, 'after');
          $('#chat-messages').scrollTop(9e9);
        }
      loadContacts();
     }
     session.subscribe('spa.chat.global', onevent);
     session.subscribe('spa.chat.private.'+id, onevent);
     $('#chat-send').click(function(){
      let message = $('#chat-message').val();
        if(message &&  !$.trim(message) == '' ){
          let date = new Date();
          let time = date.getHours()+":"+date.getMinutes();
          if(to > 0){
            session.publish('spa.chat.private.'+to, [name, message, id, time, to, userPhoto]);
          }
          else{
            session.publish('spa.chat.global', [name, message, id, time, to, userPhoto]);
          }
          addMessage({'name': name, 'time':time, 'message':message, 'from':id, 'photo':userPhoto}, 'after');

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
              //console.log(data);
              //data = jQuery.parseJSON(data);
              loadContacts();
              
            }
          });

      }
      $('#chat-messages').scrollTop(9e9);
      $('#chat-message').val('');
      
     });


  };
  

  connection.open();
  //WEBSOCKET END

  $('#chat-message').keydown(function(e) {
        if(event.which === 13){
            $('#chat-send').click();
        }
  });

  $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });

  $('.fa-calendar').click(function(){
    $(this).parent().next().children(":first").focus();
  });

  
  });

//NUMBER FORMAT
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>
</body>
</html>
