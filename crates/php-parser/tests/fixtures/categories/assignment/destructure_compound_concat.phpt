===source===
<?php
list($a) .= $b;
===errors===
Cannot use a destructuring pattern with a compound assignment operator
===php_error===
PHP Parse error:  syntax error, unexpected token ".=", expecting "=" in Standard input code on line 2
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
                            "start": 11,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 11,
                        "end": 13
                      }
                    }
                  ]
                },
                "span": {
                  "start": 6,
                  "end": 14
                }
              },
              "op": "Concat",
              "value": {
                "kind": {
                  "Variable": "b"
                },
                "span": {
                  "start": 18,
                  "end": 20
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
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
