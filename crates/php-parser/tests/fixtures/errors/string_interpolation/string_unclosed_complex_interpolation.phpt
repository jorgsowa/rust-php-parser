===source===
<?php $s = "text {$incomplete";
===errors===
unterminated string literal
unclosed '{' in string interpolation
expected ';' after expression
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '"', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 1
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected double-quote mark, expecting "->" or "?->" or "{" or "[" in Standard input code on line 1
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected double-quote mark, expecting "->" or "?->" or "[" in Standard input code on line 1
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
                  "end": 31
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 31
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
