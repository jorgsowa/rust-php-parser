===source===
<?php foo(for: $x);
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
                  "Identifier": "foo"
                },
                "span": {
                  "start": 6,
                  "end": 9,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": [
                {
                  "name": "for",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 15,
                      "end": 17,
                      "start_line": 1,
                      "start_col": 15
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 17,
                    "start_line": 1,
                    "start_col": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 18,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19,
    "start_line": 1,
    "start_col": 0
  }
}
