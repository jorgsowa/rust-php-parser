===source===
<?php
#[A]
enum {}
===errors <=7.4===
expected expression, found '}'
expected ';', found '{'
expected ';' after expression
===errors 8.0===
'enums' requires PHP 8.1 or higher
expected enum name, found '{'
===errors >=8.1===
expected enum name, found '{'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '{' in Standard input code on line 3
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected identifier "enum" in Standard input code on line 3
===ast <=7.4===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrayAccess": {
              "array": {
                "kind": {
                  "Name": {
                    "parts": [
                      "enum"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 11,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 11,
                  "end": 15
                }
              },
              "index": null
            }
          },
          "span": {
            "start": 11,
            "end": 18
          }
        }
      },
      "span": {
        "start": 11,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
===ast >=8.0===
{
  "stmts": [
    {
      "kind": {
        "Enum": {
          "name": null,
          "scalar_type": null,
          "implements": [],
          "members": [],
          "attributes": [
            {
              "name": {
                "parts": [
                  "A"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 8,
                  "end": 9
                }
              },
              "args": [],
              "span": {
                "start": 8,
                "end": 9
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
