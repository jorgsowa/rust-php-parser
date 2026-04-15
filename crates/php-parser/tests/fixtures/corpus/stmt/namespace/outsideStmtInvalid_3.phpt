===source===
<?php
namespace A {}
declare(ticks=1);
foo();
namespace B {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 16,
              "end": 17
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 6,
        "end": 20
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
                  "start": 35,
                  "end": 36
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 21,
        "end": 38
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "foo"
                },
                "span": {
                  "start": 39,
                  "end": 42
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 39,
            "end": 44
          }
        }
      },
      "span": {
        "start": 39,
        "end": 45
      }
    },
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "B"
            ],
            "kind": "Unqualified",
            "span": {
              "start": 56,
              "end": 57
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 46,
        "end": 60
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 60
  }
}
===php_error===
PHP Fatal error:  No code may exist outside of namespace {} in Standard input code on line 3
Stack trace:
#0 {main}
