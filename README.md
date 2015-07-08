Rkt_SbCache - Magento Extension
=================================

Magento Extension that will allow to cache CMS Blocks aka Static Blocks

Description
------------

By default, Magento is not cacheing CMS Blocks. But in almost all stores, there is a huge chance to use a bunch of CMS Blocks. So cacheing static blocks become important in that case for better page load performance.

This module will fill this gap. This module enable us to cache static blocks uniquely. That is for each static blocks, this will use a unique cache key. Default cache time is set to the default cache life time of Magento (ie 2 hrs).

Theory
-------

This module register an observer for the event `core_block_abstract_to_html_before` and through this observer, if a static block is present, it will generate a unique cahche key for that block.

Advantages
------------

- No core hack
- No rewrites

Support
-------
If you encounter any problems or bugs, please create an issue on
[GitHub](https://github.com/progammer-rkt/Rkt_SbCache/issues).

Contribution
------------
Any contribution is highly welcome. The best possibility to provide any code is to open
a [pull request on GitHub](https://help.github.com/articles/using-pull-requests).