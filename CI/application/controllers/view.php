<?php
	class view extends CI_Controller {
		public function __construct(){
				parent::__construct();
				//$this->load->model('paginator');
				$this->load->library('pagination');
				$this->load->model('question_model');
				$this->load->helper('form');
				$this->load->library('session');
				$this->load->library('form_validation');
		}
				
		public function recentQuestions(){
				if($this->session->userdata('login')){
					echo "show user questions.";
				}
				else{
		   $config['base_url']=base_url	('index.php/view/recentQuestions');
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
		if(count($data)==0)
			exit;
		
		$this->load->view('question_view', $data);
		}
		
		public  function createQuestion()
		{
			
			//$this->load->helper('form');
			//$this->load->library('form_validation');
	
			$data['title'] = 'Add a new Question';
			$this -> load -> view ('templates/header', $data);
			 $this -> load -> view ('templates/footer', $data);
			//$this->form_validation->set_rules('questionID', 'questionID', 'required');
			$this->form_validation->set_rules('catid', 'catID', 'required');
			//$this->form_validation->set_rules('userID', 'UserID', 'required');
			$this->form_validation->set_rules('title', 'name', 'required');
			$this->form_validation->set_rules('body', 'body', 'required');
			//$this->form_validation->set_rules('postedDate', 'date', 'required');
	
			if ($this->form_validation->run() === FALSE)
			{
					
				$this->load->view('pages/addquestion');
				
		
			}
			else
			{
				$this->question_model->addQuestion();
				$this->load->view('pages/success');
			}
		}
			
			
		public  function createComment($value='')
		{
			
		}	
	}
