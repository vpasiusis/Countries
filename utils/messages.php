<?php


class messages
{
    public $module;
    public function __construct($module) {
        $this->module = $module;
    }

    public function contructMessage(){
    if(isset($_GET['remove_error'])) { ?>
    <div class="errorBox">
        <?php echo $this->module ?>wasn't removed
    </div>
    <?php  }
    if (isset($_GET['remove_success'])){ ?>
    <div class="successBox">
        <?php echo $this->module ?> was removed
    </div>
    <?php }
    if (isset($_GET['create_success'])){ ?>
        <div class="successBox">
            <?php echo $this->module ?> was created
        </div>

    <?php }
    if (isset($_GET['edit_success'])){ ?>
        <div class="successBox">
            <?php echo $this->module ?> was edited
        </div>
    <?php }

    }
}