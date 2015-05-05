DROP TABLE IF EXISTS bp_pages;
CREATE TABLE bp_pages (
	id integer NOT NULL AUTO_INCREMENT,
	bp_id integer NOT NULL,
	pageid integer NOT NULL,
	page_content text,
	PRIMARY KEY (id)
       	/* 
	FOREIGN KEY (user_id) REFERENCES bp_users (user_id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
       	FOREIGN KEY (pageid) REFERENCES pages (pageid) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE
	*/
)ENGINE=InnoDB;

DROP TABLE IF EXISTS bp_user_page_sections;
CREATE TABLE bp_page_sections (
	id integer NOT NULL AUTO_INCREMENT,
	bp_id integer NOT NULL,
	section_id integer NOT NULL,
	section_content text,
	PRIMARY KEY (id)
	/*
	FOREIGN KEY (user_id) REFERENCES bp_users (user_id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
	FOREIGN KEY (section_id) REFERENCES page_sections (section_id) MATCH SIMPLE ON UPDATE CASCADE ON DELETE CASCADE,
	*/
)ENGINE=InnoDB;
