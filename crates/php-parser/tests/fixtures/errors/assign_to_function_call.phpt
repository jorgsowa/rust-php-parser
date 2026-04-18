===source===
<?php func() = $x;
===errors===
Cannot use expression as assignment target.
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "func"
                      },
                      "span": {
                        "start": 6,
                        "end": 10
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 12
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 15,
                  "end": 17
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 17
          }
        }
      },
      "span": {
        "start": 6,
        "end": 18
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 18
  }
}
===php_error===
PHP Fatal error:  Can't use function return value in write context in Standard input code on line 1
