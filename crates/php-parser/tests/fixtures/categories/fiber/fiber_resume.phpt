===config===
min_php=8.1
===source===
<?php $fiber->resume('world');
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "MethodCall": {
              "object": {
                "kind": {
                  "Variable": "fiber"
                },
                "span": {
                  "start": 6,
                  "end": 12,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "method": {
                "kind": {
                  "Identifier": "resume"
                },
                "span": {
                  "start": 14,
                  "end": 20,
                  "start_line": 1,
                  "start_col": 14
                }
              },
              "args": [
                {
                  "name": null,
                  "value": {
                    "kind": {
                      "String": "world"
                    },
                    "span": {
                      "start": 21,
                      "end": 28,
                      "start_line": 1,
                      "start_col": 21
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 21,
                    "end": 28,
                    "start_line": 1,
                    "start_col": 21
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 29,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 30,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 30,
    "start_line": 1,
    "start_col": 0
  }
}
