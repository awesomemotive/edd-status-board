=== EDD - Status Board ===
Contributors: easydigitaldownloads, cklosows, mordauk
Tags: status board, panic, easy digital downloads, edd, ios, ipad
Requires at least: 3.0
Tested up to: 5.7
Stable tag: 1.1.8
License: GPLv2 or later

Integrate the Easy Digital Downloads API with the Status Board iPad app from Panic.

== Description ==

EDD - Status Board Integrates the Easy Digital Downloads API with the Status Board iPad app.

**Please note:** The Status Board app has been discontinued and is no longer available. If you already own it, this extension should work with it, but this extension will not be updated in the future.

Using your Easy Digital Downloads API Key and Tokens, you can display 3 different bar graphs:

* Last 7 days sales
* Last 7 days earnings
* A Hybrid of last 7 days sales & earnings

= The URL endpoints are =
* http://example.org/edd-api/sbsales/?key=apikey&token=usertoken
* http://example.org/edd-api/sbearnings/?key=apikey&token=usertoken
* http://example.org/edd-api/sbhybrid/?key=apikey&token=usertoken
* http://example.org/edd-api/sbcommissions/?key=apikey&token=usertoken
* http://example.org/edd-api/sbstorecommissions/?key=apikey&token=usertoken

You can manually add them to Status Board, or use the buttons located in the Profile page of wp-admin to automatically add the graphs (as seen in Screenshot 2).

**This plugin requires Easy Digital Downloads version 2.4 or greater.**

= The following filters exist =
* edd_statusboard_graph_type - Alters the type of graph, bar or line. (Default: bar)
* edd_statusboard_sales_color - Alters the color of the sales bar graphs. (Default: orange)
* edd_statusbaord_earnings_prefix - Alters the prefix of earnings amounts. (Default: $)
* edd_statusbaord_earnings_suffix - Alters the suffix of earnings amounts (Default: blank)
* edd_statusboard_earnings_color - Alters the color of the earnings bar graphs (Default: green)
* edd_statusboard_date_format - Alter the date format of the X-Axis. (Default: n/j or, month/day, uses PHP date formatting)
* edd_statusboard_scale - By default Status Board auto scales based on the numbers in the data (thousands, millions, etc). You can set this via the filter (Default: 1, no scaling). A value of 0 will enable auto scaling.

== Installation ==

1. Install the EDD - Status Board plugin
2. Activate the plugin
3. Generate your API Key and Token from Your Profile in WP-Admin
4. Add one of the API Endpoints to your Status Board.
5. Enjoy Status Board Updates for your Easy Digital Download Site


== Changelog ==
= 1.1.8 =
* FIX: Make compatible with PHP 7.1

= 1.1.7 =
* NEW: URL parameter for days for user commissions and store commissions
* NEW: Requires EDD 2.4+
* FIX: Undefined $user_id in user profile
* FIX: Bad permissions checks for user profile
* FIX: Fixed store commissions and user commissions data
* TWEAK: Removed old EDD support
* TWEAK: Commissions graph now is reflective of all commissions earned for a day, even paid commissions.
* TWEAK: Use commissions's new functions for commissions by day for more accurate calculations
* TWEAK: Added new commission sales by day function for more accurate calculations
* UPDATED: Translations

= 1.1.6 =
* FIX: Spelling error in settings
* FIX: Changed URLs in readme to be example.org
* UPDATED: Translations

= 1.1.5 =
* NEW: Forces a scale of 1, to avoid "(Thousands)" from auto scaling the graphs. Filter added to allow setting the scale or auto scaling.

= 1.1.4 =
* NEW: Endpoint for store-wide unpaid commissions

= 1.1.3 =
* FIX: Update to support the new EDD Commissions output method name (backwards compatible with the old method name sitll);

= 1.1.2 =
* NEW: Solo graphs of Sales and Earnings now contain running total

= 1.1.1 =
* FIX: Reverse Array to show dates in oldest to newest (LTR)
* FIX: Show button for commissions graph when user has api keys, even if option for users to generate keys is disabled

= 1.1 =
* Adding support for commissions

= 1.0 =
* Initial Release

== Screenshots ==
1. View of the Hybrid Graph
2. The settings available from the Profile page
