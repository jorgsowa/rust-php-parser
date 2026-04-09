===source===
<?php
try {
    foo();

catch (Exception $e) {
    bar();
}
===errors===
expected expression
expected catch or finally clause, found end of file
===ast===
{
  "stmts": [
    {
      "kind": {
        "TryCatch": {
          "body": [
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
                          "start": 16,
                          "end": 19,
                          "start_line": 3,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 21,
                    "start_line": 3,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 24,
                "start_line": 3,
                "start_col": 4
              }
            },
            {
              "kind": "Error",
              "span": {
                "start": 24,
                "end": 58,
                "start_line": 5,
                "start_col": 0
              }
            }
          ],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 59,
        "start_line": 2,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59,
    "start_line": 1,
    "start_col": 0
  }
}
