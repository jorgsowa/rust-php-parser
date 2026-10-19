===source===
<?php
declare(encoding=FOO);
declare(ENCODING=1 + 1, strict_types=FOO);
===errors===
Encoding must be a literal
Encoding must be a literal
declare(strict_types) value must be a literal
===php_error===
PHP Fatal error:  Encoding must be a literal in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "encoding",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 23,
                      "end": 26
                    }
                  }
                },
                "span": {
                  "start": 23,
                  "end": 26
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    },
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "ENCODING",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 46,
                        "end": 47
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 50,
                        "end": 51
                      }
                    }
                  }
                },
                "span": {
                  "start": 46,
                  "end": 51
                }
              }
            ],
            [
              "strict_types",
              {
                "kind": {
                  "Name": {
                    "parts": [
                      "FOO"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 66,
                      "end": 69
                    }
                  }
                },
                "span": {
                  "start": 66,
                  "end": 69
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 29,
        "end": 71
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 71
  }
}
