===source===
<?php

try {
    foo();
}
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
                          "start": 17,
                          "end": 20,
                          "start_line": 4,
                          "start_col": 4
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 22,
                    "start_line": 4,
                    "start_col": 4
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 24,
                "start_line": 4,
                "start_col": 4
              }
            }
          ],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 7,
        "end": 25,
        "start_line": 3,
        "start_col": 0
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25,
    "start_line": 1,
    "start_col": 0
  }
}
