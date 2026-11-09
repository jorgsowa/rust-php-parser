===source===
<?php
class A {
    protected ?callable $d;
}
===errors===
Property A::$d cannot have type ?callable
===php_error <=7.4===
PHP Fatal error:  Property A::$d cannot have type callable in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Property A::$d cannot have type ?callable in Standard input code on line 3
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
                "Property": {
                  "name": {
                    "name": "d",
                    "span": {
                      "start": 40,
                      "end": 42
                    }
                  },
                  "modifiers": {
                    "visibility": "Protected"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "callable"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 31,
                              "end": 39
                            }
                          }
                        },
                        "span": {
                          "start": 31,
                          "end": 39
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 39
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 42
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 45
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 45
  }
}
