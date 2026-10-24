===source===
<?php
trait T {
    const A = __CLASS__ ?? $x;
}
===errors <=8.1===
'constants in traits' requires PHP 8.2 or higher
Constant expression contains invalid operations
===errors >=8.2===
Constant expression contains invalid operations
===php_error <=8.1===
PHP Fatal error:  Traits cannot have constants in Standard input code on line 3
===php_error >=8.2===
PHP Fatal error:  Constant expression contains invalid operations in Standard input code on line 3
===ast===
{
  "stmts": [
    {
      "kind": {
        "Trait": {
          "name": {
            "name": "T",
            "span": {
              "start": 12,
              "end": 13
            }
          },
          "members": [
            {
              "kind": {
                "ClassConst": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "NullCoalesce": {
                        "left": {
                          "kind": {
                            "MagicConst": "Class"
                          },
                          "span": {
                            "start": 30,
                            "end": 39
                          }
                        },
                        "right": {
                          "kind": {
                            "Variable": "x"
                          },
                          "span": {
                            "start": 43,
                            "end": 45
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 45
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 46
              }
            }
          ],
          "attributes": []
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
