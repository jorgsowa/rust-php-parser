===source===
<?php namespace A\B\C\D\E\F\G { class X {} }
===ast===
{
  "stmts": [
    {
      "kind": {
        "Namespace": {
          "name": {
            "parts": [
              "A",
              "B",
              "C",
              "D",
              "E",
              "F",
              "G"
            ],
            "kind": "Qualified",
            "span": {
              "start": 16,
              "end": 30,
              "start_line": 1,
              "start_col": 16
            }
          },
          "body": {
            "Braced": [
              {
                "kind": {
                  "Class": {
                    "name": "X",
                    "modifiers": {
                      "is_abstract": false,
                      "is_final": false,
                      "is_readonly": false
                    },
                    "extends": null,
                    "implements": [],
                    "members": [],
                    "attributes": []
                  }
                },
                "span": {
                  "start": 32,
                  "end": 42,
                  "start_line": 1,
                  "start_col": 32
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44,
    "start_line": 1,
    "start_col": 0
  }
}
