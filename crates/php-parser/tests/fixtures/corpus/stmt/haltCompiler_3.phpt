===source===
<?php

namespace A;
$a;
__halt_compiler();
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
              "start": 17,
              "end": 18,
              "start_line": 3,
              "start_col": 10
            }
          },
          "body": "Simple"
        }
      },
      "span": {
        "start": 7,
        "end": 20,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "Variable": "a"
          },
          "span": {
            "start": 20,
            "end": 22,
            "start_line": 4,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 20,
        "end": 24,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "HaltCompiler": ""
      },
      "span": {
        "start": 24,
        "end": 42,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 42,
    "start_line": 1,
    "start_col": 0
  }
}
