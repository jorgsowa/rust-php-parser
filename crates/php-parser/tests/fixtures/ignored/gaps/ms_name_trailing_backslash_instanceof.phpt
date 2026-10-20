===source===
<?php
$a instanceof Bar\;
===errors >=8.5===
expected identifier, found ';'
===php_error===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Binary": {
              "left": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Instanceof",
              "right": {
                "kind": {
                  "Name": {
                    "parts": [
                      "Bar"
                    ],
                    "kind": "Qualified",
                    "span": {
                      "start": 20,
                      "end": 23
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 23
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 23
          }
        }
      },
      "span": {
        "start": 6,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
