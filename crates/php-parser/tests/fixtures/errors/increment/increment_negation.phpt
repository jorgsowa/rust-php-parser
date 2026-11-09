===source===
<?php ---$b;
===errors===
Cannot increment or decrement an expression that is not a variable
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '-' in Standard input code on line 1
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "-" in Standard input code on line 1
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
                  "UnaryPrefix": {
                    "op": "Negate",
                    "operand": {
                      "kind": {
                        "Variable": "b"
                      },
                      "span": {
                        "start": 9,
                        "end": 11
                      }
                    }
                  }
                },
                "span": {
                  "start": 8,
                  "end": 11
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 11
          }
        }
      },
      "span": {
        "start": 6,
        "end": 12
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 12
  }
}
