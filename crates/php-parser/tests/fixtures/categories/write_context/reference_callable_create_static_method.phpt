===source===
<?php
$a = &A::m(...);
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
                      "StaticMethod": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "A"
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
                        },
                        "method": {
                          "kind": {
                            "Identifier": "m"
                          },
                          "span": {
                            "start": 15,
                            "end": 16
                          }
                        }
                      }
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 21
                }
              },
              "by_ref": true
            }
          },
          "span": {
            "start": 6,
            "end": 21
          }
        }
      },
      "span": {
        "start": 6,
        "end": 22
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 22
  }
}
