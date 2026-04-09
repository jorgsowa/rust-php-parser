===source===
<?php
function readonly() {}
readonly();
===ast===
{
  "stmts": [
    {
      "kind": {
        "Function": {
          "name": "readonly",
          "params": [],
          "body": [],
          "return_type": null,
          "by_ref": false,
          "attributes": []
        }
      },
      "span": {
        "start": 6,
        "end": 28,
        "start_line": 2,
        "start_col": 0
      }
    },
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "readonly"
                },
                "span": {
                  "start": 29,
                  "end": 37,
                  "start_line": 3,
                  "start_col": 0
                }
              },
              "args": []
            }
          },
          "span": {
            "start": 29,
            "end": 39,
            "start_line": 3,
            "start_col": 0
          }
        }
      },
      "span": {
        "start": 29,
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
