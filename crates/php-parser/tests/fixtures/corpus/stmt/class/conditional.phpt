===source===
<?php

if (true) {
    class A {}
}
===ast===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Bool": true
            },
            "span": {
              "start": 11,
              "end": 15,
              "start_line": 3,
              "start_col": 4
            }
          },
          "then_branch": {
            "kind": {
              "Block": [
                {
                  "kind": {
                    "Class": {
                      "name": "A",
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
                    "start": 23,
                    "end": 33,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 17,
              "end": 35,
              "start_line": 3,
              "start_col": 10
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 7,
        "end": 35,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35,
    "start_line": 1,
    "start_col": 0
  }
}
