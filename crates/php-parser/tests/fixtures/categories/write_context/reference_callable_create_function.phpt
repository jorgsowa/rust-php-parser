===source===
<?php
$a = &f(...);
===errors===
Cannot use result of built-in function in write context
===php_error <=8.0===
PHP Parse error:  syntax error, unexpected token ")" in Standard input code on line 2
===php_error >=8.1===
PHP Fatal error:  Cannot use result of built-in function in write context in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Assign": {
              "target": {
                "kind": {
                  "Variable": "a"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "CallableCreate": {
                    "kind": {
                      "Function": {
                        "kind": {
                          "Name": {
                            "parts": [
                              "f"
                            ],
                            "kind": "Unqualified",
                            "span": {
                              "start": 12,
                              "end": 13
                            }
                          }
                        },
                        "span": {
                          "start": 12,
                          "end": 13
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 18
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 18
          }
        }
      },
      "span": {
        "start": 6,
        "end": 19
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 19
  }
}
