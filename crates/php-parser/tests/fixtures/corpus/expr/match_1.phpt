===source===
<?php

echo match (1) {
    0 => 'Foo',
    1 => 'Bar',
};
===errors <=7.4===
'match expressions' requires PHP 8.0 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '=>' (T_DOUBLE_ARROW) in Standard input code on line 4
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
                    "Int": 1
                  },
                  "span": {
                    "start": 19,
                    "end": 20
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
                          "start": 28,
                          "end": 29
                        }
                      }
                    ],
                    "body": {
                      "kind": {
                        "String": "Foo"
                      },
                      "span": {
                        "start": 33,
                        "end": 38
                      }
                    },
                    "span": {
                      "start": 28,
                      "end": 38
                    }
                  },
                  {
                    "conditions": [
                      {
                        "kind": {
                          "Int": 1
                        },
                        "span": {
                          "start": 44,
                          "end": 45
                        }
                      }
                    ],
                    "body": {
                      "kind": {
                        "String": "Bar"
                      },
                      "span": {
                        "start": 49,
                        "end": 54
                      }
                    },
                    "span": {
                      "start": 44,
                      "end": 54
                    }
                  }
                ]
              }
            },
            "span": {
              "start": 12,
              "end": 57
            }
          }
        ]
      },
      "span": {
        "start": 7,
        "end": 58
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 58
  }
}
