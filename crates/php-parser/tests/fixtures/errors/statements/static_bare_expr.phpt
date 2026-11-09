===source===
<?php
$a = static;
===errors===
Cannot use 'static' as a standalone expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ';', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token ";", expecting "::" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
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
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
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
