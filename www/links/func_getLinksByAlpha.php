<?php

function getLinksByAlpha() {
	$p = new Template('link-page');
	$s = new Template('link-section');
	$i = new Template('link-item');

	$p->set_value('sub-title','By Alphanumeric');

	$db = new DBp();
	
	$sql = "SELECT link.id as id, link.url as url, link.title as title, link.description as description, link.created as created, link.hits as hits, cat.title as category ";
	$sql.= "FROM sitelinks as link, sitelinkcats as cat ";
	$sql.= "WHERE link.category=cat.id ";
	$sql.= "ORDER BY title";
	$db->query($sql);

	$sections = "";
	$links = "";
	$last_cat = "";
	while($db->next_record()) {
		if($last_cat != strtoupper(substr($db->f("title"),0,1))) {
			if($links != "") {
				$s->set_value("the-links",$links);
				$links = "";
				$sections .= $s->render();
			}
			$s->set_value("title", strtoupper(substr($db->f("title"),0,1)));
			$last_cat = strtoupper(substr($db->f("title"),0,1));
		}
		$i->set_value("id",$db->f("id"));
		$i->set_value("url",$db->f("url"));
		$i->set_value("title",$db->f("title"));
		$i->set_value("description",$db->f("description"));
		$i->set_value("created",$db->f("created"));
		$i->set_value("hits",$db->f("hits"));
		$i->set_value("category",$db->f("category"));

		$links .= $i->render();
	}

	if($links != "") {
		$s->set_value("the-links",$links);
		$sections .= $s->render();
	}

	$p->set_value("the-sections",$sections);
	return $p->render();
}
?>