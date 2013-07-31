var casper = require('casper').create({
                                clientScripts: ["includes/jquery-1.10.2.min.js"],
                                viewportSize: {
                                                width: _viewPortW,
                                                height: _viewPortW
                                            }
                            });

var x = require('casper').selectXPath;