===source===
<?php ($a) = 1;
===errors===
Cannot use expression as assignment target.
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "=" in Standard input code on line 1
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
                  "Parenthesized": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 7,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 13,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
