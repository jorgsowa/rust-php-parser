===source===
<?php

function f_null(): null {}
function f_false(): false {}
function f_true(): true {}
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "f_null",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "null"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 26,
                  "end": 30,
                  "start_line": 3,
                  "start_col": 19
                }
              }
            },
            "span": {
              "start": 26,
              "end": 30,
              "start_line": 3,
              "start_col": 19
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 7,
        "end": 33,
        "start_line": 3,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "f_false",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "false"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 54,
                  "end": 59,
                  "start_line": 4,
                  "start_col": 20
                }
              }
            },
            "span": {
              "start": 54,
              "end": 59,
              "start_line": 4,
              "start_col": 20
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 34,
        "end": 62,
        "start_line": 4,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Function": {
          "name": "f_true",
          "params": [],
          "body": [],
          "return_type": {
            "kind": {
              "Named": {
                "parts": [
                  "true"
                ],
                "kind": "Unqualified",
                "span": {
                  "start": 82,
                  "end": 86,
                  "start_line": 5,
                  "start_col": 19
                }
              }
            },
            "span": {
              "start": 82,
              "end": 86,
              "start_line": 5,
              "start_col": 19
            }
          },
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 63,
        "end": 89,
        "start_line": 5,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 89,
    "start_line": 1,
    "start_col": 0
  }
}
