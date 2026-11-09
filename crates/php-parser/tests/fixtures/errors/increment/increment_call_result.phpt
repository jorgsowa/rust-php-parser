===source===
<?php ++f();
===errors===
Can't use function return value in write context
===php_error===
PHP Fatal error:  Can't use function return value in write context in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "UnaryPrefix": {
              "op": "PreIncrement",
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
                            "start": 8,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 8,
                        "end": 9
                      }
                    },
                    "args": []
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
