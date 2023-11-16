<?php
require_once('GetTableModel.php');
require_once('DisplayPageView.php');

class GetTableController {
    public function get_Table_Controller() {
        $mtf = new GetTableModel();
        $r = $mtf->getTableModel();
        return $r;
    }

    public function display_Page() {
        $v = new DisplayPageView();
        $v->displayHeader();
        $v->displayImage();
        $v->displayMenu();
        $v->displayVideo();
        $data = $this->get_Table_Controller();
        $v->displayTable($data);
        $v->displayFooter();
    }
}

?>
