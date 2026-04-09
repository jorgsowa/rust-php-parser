===source===
<?php f(&$a);
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "FunctionCall": {
              "name": {
                "kind": {
                  "Identifier": "f"
                },
                "span": {
                  "start": 6,
                  "end": 7,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "Variable": "a"
                    },
                    "span": {
                      "start": 9,
                      "end": 11,
                      "start_line": 1,
                      "start_col": 9
                    }
                  },
                  "unpack": false,
                  "by_ref": true,
                  "span": {
                    "start": 8,
                    "end": 11,
                    "start_line": 1,
                    "start_col": 8
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 12,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 13,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 13,
    "start_line": 1,
    "start_col": 0
  }
}
