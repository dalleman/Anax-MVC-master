<?php 

require __DIR__.'/config_with_app.php'; 

$app->theme->configure(ANAX_APP_PATH . 'config/theme_grid.php');
$app->navbar->configure(ANAX_APP_PATH . 'config/navbar_theme.php');
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

$app->router->add('', function() use ($app) {
	$app->theme->setTitle("Tema");
	
	$content = $app->fileContent->get('tema.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');

	$app->views->add('me/page', [
		'content' => $content,
	]);
 
});

$app->router->add('regioner', function() use ($app) {
 
    $app->theme->setTitle("Regioner");
 
    $app->views->addString('flash', 'flash')
               ->addString('featured-1', 'featured-1')
               ->addString('featured-2', 'featured-2')
               ->addString('featured-3', 'featured-3')
               ->addString('main', 'main')
               ->addString('sidebar', 'sidebar')
               ->addString('footer', 'footer');
 
});

$app->router->add('typografi', function() use ($app) {
	$app->theme->setTitle("Typografi");
	
	$content = $app->fileContent->get('horisontell.md');
	$content = $app->textFilter->doFilter($content, 'shortcode, markdown');
	
	$app->views->add('me/page', [
		'content' => $content,
	]);
	
	$app->views->addString($content, 'sidebar');
	
 
});
 
$app->router->handle();
$app->theme->render();