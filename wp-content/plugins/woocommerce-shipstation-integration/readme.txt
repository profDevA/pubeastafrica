=== WooCommerce ShipStation Gateway ===
Contributors: automattic, royho, akeda, mattyza, bor0, woothemes, dwainm, laurendavissmith001
Tags: shipping, woocommerce, automattic
Requires at least: 4.4
Tested up to: 5.1
Requires PHP: 5.6
Stable tag: 4.1.29
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

The official WooCommerce ShipStation plugin helps store owners integrate WooCommerce with ShipStation and expedite the shipping process.

== Description ==

ShipStation’s sophisticated automation features help you shave many hours off your fulfillment process. Print wirelessly and share your printer with ease thanks to ShipStation Connect. Run your business on-the-go with ShipStation Mobile, the industry’s only mobile app (free for iOS and Android) and do everything from creating orders to printing labels and emailing return labels all from your phone or tablet.

= Why choose ShipStation? =

ShipStation is a web-based shipping solution that streamlines the order fulfillment process for online retailers, handling everything from order import and batch label creation to customer communication. Advanced customization features allow ShipStation to fit businesses with any number of users or locations.

== Frequently Asked Questions ==

= Does ShipStation provide real-time shipping quotes that can be used at checkout? =

No. Store owners need a real-time shipping quote extension such as USPS, FedEx, UPS, etc. or have an alternate way to show shipping quotes (e.g., Flat rate charge).

= Does ShipStation send data when not being used (e.g., Free Shipping)? =

Yes, there isn’t conditional exporting. If the data is there, we export it!

= Why do multiple line items in an order on the WooCommerce side get combined when they reach ShipStation? =

This is most likely because unique Product SKUs have not been configured for each product and variation in the Store. To ensure that order line items show up correctly in ShipStation, we recommend assigning a unique SKU to each product as well as each variation within a product.

= Why do multiple line items in an order on the WooCommerce side get combined when they reach ShipStation? =

This is most likely because unique Product SKUs have not been configured for each product and variation in the Store. To ensure that order line items show up correctly in ShipStation, we recommend assigning a unique SKU to each product as well as each variation within a product.

= Where can I find documentation? =

For help setting up and configuring, please refer to our [user guide](https://docs.woocommerce.com/document/shipstation-for-woocommerce)

= Where can I get support or talk to other users? =

If you get stuck, you can ask for help in the Plugin Forum.

== Changelog ==

= 2019-08-12 - version 4.1.29 =
* Tweak - WC 3.7 compatibility.

= 2019-04-17 - version 4.1.28 =
* Tweak - WC 3.6 compatibility.

= 2019-01-07 - version 4.1.27 =
* Fix - Use product name from order instead of product itself.
* Fix - Prevent errors when WooCommerce isn't active.

[See changelog for all versions](https://raw.githubusercontent.com/woocommerce/woocommerce-shipstation/master/changelog.txt).
