===source===
<?php
$a = ["a "thing"];
===errors===
unterminated string literal
expected ']', found identifier
expected ';' after expression
expected ';' after expression
expected ';' after expression
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
                  "Array": [
                    {
                      "key": null,
                      "value": {
                        "kind": {
                          "String": "a "
                        },
                        "span": {
                          "start": 12,
                          "end": 16
                        }
                      },
                      "unpack": false,
                      "span": {
                        "start": 12,
                        "end": 16
                      }
                    }
                  ]
                },
                "span": {
                  "start": 11,
                  "end": 16
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 16
          }
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Identifier": "thing"
          },
          "span": {
            "start": 16,
            "end": 21
          }
        }
      },
      "span": {
        "start": 16,
        "end": 21
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "String": "];"
          },
          "span": {
            "start": 21,
            "end": 24
          }
        }
      },
      "span": {
        "start": 21,
        "end": 24
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 24
  }
}
