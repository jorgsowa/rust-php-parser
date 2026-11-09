===source===
<?php --1;
===errors===
Cannot increment or decrement an expression that is not a variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '1' (T_LNUMBER) in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected integer "1" in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreDecrement",
              "operand": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 8,
                  "end": 9
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 9
          }
        }
      },
      "span": {
        "start": 6,
        "end": 10
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 10
  }
}
