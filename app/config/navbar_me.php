<?php
/**
 * Config-file for navigation bar.
 *
 */
return [

    // Use for styling the menu
    'class' => 'navbar',
 
    // Here comes the menu strcture
    'items' => [

        // This is a menu item
        'home'  => [
            'text'  => 'Start',   
            'url'   => '',  
            'title' => 'Startsida'
        ],
				
        // This is a menu item
        'fragor' => [
            'text'  =>'Frågor', 
            'url'   =>'fragor',  
            'title' => 'Frågor'
        ],
				
        'taggar' => [
            'text'  =>'Taggar', 
            'url'   =>'taggar',  
            'title' => 'Taggar'
        ],
				
        'anvandare' => [
            'text'  =>'Användare', 
            'url'   =>'anvandare',  
            'title' => 'Användare'
        ],
				
        'minsida' => [
            'text'  =>'Min Sida', 
            'url'   =>'minsida',  
            'title' => 'Min Sida'
        ],
				
        'om' => [
            'text'  =>'Om', 
            'url'   =>'om',  
            'title' => 'Om'
        ],
				
        'setup'  => [
            'text'  => 'Återställning',   
            'url'   => 'setup',  
            'title' => 'Setup'
        ],
				
				
				
        /*This is a menu item
        'kmom04'  => [
            'text'  => 'Kmom04',   
            'url'   => 'kmom04',   
            'title' => 'Kmom04',

            // Here we add the submenu, with some menu items, as part of a existing menu item
            'submenu' => [

                'items' => [

                    // This is a menu item of the submenu
                    

                    // This is a menu item of the submenu
                    'add'  => [
                        'text'  => 'Lägg till',   
                        'url'   => 'add',  
                        'title' => 'Lägg till användare'
                    ],
										
                    'aktiva'  => [
                        'text'  => 'Visa Aktiva',   
                        'url'   => 'users/active',  
                        'title' => 'Visa aktiva'
                    ],
										
                    'inaktiva'  => [
                        'text'  => 'Visa Inaktiva',   
                        'url'   => 'users/inActive',  
                        'title' => 'Visa inaktiva'
                    ],
										
                    'papperskorgen'  => [
                        'text'  => 'Papperskorgen',   
                        'url'   => 'users/trash',  
                        'title' => 'Papperskorgen'
                    ],
										
                    'all'  => [
                        'text'  => 'Visa Alla',   
                        'url'   => 'users/list',  
                        'title' => 'Visa alla användare'
                    ],
                ],
            ],
        ],*/
				
    ],
 
    // Callback tracing the current selected menu item base on scriptname
    'callback' => function($url) {
        if ($url == $this->di->get('request')->getRoute()) {
            return true;
        }
    },

    // Callback to create the urls
    'create_url' => function($url) {
        return $this->di->get('url')->create($url);
    },
];
