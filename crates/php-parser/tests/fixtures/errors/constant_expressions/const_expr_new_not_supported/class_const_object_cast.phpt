===source===
<?php
class C {
    const E = (object) [];
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
                "ClassConst": {
                  "name": {
                    "name": "E",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Cast": [
                        "Object",
                        {
                          "kind": {
                            "Array": []
                          },
                          "span": {
                            "start": 39,
                            "end": 41
                          }
                        }
                      ]
                    },
                    "span": {
                      "start": 30,
                      "end": 41
                    }
                  },
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
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
