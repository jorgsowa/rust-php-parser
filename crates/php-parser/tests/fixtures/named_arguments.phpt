===source===
<?php htmlspecialchars(string: $str, flags: ENT_QUOTES, encoding: 'UTF-8');
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
                  "Identifier": "htmlspecialchars"
                },
                "span": {
                  "start": 6,
                  "end": 22,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": "string",
                  "value": {
                    "kind": {
                      "Variable": "str"
                    },
                    "span": {
                      "start": 31,
                      "end": 35,
                      "start_line": 1,
                      "start_col": 31
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 23,
                    "end": 35,
                    "start_line": 1,
                    "start_col": 23
                  }
                },
                {
                  "name": "flags",
                  "value": {
                    "kind": {
                      "Identifier": "ENT_QUOTES"
                    },
                    "span": {
                      "start": 44,
                      "end": 54,
                      "start_line": 1,
                      "start_col": 44
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 37,
                    "end": 54,
                    "start_line": 1,
                    "start_col": 37
                  }
                },
                {
                  "name": "encoding",
                  "value": {
                    "kind": {
                      "String": "UTF-8"
                    },
                    "span": {
                      "start": 66,
                      "end": 73,
                      "start_line": 1,
                      "start_col": 66
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 56,
                    "end": 73,
                    "start_line": 1,
                    "start_col": 56
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 74,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 75,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 75,
    "start_line": 1,
    "start_col": 0
  }
}
