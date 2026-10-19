===config===
min_php=8.4
===source===
<?php
new class { final private $x; };
===errors===
Property cannot be both final and private
===php_error===
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
