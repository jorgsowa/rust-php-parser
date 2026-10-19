===source===
<?php
declare(strict_types=2);
declare(strict_types='1');
declare(strict_types=1.0);
declare(strict_types=1_0);
declare(strict_types=99999999999999999999);
declare(Strict_Types=0x2);
===errors===
strict_types declaration must have 0 or 1 as its value
strict_types declaration must have 0 or 1 as its value
strict_types declaration must have 0 or 1 as its value
strict_types declaration must have 0 or 1 as its value
strict_types declaration must have 0 or 1 as its value
strict_types declaration must have 0 or 1 as its value
===php_error===
PHP Fatal error:  strict_types declaration must have 0 or 1 as its value in Standard input code on line 2
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
                  "Int": 2
                },
                "span": {
                  "start": 27,
                  "end": 28
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 30
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
                  "String": "1"
                },
                "span": {
                  "start": 52,
                  "end": 55
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 31,
        "end": 57
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
                  "Float": 1.0
                },
                "span": {
                  "start": 79,
                  "end": 82
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 58,
        "end": 84
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
                  "Int": 10
                },
                "span": {
                  "start": 106,
                  "end": 109
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 85,
        "end": 111
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
                  "Float": 1e+20
                },
                "span": {
                  "start": 133,
                  "end": 153
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 112,
        "end": 155
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "Strict_Types",
              {
                "kind": {
                  "Int": 2
                },
                "span": {
                  "start": 177,
                  "end": 180
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 156,
        "end": 182
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 182
  }
}
