===source===
<?php
echo "{$a $b}";
===errors===
expected '}', found variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '$b' (T_VARIABLE), expecting :: (T_PAAMAYIM_NEKUDOTAYIM) in Standard input code on line 2
===php_error 8.0-8.3===
PHP Parse error:  syntax error, unexpected variable "$b", expecting "->" or "?->" or "{" or "[" in Standard input code on line 2
===php_error >=8.4===
PHP Parse error:  syntax error, unexpected variable "$b", expecting "->" or "?->" or "[" in Standard input code on line 2
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
                      "Variable": "a"
                    },
                    "span": {
                      "start": 13,
                      "end": 15
                    }
                  }
                }
              ]
            },
            "span": {
              "start": 11,
              "end": 20
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
