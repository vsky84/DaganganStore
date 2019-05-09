<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Home_model extends CI_Model{

		function fetch_data($query){
			$this->db->select("product_id, product_name, product_price, product_path_image");
			$this->db->from("products");
			if($query != ''){
				$this->db->like('product_name', $query);
				//$this->db->or_like('yglain',$query);
				
			}
			$this->db->order_by('product_name', 'DESC');
			return $this->db->get();
		}

		function fetch_data_filtered($query, $id){
			$this->db->select("product_id, product_name, product_price, product_path_image");
			$this->db->from("products");
			$this->db->where("category_id", $id);
			if($query != ''){
				$this->db->like('product_name', $query);
				//$this->db->or_like('yglain',$query);
				
			}
			$this->db->order_by('product_name', 'DESC');
			return $this->db->get();
		}

		function get_all_products(){
			$query = $this->db->query("SELECT * FROM products");

			return $query->result_array();
		}

		// untuk mengambil data product yang ada buat di tampilin di home
		function get_selected_product($product_id){
			$query = $this->db->query("SELECT * FROM products WHERE product_id=$product_id");
			
			return $query->result_array();
		}

		// untuk seleksi kategori produk biar sesuai dengan yang diinginkan
		function get_filtered_products($id){
			$query = $this->db->query("SELECT * FROM products WHERE category_id=$id");
			
			return $query->result_array();
		}

		function addToShoppingCart($id){
			$query = $this->db->query("INSERT INTO shopping_carts(user_id, product_id,quantity_shopping) VALUES(1,$id,1)");
			if($query == true){
				return true;
			}
			else{
				return false;
			}
		}

		function getProductFromCart(){
			$query = $this->db->query("
				SELECT p.product_id 'productid', p.product_name 'productname', quantity_shopping 'qty', p.product_price*quantity_shopping 'price'
				FROM shopping_carts sc, products p
				WHERE sc.product_id = p.product_id
			");

			return $query->result_array();
		}
				// function delete(){
		// 	$this->db->WHERE('product_id', $this->input->post('product_id'));
		// 	$this->db->delete('shopping_carts');
		// 	if ($this->db->affected_rows()) {
		// 		echo "Successfully Deleted!";
		// 	}
		// 	else{
		// 		echo "Not Deleted";
		// 	}
		// }
		
		function getOrders() {
			$query = $this->db->query("SELECT o1.order_id, o1.tracking_number, o2.description, o1.order_date FROM orders as o1, order_status as o2 WHERE o1.order_status_id=o2.order_status_id");
			return $query->result_array();
		}
		function getOrder($id) {
			$query = $this->db->query("SELECT o1.order_id, o1.tracking_number, o2.description, o1.order_date FROM orders as o1, order_status as o2 WHERE o1.order_status_id=o2.order_status_id AND o1.order_id=$id");
			return $query->row();
		}
		function getOrderDetails($id) {
			$query = $this->db->query("SELECT p1.product_name, o2.quantity_shopping, p1.product_price*o2.quantity_shopping as sum_price FROM orders as o1, order_details as o2, products as p1 WHERE o1.order_id=o2.order_id AND o2.product_id=p1.product_id AND o1.order_id=$id");
			return $query->result_array();
		}
		function updateOrder($order_id, $tracking_number, $status_id) {
			$values=array(
				'order_id'=>$order_id,
				'tracking_number' => $tracking_number,
				'order_status_id' => $status_id,
			);		
			$this->db->where('order_id',$order_id);
			$this->db->update('orders',$values);
		}
	}
?>