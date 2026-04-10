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
                          "end": 19
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 16,
                    "end": 21
                  }
                }
              },
              "span": {
                "start": 16,
                "end": 22
              }
            },
            {
              "kind": "Error",
              "span": {
                "start": 24,
                "end": 57
              }
            }
          ],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 6,
        "end": 59
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 59
  }
}
