<?php  

namespace Anax\Anax;  

class QuestionsController implements \Anax\DI\IInjectionAware  
{  
    use \Anax\DI\TInjectable;  
		use \Anax\MVC\TRedirectHelpers;
      
    public function initialize()  
    { 
				
				$this->answers = new \Anax\Anax\Answers();  
				$this->answers->setDI($this->di);
					
        $this->questions = new \Anax\Anax\Questions();  
        $this->questions->setDI($this->di);
				
				$this->comments = new \Anax\Anax\Comments();
				$this->comments->setDI($this->di);
				
				$this->taglist = new \Anax\Anax\Taglist();
				$this->taglist->setDI($this->di);
				
				$this->taggar = new \Anax\Anax\Taggar();
				$this->taggar->setDI($this->di);
    }  

    public function addAction()  
    {  
				$this->session();
				
				$this->theme->setTitle("Ställ en fråga");
        if(!isset($_SESSION['user']))  
        {  
            $this->response->redirect($this->url->create('minsida'));  
        }  
				
		    $form = $this->form->create([], [
		        'title' => [
		            'type'        => 'text',
		            'label'       => 'Titel:',
		            'required'    => true,
		            'validation'  => ['not_empty'],
		        ],
		        'content' => [
		            'type'        => 'textarea',
								'label'				=> 'Fråga:',
		            'required'    => true,
		            'validation'  => ['not_empty'],
		        ],
		        'taggar' => [
		            'type'        => 'text',
								'label'				=> 'Taggar(separera med mellanslag):',
		            'required'    => true,
		            'validation'  => ['not_empty'],
		        ],
						
						
		        'submit' => [
		            'type'      => 'submit',
		            'callback'  => function ($form) {
		            
		                return true;
		            }
		        ],
		       
		    ]);
			  // Check the status of the form
			     $status = $form->check();
 
			     if ($status === true) {
						 $now = date("Y-m-d H:i:s");
		         $this->questions->save([  
		             'content'   => $this->textFilter->doFilter($this->request->getPost('content'), 'shortcode, markdown'),  
		             'user'      => $_SESSION['user'],   
		             'title' => $this->request->getPost('title'),
								 'created' => $now
		         ]);
								 $linkid = $this->questions->lastInsertId();
								 $taggar = explode(" ", $this->request->getPost('taggar'));
								 foreach($taggar as $tag){
					         $this->taggar->create([  
					             'tag'      => $tag,   
					             'linkid' => $linkid
					         ]);
								 }
								 $this->redirectTo($this->url->create('questions/show/' . $linkid));
						
			     } else if ($status === false) {
						 	$form->AddOutput("Både titel och innehåll måste fyllas i.");
			     }
					 
			     $this->views->add('default/page', [
			         'title' => "Ställ en fråga",
			         'content' => $form->getHTML()
			     ]);  
    }  
		public function addCommentAction() {
			
			$now = date("Y-m-d H:i:s");

      $this->comments->save([  
          'content'   => $this->request->getPost('content'),  
          'user'      => $this->request->getPost('user'),   
          'linkid' => $this->request->getPost('linkid'),
					'type' => $this->request->getPost('type'),
					'created' => $now
      ]); 
				$this->redirectTo($this->url->create('questions/show/' . $this->request->getPost('redirect')));
		}
		
    public function listAction($tagg = null)  
    { 
			if(isset($tagg)) {
				$title = "Frågor taggade " . $tagg;
				$allIds = $this->taggar->query()
																->where("tag = '$tagg'")
																->execute();
				$this->theme->setTitle("Frågor taggade " . $tagg);
				foreach($allIds as $id) {
					$comment = $this->questions->find($id->linkid);
					$allComments[] = $comment[0];
				}
			}
			else {
	      $allComments = $this->questions->findAll();
				$title = "Alla Frågor";
			}
			$allComments = isset($allComments) ? $allComments : [];
      $this->views->add('question/list-all', [   
              'questions' => $allComments,
							'title' => $title,
      ]);
      
      
    }  
		
    public function toplistAction($tagg = null)  
    { 
	    $questions = $this->questions->query()
				->limit(5)
					->orderBy("created DESC")
				->execute();
			$title = "Alla Frågor";
			
			$questions = isset($questions) ? $questions : [];
      $this->views->add('question/list-top', [   
              'questions' => $questions,
							'title' => $title,
      ]);
      
      
    } 
		
    public function toptaglistAction($tagg = null)  
    { 
	    $taglist = $this->taglist->query()
				->limit(5)
					->orderBy("count DESC")
				->execute();
			$title = "Top 5 taggar";
			
			$questions = isset($questions) ? $questions : [];
      $this->views->add('question/list-alltags', [   
              'taglist' => $taglist,
							'title' => $title,
      ], 'sidebar');
      
      
    } 

    public function removeAction($id = null)  
    {  
        if (!isset($id)) {  
            die("Missing id");  
        }  

        $this->questions->delete($id);  

        $this->response->redirect($this->request->getPost('redirect'));  
    }
		
		public function listTagsAction(){
			$title = "";
      $taglist = $this->taglist->findAll();
			
      $this->views->add('question/list-alltags', [   
              'taglist' => $taglist,
							'title' => $title
      ]); 
		}

    

   public function editAction($id = null)  
    {  
        if(!isset($id)) {  
            die("Missing id");  
        }  

        $question = $this->questions->find($id);  

        $this->views->add('question/edit', [  
						'content' => $question[0]->content,
						'page' => $question[0]->page,
						'name' => $question[0]->name,
						'web' => $question[0]->web,
						'id' => $question[0]->id,
						'mail' => $question[0]->mail,
        ]);  
    }  

    public function saveAction()  
    {  
        if(!$this->request->getPost('doSubmit'))  
        {  
            $this->response->redirect($this->request->getPost('redirect'));      
        }  

        $question = $this->questions->find($this->request->getPost('id'));
				$question = $question[0];
        $question->name = $this->request->getPost('name');  
        $question->mail = $this->request->getPost('mail');  
        $question->web = $this->request->getPost('web');  
        $question->content = $this->request->getPost('content');  
        $question->updated = date(DATE_RFC2822);  
        $question->timestamp = date(DATE_RFC2822); 
        $this->questions->save($question);  

        $this->response->redirect($this->url->create(''));  
    }  
		
    public function showAction($id = null)  
    {  
			$this->session();
      if(!isset($id)) {  
          die("Missing id");  
      }
			$answers = array();
			$answersdraft = $this->answers->query()
															 ->where("question = '$id'")
															 ->execute();

			
			foreach($answersdraft as $answer) {
				
				$answer = $answer->getProperties();
				
				$comments = $this->comments->query()
																	->where("type = 'answer'")
																  ->andWhere("linkid =" . $answer['id'])
																	->orderBy("created ASC")
																	->execute();
				$answer['comments'] = array();
				foreach($comments as $comment) {
					$answer['comments'][] = $comment;
				}
				
				$answers[] = $answer;
			}
			
	    $form = $this->form->create([], [
	        'content' => [
	            'type'        => 'textarea',
	            'label'       => '',
	            'validation'  => ['not_empty'],
	        ],
	        'submit' => [
	            'type'      => 'submit',
	            'callback'  => function ($form) {
	                return true;
	            }
	        ],
	       
	    ]);
		  // Check the status of the form
		     $status = $form->check();

		     if ($status === true) {
					 $now = date("Y-m-d H:i:s");
	         $this->answers->save([  
	             'content'   => $this->textFilter->doFilter($this->request->getPost('content'), 'shortcode, markdown'),  
	             'user'      => $_SESSION['user'],   
	             'question' => $id,
							 'created' => $now
	         ]); 
							 $this->redirectTo($this->url->create('questions/show/' . $id));
					
		     } else if ($status === false) {
					 	
		     }
			

			
      $question = $this->questions->find($id);
	    
			$comment = $this->comments->query()
																->where("type = 'question'")
																->andWhere("linkid =" . $id)
																->orderBy("created ASC")
																->execute();
			
			
			
			$this->theme->setTitle('#' . $question[0]->id . ' ' . $question[0]->title);  
      $this->views->add('question/list-one', [   
              'question' => $question[0],
							'comments' => $comment,
							'answers' => $answers,
							'form'  => $form->getHTML()
							
      ]);  
    }  
}   
