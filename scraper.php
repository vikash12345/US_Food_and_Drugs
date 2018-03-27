<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful

require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';

		$link	=	'https://www.accessdata.fda.gov/scripts/SDA/sdNavigation.cfm?sd=clinicalinvestigatorsdisqualificationproceedings&previewMode=true&displayAll=true';
		$html	=	file_get_html($link);
		foreach($html->find("//*[@id='user_provided']/table/tbody/tr/td/table/tbody/tr[6]/td/div/table/tbody/tr") as $element)
		{
			$plink	=	$element->find("td/a",0)->href;
			$innerpage	=	'https://www.accessdata.fda.gov/scripts/SDA/'.$plink;
			$Inpage	=	file_get_html($innerpage);
			sleep(5);
			if($Inpage)
			{		
					//This is for Name
					$name			=	$Inpage->find("//td[plaintext^=Name:]", 0);
					if($name == null || $name == "")
					{
						$name	=	"Not Available";
					}
					else
					{
						$name	=	$name->next_sibling()->plaintext;
					}
					//This is for Center
					$center			=	$Inpage->find("//td[plaintext^=Center:]", 0);
					if($center == null || $center == "")
					{
						$center	=	"Not Available";
					}
					else
					{
						$center	=	$center->next_sibling()->plaintext;
					}
			
						
					//This is for City
					$city			=	$Inpage->find("//td[plaintext^=City:]", 0);
					if($city == null || $city == "")
					{
						$city	=	"Not Available";
					}
					else
					{
						$city	=	$city->next_sibling()->plaintext;
						
					}
			
				
				
					//This is for State
					$state			=	$Inpage->find("//td[plaintext^=State:]", 0);
					if($state == null || $state == "")
					{
						$state	=	"Not Available";
					}
					else
					{
						$state	=	$state->next_sibling()->plaintext;
						
					}
			
				
				
					//This is for Status
					$status			=	$Inpage->find("//td[plaintext^=Status:]", 0);
					if($status == null || $status == "")
					{
						$status	=	"Not Available";
					}
					else
					{
						$status	=	$status->next_sibling()->plaintext;
						
					}
			
				
				
				
					//This is for Date of status: 
					$dos			=	$Inpage->find("//td[plaintext^=Date of status:]", 0);
					if($dos == null || $dos == "")
					{
						$dos	=	"Not Available";
					}
					else
					{
						$dos	=	$dos->next_sibling()->plaintext;
						
					}
			
scraperwiki::save_sqlite(array('name'), array('name'=> $name,'center'=> $center,'city'=> $city,'state'=> $state,'status'=> $status,'dos'=> $dos,'innerpage'=> $innerpage,'link' => $link));

				
				
				 			
			
			}
			
			
		}



//https://www.accessdata.fda.gov/scripts/SDA/sdNavigation.cfm?sd=clinicalinvestigatorsdisqualificationproceedings&previewMode=true&displayAll=true

// // Read in a page
// $html = scraperwiki::scrape("http://foo.com");
//
// // Find something on the page using css selectors
// $dom = new simple_html_dom();
// $dom->load($html);
// print_r($dom->find("table.list"));
//
// // Write out to the sqlite database using scraperwiki library
// scraperwiki::save_sqlite(array('name'), array('name' => 'susan', 'occupation' => 'software developer'));
//
// // An arbitrary query against the database
// scraperwiki::select("* from data where 'name'='peter'")

// You don't have to do things with the ScraperWiki library.
// You can use whatever libraries you want: https://morph.io/documentation/php
// All that matters is that your final data is written to an SQLite database
// called "data.sqlite" in the current working directory which has at least a table
// called "data".
?>
