===source===
<?php
echo match($x){0, 1 => 2, default => 3};
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected ',' in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Echo": [
          {
            "kind": {
              "Match": {
                "subject": {
                  "kind": {
                    "Variable": "x"
                  },
                  "span": {
                    "start": 17,
                    "end": 19
                  }
                },
                "arms": [
                  {
                    "conditions": [
                      {
                        "kind": {
                          "Int": 0
                        },
                        "span": {
                          "start": 21,
                          "end": 22
                        }
                      },
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 24,
                          "end": 25
                        }
                      }
                    ],
                    "body": {
                      "kind": {
                        "Int": 2
                      },
                      "span": {
                        "start": 29,
                        "end": 30
                      }
                    },
                    "span": {
                      "start": 21,
                      "end": 30
                    }
                  },
                  {
                    "conditions": null,
                    "body": {
                      "kind": {
                        "Int": 3
                      },
                      "span": {
                        "start": 43,
                        "end": 44
                      }
                    },
                    "span": {
                      "start": 32,
                      "end": 44
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 11,
              "end": 45
            }
          }
        ]
      },
      "span": {
        "start": 6,
        "end": 46
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46
  }
}
