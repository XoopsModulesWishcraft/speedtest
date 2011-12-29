CREATE TABLE `speedtest` (
	`id` bigint(13) unsigned NOT NULL auto_increment,
	`uid` int(12) unsigned default '0',
	`ip` int(11) NOT NULL default '0',
	`ip_string` varchar(64) NOT NULL default '',
	`timestamp` datetime NOT NULL default '0000-00-00 00:00:00',
	`downspeed` varchar(15) NOT NULL default '',
	`upspeed` varchar(15) NOT NULL default '',
	PRIMARY KEY  (`id`)
) ;