===source===
<?php

$value = match ($char) {
    1 => '1',
    default => 'default'
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
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "value"
                },
                "span": {
                  "start": 7,
                  "end": 13
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "Match": {
                    "subject": {
                      "kind": {
                        "Variable": "char"
                      },
                      "span": {
                        "start": 23,
                        "end": 28
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
                              "start": 36,
                              "end": 37
                            }
                          }
                        ],
                        "body": {
                          "kind": {
                            "String": "1"
                          },
                          "span": {
                            "start": 41,
                            "end": 44
                          }
                        },
                        "span": {
                          "start": 36,
                          "end": 44
                        }
                      },
                      {
                        "conditions": null,
                        "body": {
                          "kind": {
                            "String": "default"
                          },
                          "span": {
                            "start": 61,
                            "end": 70
                          }
                        },
                        "span": {
                          "start": 50,
                          "end": 70
                        }
                      }
                    ]
                  }
                },
                "span": {
                  "start": 16,
                  "end": 72
                }
              }
            }
          },
          "span": {
            "start": 7,
            "end": 72
          }
        }
      },
      "span": {
        "start": 7,
        "end": 73
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 73
  }
}
