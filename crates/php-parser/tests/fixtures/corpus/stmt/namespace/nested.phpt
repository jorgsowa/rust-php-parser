===source===
<?php
namespace A {
    namespace B {

    }
}
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
              "end": 18,
              "start_line": 2,
              "start_col": 10
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Namespace": {
                    "name": {
                      "parts": [
                        "B"
                      ],
                      "kind": "Unqualified",
                      "span": {
                        "start": 34,
                        "end": 36,
                        "start_line": 3,
                        "start_col": 14
                      }
                    },
                    "body": {
                      "Braced": []
                    }
                  }
                },
                "span": {
                  "start": 24,
                  "end": 44,
                  "start_line": 3,
                  "start_col": 4
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 46,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 46,
    "start_line": 1,
    "start_col": 0
  }
}
