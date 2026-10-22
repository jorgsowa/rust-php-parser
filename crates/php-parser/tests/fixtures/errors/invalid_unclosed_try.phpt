===source===
<?php
try {
    foo();

catch (Exception $e) {
    bar();
}
===errors===
expected expression, found 'catch'
expected catch or finally clause, found end of file
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'catch' (T_CATCH) in Standard input code on line 5
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "catch" in Standard input code on line 5
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
                          "Name": {
                            "parts": [
                              "foo"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 16,
                              "end": 19
                            }
                          }
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
