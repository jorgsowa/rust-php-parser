===source===
<?php
class C {
    public $f = (object) [];
}
===errors <=8.4===
'casts in constant expressions' requires PHP 8.5 or higher
===errors >=8.5===
Object casts are not supported in this context
===php_error <=8.4===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===php_error >=8.5===
PHP Fatal error:  Object casts are not supported in this context in Standard input code on line 3
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
                    "name": "f",
                    "span": {
                      "start": 27,
                      "end": 29
                    }
                  },
                  "modifiers": {
                    "visibility": "Public"
                  },
                  "type_hint": null,
                  "default": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 41,
                            "end": 43
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 32,
                      "end": 43
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 43
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
