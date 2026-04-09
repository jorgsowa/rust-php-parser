===config===
parse_version=8.4
===source===
<?php (void) getVersion();
===errors===
'void cast' requires PHP 8.5 or higher (targeting PHP 8.4)
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Identifier": "getVersion"
                      },
                      "span": {
                        "start": 13,
                        "end": 23,
                        "start_line": 1,
                        "start_col": 13
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 13,
                  "end": 25,
                  "start_line": 1,
                  "start_col": 13
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 25,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 26,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 26,
    "start_line": 1,
    "start_col": 0
  }
}
