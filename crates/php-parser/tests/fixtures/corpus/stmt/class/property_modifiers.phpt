===source===
<?php
class Test {
    final public $prop;
    readonly int $prop;
    private static $prop;
}
===errors 8.2-8.3===
'final properties' requires PHP 8.4 or higher
Cannot redeclare Test::$prop
Cannot redeclare Test::$prop
===errors >=8.4===
Cannot redeclare Test::$prop
Cannot redeclare Test::$prop
===php_error <=8.2===
PHP Fatal error:  Cannot declare property Test::$prop final, the final modifier is allowed only for methods, classes, and class constants in Standard input code on line 3
===php_error 8.3===
PHP Fatal error:  Cannot use the final modifier on a property in Standard input code on line 3
===php_error >=8.4===
PHP Fatal error:  Cannot redeclare Test::$prop in Standard input code on line 4
===ast >=8.2===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "Test",
            "span": {
              "start": 12,
              "end": 16
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
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 36,
                      "end": 41
                    }
                  },
                  "modifiers": {
                    "visibility": "Public",
                    "is_final": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 23,
                "end": 41
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 60,
                      "end": 65
                    }
                  },
                  "modifiers": {
                    "is_readonly": true
                  },
                  "type_hint": {
                    "kind": {
                      "Named": {
                        "parts": [
                          "int"
                        ],
                        "kind": "Unqualified",
                        "span": {
                          "start": 56,
                          "end": 59
                        }
                      }
                    },
                    "span": {
                      "start": 56,
                      "end": 59
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 47,
                "end": 65
              }
            },
            {
              "kind": {
                "Property": {
                  "name": {
                    "name": "prop",
                    "span": {
                      "start": 86,
                      "end": 91
                    }
                  },
                  "modifiers": {
                    "visibility": "Private",
                    "is_static": true
                  },
                  "type_hint": null,
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 71,
                "end": 91
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 94
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 94
  }
}
