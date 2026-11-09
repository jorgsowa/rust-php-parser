===source===
<?php
$a = $this = 1;
===errors===
Cannot re-assign $this
===php_error===
PHP Fatal error:  Cannot re-assign $this in Standard input code on line 2
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
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Assign": {
                    "target": {
                      "kind": {
                        "Variable": "this"
                      },
                      "span": {
                        "start": 11,
                        "end": 16
                      }
                    },
                    "op": "Assign",
                    "value": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 11,
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
