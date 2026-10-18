===source===
<?php
use const Foo\{A, const B};
use function Foo\{a, function b, const C};
===errors===
expected name, found 'const'
expected name, found 'function'
expected name, found 'const'
===php_error===
PHP Parse error:  syntax error, unexpected token "const", expecting "}" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "A"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 16,
                  "end": 22
                }
              },
              "alias": null,
              "span": {
                "start": 21,
                "end": 22
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 16,
                  "end": 31
                }
              },
              "alias": null,
              "kind": "Const",
              "span": {
                "start": 24,
                "end": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 33
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Function",
          "uses": [
            {
              "name": {
                "parts": [
                  "Foo",
                  "a"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 47,
                  "end": 53
                }
              },
              "alias": null,
              "span": {
                "start": 52,
                "end": 53
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "b"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 47,
                  "end": 65
                }
              },
              "alias": null,
              "kind": "Function",
              "span": {
                "start": 55,
                "end": 65
              }
            },
            {
              "name": {
                "parts": [
                  "Foo",
                  "C"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 47,
                  "end": 74
                }
              },
              "alias": null,
              "kind": "Const",
              "span": {
                "start": 67,
                "end": 74
              }
            }
          ]
        }
      },
      "span": {
        "start": 34,
        "end": 76
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 76
  }
}
