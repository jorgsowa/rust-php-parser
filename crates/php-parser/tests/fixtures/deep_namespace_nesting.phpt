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
              "end": 29
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
                  "end": 42
                }
              }
            ]
          }
        }
      },
      "span": {
        "start": 6,
        "end": 44
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 44
  }
}
