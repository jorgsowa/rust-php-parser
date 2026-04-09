===source===
<?php
declare(A='B');
namespace B {

}
__halt_compiler()
?>
Hi!
===ast===
{
  "stmts": [
    {
      "kind": {
        "Declare": {
          "directives": [
            [
              "A",
              {
                "kind": {
                  "String": "B"
                },
                "span": {
                  "start": 16,
                  "end": 19,
                  "start_line": 2,
                  "start_col": 10
                }
              }
            ]
          ],
          "body": null
        }
      },
      "span": {
        "start": 6,
        "end": 22,
        "start_line": 2,
        "start_col": 0
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
              "start": 32,
              "end": 34,
              "start_line": 3,
              "start_col": 10
            }
          },
          "body": {
            "Braced": []
          }
        }
      },
      "span": {
        "start": 22,
        "end": 38,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "HaltCompiler": "\nHi!"
      },
      "span": {
        "start": 39,
        "end": 63,
        "start_line": 6,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 63,
    "start_line": 1,
    "start_col": 0
  }
}
