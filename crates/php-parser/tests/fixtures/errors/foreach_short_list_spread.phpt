===source===
<?php foreach ($a as [$k, ...$x]) {}
===errors===
Spread operator is not supported in assignments
===php_error===
PHP Fatal error:  Spread operator is not supported in assignments in Standard input code on line 1
===ast===
{
  "stmts": [
    {
      "kind": {
        "Foreach": {
          "expr": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 15,
              "end": 17
            }
          },
          "key": null,
          "value": {
            "kind": {
              "Array": [
                {
                  "key": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Variable": "k"
                      },
                      "span": {
                        "start": 22,
                        "end": 24
                      }
                    }
                  },
                  "span": {
                    "start": 22,
                    "end": 24
                  }
                },
                {
                  "key": null,
                  "kind": {
                    "Spread": {
                      "kind": {
                        "Variable": "x"
                      },
                      "span": {
                        "start": 29,
                        "end": 31
                      }
                    }
                  },
                  "span": {
                    "start": 26,
                    "end": 31
                  }
                }
              ]
            },
            "span": {
              "start": 21,
              "end": 32
            }
          },
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 34,
              "end": 36
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 36
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 36
  }
}
