===source===
<?php
[$a] ??= $b;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error===
PHP Parse error:  syntax error, unexpected token "??=" in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Value": {
                          "kind": {
                            "Variable": "a"
                          },
                          "span": {
                            "start": 7,
                            "end": 9
                          }
                        }
                      },
                      "span": {
                        "start": 7,
                        "end": 9
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 10
                }
              },
              "op": "Coalesce",
              "value": {
                "kind": {
                  "Variable": "b"
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
