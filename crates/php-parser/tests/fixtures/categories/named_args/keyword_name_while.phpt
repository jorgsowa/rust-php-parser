===source===
<?php foo(while: $x);
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
                  "name": "while",
                  "value": {
                    "kind": {
                      "Variable": "x"
                    },
                    "span": {
                      "start": 17,
                      "end": 19,
                      "start_line": 1,
                      "start_col": 17
                    }
                  },
                  "unpack": false,
                  "by_ref": false,
                  "span": {
                    "start": 10,
                    "end": 19,
                    "start_line": 1,
                    "start_col": 10
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 20,
            "start_line": 1,
            "start_col": 6
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21,
        "start_line": 1,
        "start_col": 6
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21,
    "start_line": 1,
    "start_col": 0
  }
}
