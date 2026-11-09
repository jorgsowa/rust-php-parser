===source===
<?php
enum F { case X = 1 << 2; }
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Case X of non-backed enum F must not have a value
===errors >=8.1===
Case X of non-backed enum F must not have a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'F' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "F" in Standard input code on line 2
===php_error 8.1===
PHP Fatal error:  Case X of non-backed enum F must not have a value, try adding ": int" to the enum declaration in Standard input code on line 2
===php_error >=8.2===
PHP Fatal error:  Case X of non-backed enum F must not have a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "F",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "X",
                    "span": {
                      "start": 20,
                      "end": 21
                    }
                  },
                  "value": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 24,
                            "end": 25
                          }
                        },
                        "op": "ShiftLeft",
                        "right": {
                          "kind": {
                            "Int": 2
                          },
                          "span": {
                            "start": 29,
                            "end": 30
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 24,
                      "end": 30
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 15,
                "end": 31
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 33
  }
}
