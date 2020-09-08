<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'nav-top.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<style>
.docs {
  float: right;


}
</style>
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li class="dropdown messages-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="fa fa-envelope-o"></i>
          <span class="label label-success">4</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">Test</li>
          
          <li class="footer"><a href="#">Button</a></li>
        </ul>
      </li>
      <!-- User Account: style can be found in dropdown.less -->
      <li>
        <a href="" onclick="javascript:openNewWindow(`/Bugs/add/<?php echo str_replace( '/', '.', substr($_SERVER['REQUEST_URI'], 1)); ?>`, null);return false;" >
          <i class="fa fa-bug"></i>
        </a>
      </li>
      <li>
        <a href="" onclick="javascript:openNewWindow(`/Documentation/view/<?php echo str_replace( '/', '.', substr($_SERVER['REQUEST_URI'], 1)); ?>`, null);return false;" >
          <i class="fa fa-question-circle"></i>
        </a>
      </li>
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <?php echo $this->Html->image($this->request->session()->read('Auth.User.photo'), array('class' => 'user-image', 'alt' => 'User Image')); ?>
          <span class="hidden-xs"><?=$this->request->session()->read('Auth.User.name');?></span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <?php echo $this->Html->image($this->request->session()->read('Auth.User.photo'), array('class' => 'img-circle', 'alt' => 'User Image')); ?>

            <p>
              <?=$this->request->session()->read('Auth.User.name');?> - <?=$this->request->session()->read('Auth.User.spa_auth_number');?><br>
				
			  <?=$this->request->session()->read('Auth.User.role_id');?>
			  
              <!--small>Member since Nov. 2012</small-->
            </p>
          </li>

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="/users/edit/<?=$this->request->session()->read('Auth.User.id')?>" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
              <a href="/users/logout" class="btn btn-default btn-flat">Sign out</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
  </div>
</nav>
<?php
}
?>
<script>
function openNewWindow(newPageURL, type)
      { 
          if(type === 'add' && newPageURL.split('.').length > 2){
            if(newPageURL.split('.')[1].toUpperCase() === 'EDIT' || newPageURL.split('.')[1].toUpperCase() === 'ADD'){
              var labels = [];
              $('.box-body label').each(function(index){
                labels.push($(this).text())
              });
              localStorage.setItem('labels', labels);
            }

          }

          window.open(newPageURL, "_blank","height="+(window.screen.availHeight-100)+"px width="+window.screen.availWidth/1.7+"px " +
              "resizable=no scrollbars=no menubar=no location=no status=no");

      }
</script>
