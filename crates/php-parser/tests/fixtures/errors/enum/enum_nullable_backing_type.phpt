===source===
<?php
enum E: ?int implements I { case A = 1; }
function f() {}
===errors <=8.0===
'enums' requires PHP 8.1 or higher
Enum backing type must be int or string, ?int given
===errors >=8.1===
Enum backing type must be int or string, ?int given
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'E' (T_STRING) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected identifier "E" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Enum backing type must be int or string, ?int given in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "E",
            "span": {
              "start": 11,
              "end": 12
            }
          },
          "scalar_type": null,
          "invalid_scalar_type": {
            "kind": {
              "Nullable": {
                "kind": {
                  "Named": {
                    "parts": [
                      "int"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 15,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 15,
                  "end": 18
                }
              }
            },
            "span": {
              "start": 14,
              "end": 18
            }
          },
          "implements": [
            {
              "parts": [
                "I"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 30,
                "end": 31
              }
            }
          ],
          "members": [
            {
              "kind": {
                "Case": {
                  "name": {
                    "name": "A",
                    "span": {
                      "start": 39,
                      "end": 40
                    }
                  },
                  "value": {
                    "kind": {
                      "Int": 1
                    },
                    "span": {
                      "start": 43,
                      "end": 44
                    }
                  },
                  "attributes": []
                }
              },
              "span": {
                "start": 34,
                "end": 45
              }
            }
          ],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 47
      }
    },
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 57,
              "end": 58
            }
          },
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 48,
        "end": 63
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63
  }
}
