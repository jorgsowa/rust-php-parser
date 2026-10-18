===source===
<?php ++$a?->b;
===errors===
Can't use nullsafe operator in write context
===php_error===
PHP Fatal error:  Can't use nullsafe operator in write context in Standard input code on line 1
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
                  "NullsafePropertyAccess": {
                    "object": {
                      "kind": {
                        "Variable": "a"
                      },
                      "span": {
                        "start": 8,
                        "end": 10
                      }
                    },
                    "property": {
                      "kind": {
                        "Identifier": "b"
                      },
                      "span": {
                        "start": 13,
                        "end": 14
                      }
                    }
                  }
                },
                "span": {
                  "start": 8,
                  "end": 14
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
