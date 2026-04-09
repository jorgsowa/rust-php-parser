===source===
<?php @file_get_contents('missing.txt');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ErrorSuppress": {
              "kind": {
                "FunctionCall": {
                  "name": {
                    "kind": {
                      "Identifier": "file_get_contents"
                    },
                    "span": {
                      "start": 7,
                      "end": 24,
                      "start_line": 1,
                      "start_col": 7
                    }
                  },
                  "args": [
                    {
                      "name": null,
                      "value": {
                        "kind": {
                          "String": "missing.txt"
                        },
                        "span": {
                          "start": 25,
                          "end": 38,
                          "start_line": 1,
                          "start_col": 25
                        }
                      },
                      "unpack": false,
                      "by_ref": false,
                      "span": {
                        "start": 25,
                        "end": 38,
                        "start_line": 1,
                        "start_col": 25
                      }
                    }
                  ]
                }
              },
              "span": {
                "start": 7,
                "end": 39,
                "start_line": 1,
                "start_col": 7
              }
            }
          },
          "span": {
            "start": 6,
            "end": 39,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 40,
        "start_line": 1,
        "start_col": 6
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
