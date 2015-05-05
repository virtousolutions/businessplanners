-- phpMyAdmin SQL Dump
-- version 4.0.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2014 at 06:03 AM
-- Server version: 5.5.34-0ubuntu0.13.10.1
-- PHP Version: 5.5.3-1ubuntu2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageid`, `parentid`, `pageurl`, `pagetitle`, `pageorder`, `page_content`) VALUES
(1, 0, 'home', 'Welcome home', 1, ''),
(2, 1, 'executive-summary', 'Executive Summary', 1, ''),
(3, 2, 'who-we-are ', 'Who We Are', 1, ''),
(4, 2, 'what-we-sell', 'What We Sell', 2, ''),
(5, 2, 'who-we-sell-to', 'Who We Sell To', 3, ''),
(6, 2, 'financial-summary', 'Financial Summary', 4, ''),
(7, 1, 'company', 'Company', 2, ''),
(8, 7, 'company-overview', 'Company Overview', 1, ''),
(9, 7, 'management-team', 'Management Team', 2, ''),
(10, 0, 'error-page', 'Error Page', 0, ''),
(11, 1, 'products-and-services', 'Products and Services', 3, ''),
(12, 11, 'products-and-services-c', 'Products and Services', 1, ''),
(13, 11, 'competitors', 'Competitors', 2, ''),
(14, 1, 'target-market', 'Target Market', 4, ''),
(16, 14, 'market-overview', 'Market Overview', 1, ''),
(17, 14, 'market-needs', 'Market Needs', 2, ''),
(18, 1, 'strategy-and-implementation', 'Strategy and Implementation', 5, ''),
(26, 25, 'sales-forecast', 'Sales Forecast', 1, ''),
(25, 1, 'financial-plan', 'Financial Plan', 6, ''),
(24, 18, 'milestones', 'Milestones', 2, ''),
(23, 18, 'marketing', 'Marketing', 1, ''),
(27, 25, 'human-resources', 'Human Resources', 2, ''),
(28, 25, 'budget', 'Budget', 3, ''),
(31, 30, 'sales-forecast-delete', 'Sales Forecast delete', 1, ''),
(32, 30, 'personnel-plan-delete', 'Personnel Plan delete', 2, ''),
(33, 30, 'budget-delete', 'Budget delete', 3, ''),
(39, 11, 'product-and-service-development', 'Product & Service Development', 3, ''),
(40, 11, 'sourcing-and-fulfillment', 'Sourcing and Fulfillment', 4, ''),
(41, 11, 'technology', 'Technology', 5, ''),
(42, 11, 'intellectual-property', 'Intellectual Property', 6, ''),
(43, 14, 'market-trends', 'Market Trends', 3, ''),
(44, 14, 'market-growth', 'Market Growth', 4, ''),
(45, 14, 'industry-analysis', 'Industry Analysis', 5, ''),
(46, 14, 'key-customers', 'Key Customers', 6, ''),
(36, 7, 'locations-and-facilities', 'Locations and Facilities', 3, ''),
(37, 7, 'mission-statement', 'Mission Statement', 4, ''),
(38, 7, 'company-history', 'Company History', 5, ''),
(47, 18, 'swot-analysis', 'SWOT Analysis', 3, ''),
(48, 18, 'competitive-edge', 'Competitive Edge', 4, ''),
(49, 18, 'promotional-activity', 'Promotional Activity', 5, ''),
(50, 18, 'sales-administration', 'Sales Administration', 6, ''),
(51, 18, 'sales-plan', 'Sales Plan', 7, ''),
(52, 18, 'strategic-alliances', 'Strategic Alliances', 8, ''),
(53, 18, 'exit-strategy', 'Exit Strategy', 9, ''),
(54, 25, 'cash-flow-projections', 'Cash Flow Projections', 4, ''),
(55, 25, 'loans-and-investments', 'Loans and Investments', 4, ''),
(56, 1, 'financial-statements', 'Financial Statements', 7, ''),
(57, 56, 'profit-and-loss-statement', 'Profit and Loss Statement', 0, ''),
(58, 56, 'balance-sheet', 'Balance Sheet', 1, ''),
(59, 56, 'cash-flow-statement', 'Cash Flow Statement', 2, ''),
(60, 1, 'appendix', 'Appendix', 8, ''),
(61, 60, 'sales-forecast-apx', 'Sales Forecast', 0, ''),
(62, 60, 'personnel-plan-apx', 'Personnel Plan', 1, ''),
(63, 60, 'budget-apx', 'Budget', 2, ''),
(64, 60, 'loans-and-investments-apx', 'Loans and Investments', 3, ''),
(65, 60, 'profit-and-loss-statement-apx', 'Profit and Loss Statement', 4, ''),
(66, 60, 'balance-sheet-apx', 'Balance Sheet', 5, ''),
(67, 60, 'cash-flow-statement-apx', 'Cash Flow Statement', 6, '');

--
-- Truncate table before insert `page_sections`
--

TRUNCATE TABLE `page_sections`;
--
-- Dumping data for table `page_sections`
--

INSERT INTO `page_sections` (`section_id`, `s_pageid`, `section_order`, `section_desc`, `section_title`, `section_content`) VALUES
(1, 23, 0, 'An important part of how you market to your customers will be the pricing of your products or services. What will your customers pay? How did you come up with that price? Here are some things to think about:\r\n\r\n<ul>\r\n<li>	What is the cost to produce your product or the service you offer? </li>\r\n<li>   Will your selling price cover your production costs?</li>\r\n<li>	Will pricing be part of how you will position your company to the market?\r\n<ul>\r\n<li> Offering free or low-cost pricing as a promotion? </li>\r\n<li> Offering discounts to your loyal customers? </li>\r\n</ul>\r\n</li>\r\n<li> What will these promotions or discounts cost you?</li>\r\n<li> Does your pricing structure support that positioning message?</li>\r\n<li> How does your pricing structure relate to those of your main competitors and your industry in general?</li>\r\n</ul>', 'Pricing', ''),
(2, 23, 1, 'In this group (Marketing), you have decided where to position your business and how you compare to the competition. Then you decided on your product/service price structure and how this will support your position in the market. \r\n<br/><br/>\r\nThe next step is to decide on promotional activity your business will employ to get your products and services in front of your target market.\r\n<br/><br/>\r\nThink about the common traits of each customer group within your target market, which type of promotional activity is more likely to attract them to your company? This could include amongst other promotional disciplines;<br/>\r\n<br/><strong>Advertising</strong>\r\n<ul>\r\n<li>	Direct mail </li>\r\n<li>	Web site</li>\r\n<li>	E-mail marketing </li>\r\n<li>	Point of sale promotions</li>\r\n\r\n\r\nDoes that type of promotional activity match up to your product/service and your price structure? Does it fit the image of your business, but importantly can you afford it?</ul>\r\n', 'Promotion', ''),
(3, 23, 2, 'This will depend on the type of business you run, if you are supplying a product you may;<br/><br/>\r\n\r\n<ul>\r\n<li>	Sell direct to your customer?</li>\r\n<li>	Sell online or by mail order and then ship your orders direct from a storage location to the customer? </li>\r\n<li>	Sell your products through a retailer?</li>\r\nThese are examples of distribution = getting your products to your customers for sale.<br/><br/>\r\n\r\nIf your business supplies a service to a client or you are in a service industry – retail, leisure banking etc you will sell direct to your customers; no shipping or handling. <br/><br/>\r\n\r\nDepending on how many levels of distribution you have before your product reaches your customer, the price for your product/service will need to include the cost of distribution.  <br/><br/>\r\n\r\nWhat type of distribution do you need? What will it cost?\r\n</ul>', 'Distribution', ''),
(4, 47, 0, '<p>Start your SWOT analysis by describing the strongest aspects of your business. </p>\r\n<ul>\r\n<li>	What do you do best? </li>\r\n<li>	What unique or enviable resources do you have that give you a competitive advantage?</li>\r\n<li>	Right products, quality and reliability</li>\r\n<li>	Good location with client/customer parking</li>\r\n<li>	Management committed and confident</li>\r\n</ul>\r\n\r\n\r\n<p>Understanding your strengths will enable you to focus on them so you can maximize your advantages over your competitors.</p>\r\n<br/>\r\n<p>Remember, strengths aren''t always tangible things like equipment or investment finance. Less concrete assets are just as valuable, things like existing customer relationships, a reputation for quality and timeliness, or a strong knowledge of the market.', 'Strengths', ''),
(5, 47, 1, 'Acknowledging the weak points in your business is not in itself a sign of weakness but a signal that you are committed to improvement. Think about the missing ingredients that threaten to keep your business from reaching its full potential. </p>\r\n\r\n<ul>\r\n\r\n<li>	Do you have a sales staff but no prospect lists yet for them to call and sell to?</li> \r\n<li>	Are you just starting to build connections in the local market? </li>\r\n<li>	Do you have slower equipment or less advanced technology than others?</li> \r\n<li>	Is your business outgrowing its current space?</li> \r\n<li>	Do you still really need a finance person?</li> \r\n</ul>\r\n\r\n<p>Weak areas like this need to be identified and shored up, not glossed over. Weaknesses, like strengths, should be internal factors that are under your control. </p>\r\n\r\n<p>External market factors will be considered in opportunities and threats.\r\n', 'Weaknesses', ''),
(6, 47, 2, 'The focus shifts outward from your company to the market and customer base, to identify opportunities which could be of advantage to your company.</p>\r\n\r\n<ul>\r\n<li>	Local competitors have poor products</li>\r\n<li>	Could develop new product to solve unmet need</li>\r\n<li>	New specialist applications</li>\r\n<li>	Identify competitor short comings allowing a chance to innovate and outcompete</li>\r\n<li>	Client and customer base respond well to innovative new ideas</li>\r\n\r\n</ul>\r\n<p>Be sure to think about the timing for each opportunity. Is there an ongoing need or just a short window of opportunity? How critical is your timing?</p> \r\n<br/>\r\n<p>\r\nAlso, make sure that the opportunities you identify are indeed opportunities are not strengths. An opportunity is an external factor in the market that anyone could potentially exploit. Strengths are internal factors for your specific company. If you find internal factors mixed in with your opportunities, go ahead and move them into the strengths.\r\n', 'Opportunities', ''),
(7, 47, 3, 'To complete your SWOT analyses, identify the major outside threats to your business. The better you are at identifying threats, the better positioned you will be to respond to them.</p>\r\n\r\n<p>The world is full of threats, of course, especially potential ones. You can''t prepare for them all. Focus on those that are both realistic and close to your business;</p>\r\n<ul>\r\n<li>	Negative press coverage</li>\r\n<li>	changing consumer tastes,</li> \r\n<li>	The loss of a major contract. </li>\r\n<li>	Impact of changing legislation</li>\r\n<li>	Retention of key staff critical</li>\r\n</ul>\r\n\r\n<p>Also, remember that threats, like opportunities, should be external factors beyond your direct control. Any issues related to your company''s own capabilities should go in weaknesses.\r\n', 'Threats', ''),
(10, 55, 0, '<p>Describe your funding plans. What types of funding do you expect to receive and when? If you do not have the full detail of future financing worked out yet, that''s understandable. Just explain what you do know and when you expect to sort out the details. If you have no plans to get funding, or just think the Loans and Investments table is clear enough on its own, you can remove this text item in the Section Setup view.</p>', 'Sources of Funds', ''),
(9, 55, 1, '<p>If your plan includes loans, investments, or other funding, use this space to explain what you will do with that money. Will it help to cover operating costs as your business scales up? Will it finance major purchases? Will it enable you to add personnel or expand your marketing to increase sales? Give your reader a clear picture of why these funds are needed and how they will pay off. If you have no plans to get funding, you can remove this text item in the Section Setup view.</p>', 'Use of Funds', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
