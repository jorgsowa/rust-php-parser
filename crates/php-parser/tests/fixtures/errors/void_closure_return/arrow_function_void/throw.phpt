===source===
<?php
fn(): void => throw new E;
===errors <=7.4===
'throw expressions' requires PHP 8.0 or higher
A void function must not return a value
===errors >=8.0===
A void function must not return a value
===php_error <=7.4===
PHP Parse error:  syntax error, unexpected 'throw' (T_THROW) in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
===ast===
{
  "stmts": [
    {
      "kind": {
        "Expression": {
          "kind": {
            "ArrowFunction": {
              "is_static": false,
              "by_ref": false,
              "params": [],
              "return_type": {
                "kind": {
                  "Named": {
                    "parts": [
                      "void"
                    ],
                    "kind": "Unqualified",
                    "span": {
                      "start": 12,
                      "end": 16
                    }
                  }
                },
                "span": {
                  "start": 12,
                  "end": 16
                }
              },
              "body": {
                "kind": {
                  "Throw": {
                    "kind": {
                      "New": {
                        "class": {
                          "kind": {
                            "Name": {
                              "parts": [
                                "E"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 30,
                                "end": 31
                              }
                            }
                          },
                          "span": {
                            "start": 30,
                            "end": 31
                          }
                        },
                        "args": []
                      }
                    },
                    "span": {
                      "start": 26,
                      "end": 31
                    }
                  }
                },
                "span": {
                  "start": 20,
                  "end": 31
                }
              },
              "attributes": []
            }
          },
          "span": {
            "start": 6,
            "end": 31
          }
        }
      },
      "span": {
        "start": 6,
        "end": 32
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 32
  }
}
