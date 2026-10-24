===source===
<?php ++$a->f();
===errors===
Can't use method return value in write context
===php_error===
PHP Fatal error:  Can't use method return value in write context in Standard input code on line 1
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
                  "MethodCall": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 8,
                        "end": 10
                      }
                    },
                    "method": {
                      "kind": {
                        "Identifier": "f"
                      },
                      "span": {
                        "start": 12,
                        "end": 13
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 8,
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
