===source===
<?php
$a instanceof Bar\;
===errors===
expected identifier, found ';'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting identifier (T_STRING) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "\" in Standard input code on line 2
===ast===
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
