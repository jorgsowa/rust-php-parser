===config===
min_php=8.4
===source===
<?php $s = "text {$incomplete";
===errors===
unclosed '{' in string interpolation
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
                  "Variable": "s"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "InterpolatedString": [
                    {
                      "Literal": "text "
                    },
                    {
                      "Expr": {
                        "kind": {
                          "Variable": "incomplete"
                        },
                        "span": {
                          "start": 18,
                          "end": 29
                        }
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 30
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 30
          }
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected double-quote mark, expecting "->" or "?->" or "[" in Standard input code on line 1
