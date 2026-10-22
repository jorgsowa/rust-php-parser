===source===
<?php
new class { final private $x; };
===errors <=8.3===
Property cannot be both final and private
'final properties' requires PHP 8.4 or higher
===errors >=8.4===
Property cannot be both final and private
===php_error <=8.0===
PHP Fatal error:  Cannot declare property class@anonymous::$x final, the final modifier is allowed only for methods and classes in Standard input code on line 2
===php_error 8.1-8.2===
PHP Fatal error:  Cannot declare property class@anonymous::$x final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 2
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Property cannot be both final and private in Standard input code on line 2
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
                              "name": "x",
                              "span": {
                                "start": 32,
                                "end": 34
                              }
                            },
                            "modifiers": {
                              "visibility": "Private",
                              "is_final": true
                            },
                            "type_hint": null,
                            "default": null,
                            "attributes": []
                          }
                        },
                        "span": {
                          "start": 18,
                          "end": 34
                        }
                      }
                    ],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 37
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 6,
            "end": 37
          }
        }
      },
      "span": {
        "start": 6,
        "end": 38
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 38
  }
}
