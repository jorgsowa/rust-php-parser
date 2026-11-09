===source===
<?php
echo "{$a + 1}";
===errors===
only a variable, property, index or call can be interpolated with '{$...}'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '+', expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected token "+", expecting "->" or "?->" or "{" or "[" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected token "+", expecting "->" or "?->" or "[" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "InterpolatedString": [
                {
                  "Expr": {
                    "kind": {
                      "Binary": {
                        "left": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 13,
                            "end": 15
                          }
                        },
                        "op": "Add",
                        "right": {
                          "kind": {
                            "Int": 1
                          },
                          "span": {
                            "start": 18,
                            "end": 19
                          }
                        }
                      }
                    },
                    "span": {
                      "start": 13,
                      "end": 19
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 21
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
