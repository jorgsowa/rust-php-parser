===source===
<?php match($x) { 1 => 'a' 2 => 'b' }
===errors===
expected '}', found integer
expected ';' after expression
expected ';' after expression
expected expression
expected expression
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Match": {
              "subject": {
                "kind": {
                  "Variable": "x"
                },
                "span": {
                  "start": 12,
                  "end": 14
                }
              },
              "arms": [
                {
                  "conditions": [
                    {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 18,
                        "end": 19
                      }
                    }
                  ],
                  "body": {
                    "kind": {
                      "String": "a"
                    },
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  },
                  "span": {
                    "start": 18,
                    "end": 26
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 26
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Int": 2
          },
          "span": {
            "start": 27,
            "end": 28
          }
        }
      },
      "span": {
        "start": 27,
        "end": 28
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 29,
        "end": 35
      }
    },
    {
      "kind": "Error",
      "span": {
        "start": 36,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
