===source===
<?php
function f(A\ $x) {}
===errors===
expected identifier, found variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$x' (T_VARIABLE), expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "\", expecting variable in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": {
            "name": "f",
            "span": {
              "start": 15,
              "end": 16
            }
          },
          "params": [
            {
              "name": {
                "name": "x",
                "span": {
                  "start": 20,
                  "end": 22
                }
              },
              "type_hint": {
                "kind": {
                  "Named": {
                    "parts": [
                      "A"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 17,
                      "end": 18
                    }
                  }
                },
                "span": {
                  "start": 17,
                  "end": 18
                }
              },
              "default": null,
              "by_ref": false,
              "variadic": false,
              "attributes": [],
              "span": {
                "start": 17,
                "end": 22
              }
            }
          ],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26
  }
}
