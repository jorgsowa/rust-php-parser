===source===
<?php

if (true) {
    function A() {}
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
                    "Function": {
                      "name": "A",
                      "params": [],
                      "body": [],
                      "return_type": null,
                      "by_ref": false,
                      "attributes": []
                    }
                  },
                  "span": {
                    "start": 23,
                    "end": 38,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              ]
            },
            "span": {
              "start": 17,
              "end": 40,
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
        "end": 40,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 40,
    "start_line": 1,
    "start_col": 0
  }
}
