===source===
<?php
foo(int);
===errors===
unexpected token "(int)"
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected '(int)' (int) (T_INT_CAST) in Standard input code on line 2
===php_error >=8.0===
PHP Parse error:  syntax error, unexpected token "(int)" in Standard input code on line 2
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
                  "Name": {
                    "parts": [
                      "foo"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 6,
                      "end": 9
                    }
                  }
                },
                "span": {
                  "start": 6,
                  "end": 9
                }
              },
              "args": [
                {
                  "name": null,
                  "kind": {
                    "Value": {
                      "kind": {
                        "Name": {
                          "parts": [
                            "int"
                          ],
                          "kind": "Unqualified",
                          "span": {
                            "start": 10,
                            "end": 13
                          }
                        }
                      },
                      "span": {
                        "start": 10,
                        "end": 13
                      }
                    }
                  },
                  "span": {
                    "start": 10,
                    "end": 13
                  }
                }
              ]
            }
          },
          "span": {
            "start": 6,
            "end": 14
          }
        }
      },
      "span": {
        "start": 6,
        "end": 15
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 15
  }
}
