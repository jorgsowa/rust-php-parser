===source===
<?php
$f = fn(): ?void => 1;
===errors===
Void can only be used as a standalone type
===php_error <=7.4===
PHP Fatal error:  Void type cannot be nullable in Standard input code on line 2
===php_error >=8.0===
PHP Fatal error:  Void can only be used as a standalone type in Standard input code on line 2
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
                  "Variable": "f"
                },
                "span": {
                  "start": 6,
                  "end": 8
                }
              },
              "op": "Assign",
              "value": {
                "kind": {
                  "ArrowFunction": {
                    "is_static": false,
                    "by_ref": false,
                    "params": [],
                    "return_type": {
                      "kind": {
                        "Nullable": {
                          "kind": {
                            "Named": {
                              "parts": [
                                "void"
                              ],
                              "kind": "Unqualified",
                              "span": {
                                "start": 18,
                                "end": 22
                              }
                            }
                          },
                          "span": {
                            "start": 18,
                            "end": 22
                          }
                        }
                      },
                      "span": {
                        "start": 17,
                        "end": 22
                      }
                    },
                    "body": {
                      "kind": {
                        "Int": 1
                      },
                      "span": {
                        "start": 26,
                        "end": 27
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 27
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 27
          }
        }
      },
      "span": {
        "start": 6,
        "end": 28
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 28
  }
}
