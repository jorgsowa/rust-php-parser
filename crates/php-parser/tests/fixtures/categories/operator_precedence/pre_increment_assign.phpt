===source===
<?php ++$x += 1;
===errors===
Cannot use increment/decrement as an assignment target.
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
                  "UnaryPrefix": {
                    "op": "PreIncrement",
                    "operand": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 8,
                        "end": 10
                      }
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Plus",
              "value": {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 14,
                  "end": 15
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 15
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 16
  }
}
===php_error===
PHP Parse error:  syntax error, unexpected token "+=" in Standard input code on line 1
