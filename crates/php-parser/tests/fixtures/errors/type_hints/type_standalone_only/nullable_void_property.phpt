===source===
<?php
class C {
    public ?void $p;
}
===errors===
Void can only be used as a standalone type
===php_error <=7.4===
PHP Fatal error:  Property C::$p cannot have type void in Standard input code on line 3
===php_error >=8.0===
PHP Fatal error:  Void can only be used as a standalone type in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Class": {
          "name": {
            "name": "C",
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
                    "name": "p",
                    "span": {
                      "start": 33,
                      "end": 35
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": {
                    "kind": {
                      "Nullable": {
                        "kind": {
                          "Named": {
                            "parts": [
                              "void"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 28,
                              "end": 32
                            }
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 32
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 32
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 35
              }
            }
          ],
          "attributes": []
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
