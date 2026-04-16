===source===
<?php

try {
    foo();
}
===errors===
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
                          "start": 17,
                          "end": 20
                        }
                      },
                      "args": []
                    }
                  },
                  "span": {
                    "start": 17,
                    "end": 22
                  }
                }
              },
              "span": {
                "start": 17,
                "end": 23
              }
            }
          ],
          "catches": [],
          "finally": null
        }
      },
      "span": {
        "start": 7,
        "end": 25
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 25
  }
}
===php_error===
PHP Fatal error:  Cannot use try without catch or finally in Standard input code on line 3
