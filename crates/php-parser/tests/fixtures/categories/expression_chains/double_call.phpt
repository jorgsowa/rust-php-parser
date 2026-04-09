===source===
<?php $factory()();
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
                  "FunctionCall": {
                    "name": {
                      "kind": {
                        "Variable": "factory"
                      },
                      "span": {
                        "start": 6,
                        "end": 14,
                        "start_line": 1,
                        "start_col": 6
                      }
                    },
                    "args": []
                  }
                },
                "span": {
                  "start": 6,
                  "end": 16,
                  "start_line": 1,
                  "start_col": 6
                }
              },
              "args": []
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
