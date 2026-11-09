===source===
<?php
class C {
    public ?static $a;
}
===errors <=7.4===
'static type' requires PHP 8.0 or higher
static cannot be used as a property type
===errors >=8.0===
static cannot be used as a property type
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "static" in Standard input code on line 3
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
                    "name": "a",
                    "span": {
                      "start": 35,
                      "end": 37
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
                              "static"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 28,
                              "end": 34
                            }
                          }
                        },
                        "span": {
                          "start": 28,
                          "end": 34
                        }
                      }
                    },
                    "span": {
                      "start": 27,
                      "end": 34
                    }
                  },
                  "default": null,
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 37
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 40
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40
  }
}
