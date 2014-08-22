=== EDD - Status Board ===
Contributors: cklosows
Tags: status board, panic, easy digital downloads, edd, ios, ipad
Requires at least: 3.0
Tested up to: 3.5.1
Stable tag: 1.1.2
Donate link: https://wp-push.com/donations/
License: GPLv2 or later

Integrate the Easy Digital Downloads API with the Status Board iPad app from Panic.

== Description ==

EDD - Status Board Integrates the Easy Digital Downloads API with the Status Board iPad app.

Using your Easy Digital Downloads API Key and Tokens, you can display 3 different bar graphs:

* Last 7 days sales
* Last 7 days earnings
* A Hybrid of last 7 days sales & earnings

= The URL endpoints are =
* http://yoursite.com/edd-api/sbsales/?key=[your key]&token=[your token]
* http://yoursite.com/edd-api/sbearnings/?key=[your key]&token=[your token]
* http://yoursite.com/edd-api/sbhybrid/?key=[your key]&token=[your token]
* http://yoursite.com/edd-api/sbcommissions/?key=[your key]&token=[your token]

You can manually add them to Status Board, or use the buttons located in the Profile page of wp-admin to automatically add the graphs (as seen in Screenshot 2).

**This plugin requires Easy Digital Downloads version 1.5.2 or greater.**

= The following filters exist =
* edd_statusboard_graph_type - Alters the type of graph, bar or line. (Default: bar)
* edd_statusboard_sales_color - Alters the color of the sales bar graphs. (Default: orange)
* edd_statusbaord_earnings_prefix - Alters the prefix of earnings amounts. (Default: $)
* edd_statusbaord_earnings_suffix - Alters the suffix of earnings amounts (Default: blank)
* edd_statusboard_earnings_color - Alters the color of the earnings bar graphs (Default: green)
* edd_statusboard_date_format - Alter the date format of the X-Axis. (Default: n/j or, month/day, uses PHP date formatting)

== Installation ==

1. Install the EDD - Status Board plugin
2. Activate the plugin
3. Generate your API Key and Token from Your Profile in WP-Admin
4. Add one of the API Endpoints to your Status Board.
5. Enjoy Status Board Updates for your Easy Digital Download Site


== Changelog ==
= 1.1.2 =
* NEW: Solo graphs of Sales and Earnings now contain running total

= 1.1.1 =
* FIX: Reverse Array to show dates in oldest to newest (LTR)
* FIX: Show button for commissions graph when user has api keys, even if option for users to generate keys is disabled

= 1.1 =
* Adding support for commissions

= 1.0 =
* Initial Release

== Frequently Asked Questions ==

= Do I have to buy the app for iOS for iPad =

Yes, this plugin requires that you buy the Status Board application by Panic. Their app is only available for iPad. You can download it directly from the App Store:
https://itunes.apple.com/us/app/status-board/id449955536?mt=8

== Screenshots ==
1. View of the Hybrid Graph
2. The settings available from the Profile page
