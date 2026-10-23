===source===
<?php
declare(strict_types=1) {}
declare(strict_types=1): enddeclare;
declare(strict_types=1) echo 1;
declare(ticks=1, strict_types=1) {}
===errors===
strict_types declaration must not use block mode
strict_types declaration must not use block mode
strict_types declaration must not use block mode
strict_types declaration must not use block mode
===php_error===
PHP Fatal error:  strict_types declaration must not use block mode in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 27,
                  "end": 28
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 30,
              "end": 32
            }
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 54,
                  "end": 55
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 56,
              "end": 57
            }
          },
          "uses_alternative": true
        }
      },
      "span": {
        "start": 33,
        "end": 69
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 91,
                  "end": 92
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Echo": [
                {
                  "kind": {
                    "Int": 1
                  },
                  "span": {
                    "start": 99,
                    "end": 100
                  }
                }
              ]
            },
            "span": {
              "start": 94,
              "end": 101
            }
          }
        }
      },
      "span": {
        "start": 70,
        "end": 101
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ticks",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 116,
                  "end": 117
                }
              }
            ],
            [
              "strict_types",
              {
                "kind": {
                  "Int": 1
                },
                "span": {
                  "start": 132,
                  "end": 133
                }
              }
            ]
          ],
          "body": {
            "kind": {
              "Block": []
            },
            "span": {
              "start": 135,
              "end": 137
            }
          }
        }
      },
      "span": {
        "start": 102,
        "end": 137
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 137
  }
}
