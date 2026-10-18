===source===
<?php $x = &($a);
===errors===
Cannot take reference of a parenthesized expression
===php_error===
PHP Parse error:  syntax error, unexpected token ";", expecting "->" or "?->" or "[" in Standard input code on line 1
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
                  "Variable": "x"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Parenthesized": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 13,
                      "end": 15
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 17
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 17
  }
}
