===source===
<?php use C as static;
===errors===
expected identifier, found 'static'
expected ';', found 'static'
Cannot use 'static' as a standalone expression
The use statement with non-compound name 'C' has no effect
===php_error===
PHP Parse error:  syntax error, unexpected token "static", expecting identifier in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "C"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 11
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 14
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 14
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Name": {
              "parts": [
                "static"
              ],
              "kind": "Unqualified",
              "span": {
                "start": 15,
                "end": 21
              }
            }
          },
          "span": {
            "start": 15,
            "end": 21
          }
        }
      },
      "span": {
        "start": 15,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
