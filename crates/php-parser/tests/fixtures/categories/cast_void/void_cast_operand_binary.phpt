===source===
<?php
(void) f() + 1;
===errors <=8.4===
'void cast' requires PHP 8.5 or higher
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'f' (T_STRING) in Standard input code on line 2
===php_error 8.0-8.4===
PHP Parse error:  syntax error, unexpected identifier "f" in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "Cast": [
              "Void",
              {
                "kind": {
                  "Binary": {
                    "left": {
                      "kind": {
                        "FunctionCall": {
                          "name": {
                            "kind": {
                              "Name": {
                                "parts": [
                                  "f"
                                ],
                                "kind": "Unqualified",
                                "span": {
                                  "start": 13,
                                  "end": 14
                                }
                              }
                            },
                            "span": {
                              "start": 13,
                              "end": 14
                            }
                          },
                          "args": []
                        }
                      },
                      "span": {
                        "start": 13,
                        "end": 16
                      }
                    },
                    "op": "Add",
                    "right": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 19,
                        "end": 20
                      }
                    }
                  }
                },
                "span": {
                  "start": 13,
                  "end": 20
                }
              }
            ]
          },
          "span": {
            "start": 6,
            "end": 20
          }
        }
      },
      "span": {
        "start": 6,
        "end": 21
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 21
  }
}
