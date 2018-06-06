 <?php
 class Testcronjob extends CI_Controller{
  protected $data = array();
  function __construct()
  {
   parent::__construct();

   //$this->load->library('form_validation');
   //$this->load->library('session');
   $this->load->model('Campaignmodel');
  }
  public function index()
  {
    echo "test cronjob";
  }
}
?>