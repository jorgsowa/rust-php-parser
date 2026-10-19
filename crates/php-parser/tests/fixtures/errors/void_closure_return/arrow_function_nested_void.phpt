===config===
min_php=8.1
===source===
<?php
$f = fn() => fn(): void => 1;
===errors===
A void function must not return a value
===php_error===
PHP Fatal error:  A void function must not return a value in Standard input code on line 2
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
                    "return_type": null,
                    "body": {
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
                                  "start": 25,
                                  "end": 29
                                }
                              }
                            },
                            "span": {
                              "start": 25,
                              "end": 29
                            }
                          },
                          "body": {
                            "kind": {
                              "Int": 1
                            },
                            "span": {
                              "start": 33,
                              "end": 34
                            }
                          },
                          "attributes": []
                        }
                      },
                      "span": {
                        "start": 19,
                        "end": 34
                      }
                    },
                    "attributes": []
                  }
                },
                "span": {
                  "start": 11,
                  "end": 34
                }
              }
            }
          },
          "span": {
            "start": 6,
            "end": 34
          }
        }
      },
      "span": {
        "start": 6,
        "end": 35
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 35
  }
}
