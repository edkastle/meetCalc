*******************
**  Create View  **
*******************

1) Create a view
	a) Create a .php file inside /app/views
	b) The website html will go in here

2) Create a route
	a) Create a .php file inside /app/routes
	b) Use the code to render the view	
	
		*******CODE********
		
					$app->get('/page_name', function() use ($app){
						$app->render('view_name.php');
					})->name('helper_name');
					
		******END CODE*****
		
		-> Change '/page_name' to the link you would want it to be
			ex) '/page_name' will link to www.Website.com/page_name
			ex) '/page_name/page_name' will link to www.Website.com/page_name/page_name
		-> Change 'view_name.php' to the vew file name you created on step 1
		-> Change 'helper_name' to the helper name you want when using {{ urlFor() }}
			ex) {{ urlFor('helper_name') }} will be /root/page_name

3) Include the new route into the /app/routes.php
	ex) require INC_ROOT . '/app/routes/file_name.php';