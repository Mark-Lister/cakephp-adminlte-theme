<?php
use Cake\Core\Configure;

$file = Configure::read('Theme.folder') . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'aside' . DS . 'user-panel.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<div class="user-panel">
    <div class="pull-left image">
        <img src="<?php echo $this->request->session()->read('Auth.User.photo') ?>" class="img-circle">
    </div>
    <div class="pull-left info">
        <p><?=$this->request->session()->read('Auth.User.name')?></p>
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a> -->
    </div>
</div>
<?php } ?>
