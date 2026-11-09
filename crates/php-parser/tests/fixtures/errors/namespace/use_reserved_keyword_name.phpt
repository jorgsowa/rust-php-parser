===source===
<?php
use Class;
use A\{B, List};
use function match;
use const Var;
===errors <=7.4===
expected identifier, found 'class'
expected identifier, found 'list'
expected identifier, found 'var'
===errors >=8.0===
expected identifier, found 'class'
expected identifier, found 'list'
expected identifier, found 'match'
expected identifier, found 'var'
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'Class' (T_CLASS), expecting identifier (T_STRING) or function (T_FUNCTION) or const (T_CONST) or \\ (T_NS_SEPARATOR) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "class" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "Class"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 10,
                  "end": 15
                }
              },
              "alias": null,
              "span": {
                "start": 10,
                "end": 15
              }
            }
          ]
        }
      },
      "span": {
        "start": 6,
        "end": 16
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Normal",
          "uses": [
            {
              "name": {
                "parts": [
                  "A",
                  "B"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 24,
                  "end": 25
                }
              },
              "alias": null,
              "span": {
                "start": 24,
                "end": 25
              }
            },
            {
              "name": {
                "parts": [
                  "A",
                  "List"
                ],
                "kind": "Qualified",
                "span": {
                  "start": 27,
                  "end": 31
                }
              },
              "alias": null,
              "span": {
                "start": 27,
                "end": 31
              }
            }
          ]
        }
      },
      "span": {
        "start": 17,
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
                  "match"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 47,
                  "end": 52
                }
              },
              "alias": null,
              "span": {
                "start": 47,
                "end": 52
              }
            }
          ]
        }
      },
      "span": {
        "start": 34,
        "end": 53
      }
    },
    {
      "kind": {
        "Use": {
          "kind": "Const",
          "uses": [
            {
              "name": {
                "parts": [
                  "Var"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 64,
                  "end": 67
                }
              },
              "alias": null,
              "span": {
                "start": 64,
                "end": 67
              }
            }
          ]
        }
      },
      "span": {
        "start": 54,
        "end": 68
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 68
  }
}
