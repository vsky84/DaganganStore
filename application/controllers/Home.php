<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home extends CI_Controller{
		protected $current_user_id;
		protected $account_type;
		public function __construct(){
			parent::__construct();
			if(!isset($_SESSION['currentUserId'])) $this->session->set_userdata('currentUserId','1');
			if(!isset($_SESSION['accountType'])) $this->session->set_userdata('accountType','user');
			$this->load->model('home_model');
		}

		public function index(){
			$home_models['data'] = $this->home_model->get_all_products();

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['content'] = $this->load->view('pages/content.php', $home_models, TRUE);

			$this->load->view('pages/home.php', $data);
		}

		public function fetch(){
			$output = '';
			$query = '';
			if($this->input->post('query')){
				$query = $this->input->post('query');
			}
			$data = $this->home_model->fetch_data($query);
						
			$output .= '
				<div class="row">
			';
			if($data->num_rows() > 0){
				foreach($data->result() as $row){
					$output .= '
						<div class="card col-lg-3 col-md-3 col-sm-3" style="margin-bottom: 20px;">';
					$output .= '
						<img src="'.base_url().$row->product_path_image.'" width="100%" height="auto" style="padding-bottom:10px">
						<p><b>'.$row->product_name.'</b></p>
						<p>Rp. '.$row->product_price.'</p>
						<a class="btn btn-info" href="'.base_url('index.php/Home/open_detail/').$row->product_id.'">Details</a>
						<a class="btn btn-warning" href="'.base_url('index.php/Home/add_to_shopping_cart_home/').$row->product_id.'">Add to Cart</a>
					';	
					$output .= '
						</div>
					';
				}
			}
			else{
				$output .= '
					<center><h2>Search not Found</h2></center>
				';
			}
			$output .= '
				</div>
			';
			echo $output;
		}

		public function fetch_filtered($category_id){
			$output = '';
			$query = '';
			$id = $category_id;//$this->input->post('category');
			echo '<script>console.log('.$id.')</script>';
			if($this->input->post('query')){
				$query = $this->input->post('query');
			}
			$data = $this->home_model->fetch_data_filtered($query, $id);
						
			$output .= '
				<div class="row">
			';
			if($data->num_rows() > 0){
				foreach($data->result() as $row){
					$output .= '
						<div class="card col-lg-3 col-md-3 col-sm-3" style="margin-bottom: 20px;">';
					$output .= '
						<img src="'.base_url().$row->product_path_image.'" width="100%" height="auto" style="padding-bottom:10px">
						<p><b>'.$row->product_name.'</b></p>
						<p>'.$row->product_price.'</p>
						<a class="btn btn-info" href="'.base_url('index.php/Home/open_detail/').$row->product_id.'">Details</a>
						<a class="btn btn-warning" href="'.base_url('index.php/Home/add_to_shopping_cart_home/').$row->product_id.'">Add to Cart</a>
					';	
					$output .= '
						</div>
					';
				}
			}
			else{
				$output .= '
					<center><h2>Search not Found</h2></center>
				';
			}
			$output .= '
				</div>
			';
			echo $output;
		}

		public function open_detail($product_id){
			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['selected_product'] = $this->home_model->get_selected_product($product_id);
			$this->load->view('pages/product_detail.php', $data);
		}

		public function filter_category(){
			$id =  $this->input->post('category');

			$home_models['filter_data'] = $this->home_model->get_filtered_products($id);
			$home_models['data'] = $this->home_model->get_all_products();

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['content'] = $this->load->view('pages/content.php', $home_models, TRUE);

			$this->load->view('pages/home.php', $data);
			
		}

		public function add_to_shopping_cart_home($product_id){
			$res = $this->home_model->addToShoppingCart($product_id);
			if($res){
				redirect(base_url('index.php/Home')); //biar pulangnya ke HOME
			}
			else{
				echo 'There is an error';
			}
		}

		public function add_to_shopping_cart_detail($product_id){
			$res = $this->home_model->addToShoppingCart($product_id);
			if($res){
				redirect(base_url('index.php/Home/open_detail/').$product_id); //biar pulangnya tetap di DETAIL PRODUK
			}
			else{
				echo 'There is an error';
			}
		}

		public function openAbout(){
			$home_models['data'] = $this->home_model->get_all_products();

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['content'] = $this->load->view('pages/content.php', $home_models, TRUE);

			$this->load->view('pages/about.php', $data);
		}

		public function openShoppingCart(){
			$data['sc_product'] = $this->home_model->getProductFromCart();

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);

			$this->load->view('pages/shopping_cart.php', $data);
		}
		public function debugPanel() {
			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['orders'] = $this->home_model->getOrders();
			$data['accountType']=$this->session->accountType;
			$data['currentUserId']=$this->session->currentUserId;;
			$this->load->view('pages/debugpanel.php', $data);
		}
		public function OrderDetails($param) {
			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['order'] = $this->home_model->getOrder($param);
			$data['order_details']=$this->home_model->getOrderDetails($param);
			$this->load->view('pages/orderdetails.php', $data);
		}
		public function EditOrder($param) {
			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
			$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
			$data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
			$data['footer'] = $this->load->view('pages/footer.php', NULL, TRUE);
			$data['order'] = $this->home_model->getOrder($param);
			$data['order_details']=$this->home_model->getOrderDetails($param);
			$this->load->view('pages/editorder.php', $data);
		}
		public function set_user_id() {
			if(isset($_POST["submit"])){
				$this->current_user_id=$this->input->post('userid');
				$this->session->set_userdata('currentUserId',$this->current_user_id);
				echo "Changing current user_id to $this->current_user_id ...";
				redirect('Home/debugPanel', 'refresh');
			}
		}
		public function set_account_type() {
			if(isset($_POST["submit"])){
				$this->account_type=$this->input->post('account_type');
				$this->session->set_userdata('accountType',$this->account_type);
				echo "Changing current account type to $this->account_type ...";
				redirect('Home/debugPanel', 'refresh');
			}
		}
		public function edit_action() {
			if(isset($_POST["submit"])) {
				$this->home_model->updateOrder($this->input->post('order_id'),$this->input->post('tracking_number'),$this->input->post('order_status'));
				echo "Entry updated, redirecting...";
				redirect('Home/debugPanel', 'refresh');
			}
		}
	}
?>