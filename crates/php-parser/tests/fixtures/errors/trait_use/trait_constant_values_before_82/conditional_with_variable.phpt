===source===
<?php
trait T {
    const X = __CLASS__ ? 1 : $a;
}
===errors <=8.1===
'constants in traits' requires PHP 8.2 or higher
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
                    "name": "X",
                    "span": {
                      "start": 26,
                      "end": 27
                    }
                  },
                  "value": {
                    "kind": {
                      "Ternary": {
                        "condition": {
                          "kind": {
                            "MagicConst": "Class"
                          },
                          "span": {
                            "start": 30,
                            "end": 39
                          }
                        },
                        "then_expr": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 42,
                            "end": 43
                          }
                        },
                        "else_expr": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 46,
                            "end": 48
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 30,
                      "end": 48
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 20,
                "end": 49
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 51
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 51
  }
}
