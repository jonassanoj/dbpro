<?php
	class view extends CI_Controller {
		public function __construct(){
				parent::__construct();
				//$this->load->model('paginator');
				$this->load->library('pagination');
				$this->load->model('question_model');
				$this->load->helper('form');
		}
				
		public function recentQuestions(){
		   $config['base_url']=base_url('index.php/view/recentQuestions');
            $limit = $config['per_page']=5;
            $config['total_rows']=$this->db->get('Question')->num_rows();
            $this->pagination->initialize($config);
            $offset = $this->uri->segment(3);
            $data['questions']=$this->question_model->get_ten_recent_question($limit, $offset);
            $data ['title'] = 'Recent Questions';
            $this->load -> view ('templates/header', $data );
            $this->load -> view ('pages/home', $data );
            $this->load -> view ('pagination/paginate_question', $data );
            $this->load -> view ('templates/footer');
		}
		
		public function viewAnswer($qid){
		    $config['base_url']=base_url('index.php/view/viewAnswer');
            $limit = $config['per_page']=5;
            $config['total_rows']=$this->db->get('Answer')->num_rows();
            $this->pagination->initialize($config);
            $seg=$this->uri->segment(4);
			$questions=urldecode($qid);
			$data['answers']=$this->answer_model->get_answer($seg,$limit,$qid);
			$data ['title'] = "Answers for question $qid";
			$this->load->view ('templates/header', $data);
            $this->load->view ('pages/home', $data );
			$this->load->view ('pagination/paginate_answer',$data );
			$this->load->view ('templates/footer');
		}
		
		
		public function viewComment($aid)
		{
		    $config['base_url']=base_url('index.php/view/viewComment');
            $limit = $config['per_page']=5;
            $config['total_rows']=$this->db->get('Comment')->num_rows();
            $this->pagination->initialize($config);
            $seg=$this->uri->segment(4);
            $data['comments']=$this->comment_model->get_comment_data($seg,$limit,$aid);
			//$questions=urldecode($aid);
			$data ['title'] = "Comments for Answer $aid";
			$this ->load -> view ('templates/header', $data );
            $this->load->view ('pages/home', $data );
			$this ->load -> view ('pagination/paginate_comment', $data );
			$this ->load -> view ('templates/footer');
		}
		
		public function search()
		{
		
		//$dd = $this->input->post('s');
		$data['ques'] = $this->question_model->search_question();
		$this->load->view('question_view', $data);
		}
		
		public  function createQuestion($value='')
		{
			
		}
			
			
		public  function createComment($value='')
		{
			
		}	
	}
