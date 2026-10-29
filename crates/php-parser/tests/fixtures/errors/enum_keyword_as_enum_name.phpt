===source===
<?php
enum static {}
===errors <=7.4===
expected ';' after expression
Cannot use 'static' as a standalone expression
expected expression, found '}'
expected ';', found '{'
expected ';' after expression
===errors 8.0===
expected ';' after expression
Cannot use 'static' as a standalone expression
expected expression, found '}'
Array and string offset access syntax with curly braces is no longer supported
expected ';' after expression
===errors >=8.1===
cannot use 'static' as enum name
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'static' (T_STATIC) in Standard input code on line 2
===php_error 8.0===
PHP Parse error:  syntax error, unexpected token "static" in Standard input code on line 2
===php_error >=8.1===
PHP Parse error:  syntax error, unexpected token "static", expecting identifier in Standard input code on line 2
===ast <=8.0===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "enum"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 6,
                "end": 10
              }
            }
          },
          "span": {
            "start": 6,
            "end": 10
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Name": {
                    "parts": [
                      "static"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 11,
                      "end": 17
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 17
                }
              },
              "index": null
            }
          },
          "span": {
            "start": 11,
            "end": 20
          }
        }
      },
      "span": {
        "start": 11,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
===ast >=8.1===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": {
            "name": "static",
            "span": {
              "start": 11,
              "end": 17
            }
          },
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 20
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 20
  }
}
