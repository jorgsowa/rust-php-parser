===source===
<?php
class A {
    function m(): int|\static {}
}
===errors <=7.4===
'union types' requires PHP 8.0 or higher
'reserved keyword in namespaced name' requires PHP 8.0 or higher
'\static' is an invalid class name
===errors 8.0-8.4===
'\static' is an invalid class name
===errors >=8.5===
Type declaration 'static' must be unqualified
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '|', expecting ';' or '{' in Standard input code on line 3
===php_error 8.0-8.4===
PHP Fatal error:  '\static' is an invalid class name in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Type declaration 'static' must be unqualified in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "A",
            "span": {
              "start": 12,
              "end": 13
            }
          },
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
                "Method": {
                  "name": {
                    "name": "m",
                    "span": {
                      "start": 29,
                      "end": 30
                    }
                  },
                  "by_ref": false,
                  "params": [],
                  "return_type": {
                    "kind": {
                      "Union": [
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "int"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 34,
                                "end": 37
                              }
                            }
                          },
                          "span": {
                            "start": 34,
                            "end": 37
                          }
                        },
                        {
                          "kind": {
                            "Named": {
                              "parts": [
                                "static"
                              ],
                              "kind": "FullyQualified",
                              "span": {
                                "start": 38,
                                "end": 45
                              }
                            }
                          },
                          "span": {
                            "start": 38,
                            "end": 45
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 34,
                      "end": 45
                    }
                  },
                  "body": [],
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 48
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 50
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 50
  }
}
