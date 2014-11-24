<?php 

require __DIR__.'/config_with_app.php'; 

$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_me.php');
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);
$app->router->add('', function() use ($app) {
	$app->theme->setTitle("Startsida");
	
	$content = $app->fileContent->get('start.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	$app->dispatcher->forward([
	        'controller' => 'questions',
	        'action' => 'toplist',

	    ]);
			 
			$content = "Populära taggar och mest aktiva användare";
			$app->dispatcher->forward([
			        'controller' => 'questions',
			        'action' => 'toptaglist',

			    ]);
	
});

$app->router->add('fragor', function() use ($app) {
	$app->theme->setTitle("Frågor");
	
	
	$app->dispatcher->forward([
	        'controller' => 'questions',
	        'action' => 'list',

	    ]);

});
 
$app->router->add('taggar', function() use ($app) {
	$app->session();
 	$app->theme->setTitle("Taggar");
	
	$app->dispatcher->forward([
	        'controller' => 'questions',
	        'action' => 'listTags',

	    ]);
	
});

$app->router->add('anvandare', function() use ($app) {

 	$app->theme->setTitle("Användare");
	$app->dispatcher->forward([
	        'controller' => 'users',
	        'action' => 'list',

	    ]);

});

$app->router->add('om', function() use ($app) {

 	$app->theme->setTitle("Om");
	$content = $app->fileContent->get('om.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	//add($template, $data = [], $region = 'main', $sort = 0)
	
	$app->views->add('me/page', [
		'content' => $content
	]);

});

$app->router->add('minsida', function() use ($app) {

 	$app->theme->setTitle("Min Sida");
	if($app->session->get('user')){
		$app->dispatcher->forward([
		        'controller' => 'users',
		        'action' => 'status',

		    ]);
	}

	else {
		$app->dispatcher->forward([
		        'controller' => 'users',
		        'action' => 'login',

		    ]);
	}
	

});

// Test form route
// Test form route
$app->router->add('test1', function () use ($app) {
 $app->session();
 
    $form = $app->form->create([], [
        'name' => [
            'type'        => 'text',
            'label'       => 'Name of contact person:',
            'required'    => true,
            'validation'  => ['not_empty'],
        ],
        'email' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'email_adress'],
        ],
        'phone' => [
            'type'        => 'text',
            'required'    => true,
            'validation'  => ['not_empty', 'numeric'],
        ],
        'submit' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmit(): Form was submitted. Do stuff (save to database) and return true (success) or false (failed processing form)</i></p>");
                $form->AddOutput("<p><b>Name: " . $form->Value('name') . "</b></p>");
                $form->AddOutput("<p><b>Email: " . $form->Value('email') . "</b></p>");
                $form->AddOutput("<p><b>Phone: " . $form->Value('phone') . "</b></p>");
                $form->saveInSession = true;
                return true;
            }
        ],
        'submit-fail' => [
            'type'      => 'submit',
            'callback'  => function ($form) {
                $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
                return false;
            }
        ],
    ]);
	  // Check the status of the form
	     $status = $form->check();
 
	     if ($status === true) {
 
	         // What to do if the form was submitted?
	         $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
	         $app->redirectTo();
 
	     } else if ($status === false) {
 
	         // What to do when form could not be processed?
	         $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
	         $app->redirectTo();
	     }
			 
	     $app->theme->setTitle("Welcome to Anax");
	     $app->views->add('default/page', [
	         'title' => "Try out a form using CForm",
	         'content' => $form->getHTML()
	     ]);
 
	 });
	 
	 $app->router->add('kmom04', function() use ($app) {
 				$app->theme->setTitle("Kmom04");
				
 	     $app->views->add('users/start', []);
 
	     
	});
	
 $app->router->add('add', function() use ($app) {
				$app->theme->setTitle("Lägg till användare");
				
			  $app->session();
 
			     $form = $app->form->create([], [
			         'acronym' => [
			             'type'        => 'text',
			             'label'       => 'Acronym:',
			             'required'    => true,
			             'validation'  => ['not_empty'],
			         ],
			         'submit' => [
			             'type'      => 'submit',
			             'callback'  => function ($form) {

			                 $form->AddOutput("<p><b>Acronym: " . $form->Value('acronym') . "</b></p>");
			                 $form->saveInSession = true;
			                 return true;
			             }
			         ],
			         'submit-fail' => [
			             'type'      => 'submit',
			             'callback'  => function ($form) {
			                 $form->AddOutput("<p><i>DoSubmitFail(): Form was submitted but I failed to process/save/validate it</i></p>");
			                 return false;
			             }
			         ],
			     ]);
			 	  // Check the status of the form
			 	     $status = $form->check();
 
			 	     if ($status === true) {
 
			 	         // What to do if the form was submitted?
			 	         $form->AddOUtput("<p><i>Form was submitted and the callback method returned true.</i></p>");
				 		    $url = $app->url->create('users/add/' . $form->value('acronym'));
								 
		
			 	         $app->response->redirect($url);
 
			 	     } else if ($status === false) {
 
			 	         // What to do when form could not be processed?
			 	         $form->AddOutput("<p><i>Form was submitted and the Check() method returned false.</i></p>");
			 	         $app->redirectTo();
			 	     }
						 
			 	     $app->views->add('users/add', [
			 	         'title' => "Try out a form using CForm",
			 	         'content' => $form->getHTML()
			 	     ]);

     
});
	 
	 $app->router->add('setup', function() use ($app) {
 				$app->theme->setTitle("Db");
				
			  $app->dispatcher->forward([
			      'controller' => 'Users',
			      'action'     => 'setup'
			  ]);
 
	     
	});
 
 $app->router->add('test2', function() use ($app) {
				$app->theme->setTitle("Db");
				
			  $app->dispatcher->forward([
			      'controller' => 'Users',
			      'action'     => 'list'
			  ]);

     	 
});
$app->router->handle();
$app->theme->render();