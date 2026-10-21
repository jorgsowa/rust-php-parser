===source===
<?php
new class { abstract public $p { get; } };
===errors===
Class class@anonymous contains 1 abstract method and must therefore be declared abstract or implement the remaining method (class@anonymous::$p::get)
===php_error <=8.1===
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.2===
Cannot load Xdebug - it was already loaded
PHP Parse error:  syntax error, unexpected token "{", expecting "," or ";" in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the abstract modifier on a property in Standard input code on line 2
===php_error 8.4===
PHP Fatal error:  Class class@anonymous contains 1 abstract method and must therefore be declared abstract or implement the remaining methods (class@anonymous::$p::get) in Standard input code on line 2
===php_error >=8.5===
PHP Fatal error:  Class class@anonymous must implement 1 abstract method (class@anonymous::$p::get) in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "New": {
              "class": {
                "kind": {
                  "AnonymousClass": {
                    "name": null,
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [
                      {
                        "kind": {
                          "Property": {
                            "name": {
                              "name": "p",
                              "span": {
                                "start": 34,
                                "end": 36
                              }
                            },
                            "modifiers": {
                              "visibility": "Public",
                              "is_abstract": true
                            },
                            "type_hint": null,
                            "default": null,
                            "attributes": [],
                            "hooks": [
                              {
                                "kind": "Get",
                                "body": "Abstract",
                                "by_ref": false,
                                "params": [],
                                "attributes": [],
                                "span": {
                                  "start": 39,
                                  "end": 43
                                }
                              }
                            ]
                          }
                        },
                        "span": {
                          "start": 18,
                          "end": 45
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 47
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 47
          }
        }
      },
      "span": {
        "start": 6,
        "end": 48
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 48
  }
}
