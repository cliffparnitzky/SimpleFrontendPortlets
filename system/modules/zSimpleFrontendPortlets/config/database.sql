-- ********************************************************
-- *                                                      *
-- * IMPORTANT NOTE                                       *
-- *                                                      *
-- * Do not import this file manually but use the Contao  *
-- * install tool to create and maintain database tables! *
-- *                                                      *
-- ********************************************************

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `isSimpleFrontendPortlet` char(1) NOT NULL default '',
  `simpleFrontendPortletName` varchar(128) NOT NULL default '',
  `simpleFrontendPortletDescription` varchar(512) NOT NULL default ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

-- 
-- Table `tl_member`
-- 

CREATE TABLE `tl_member` (
  `visibleSimpleFrontendPortlets` blob NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 
