===source===
<?php f()++;
===errors===
Cannot increment or decrement an expression that is not a variable
===php_error===
PHP Fatal error:  Can't use function return value in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPostfix": {
              "operand": {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "f"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 6,
                            "end": 7
                          }
                        }
                      },
                      "span": {
                        "start": 6,
                        "end": 7
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "op": "PostIncrement"
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
