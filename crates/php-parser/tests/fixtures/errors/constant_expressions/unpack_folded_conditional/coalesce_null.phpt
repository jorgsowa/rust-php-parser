===source===
<?php
$a = [...(null ?? 2)];
===errors===
Only arrays and Traversables can be unpacked, int given
===php_error <=8.3===
PHP Fatal error:  Only arrays and Traversables can be unpacked in Standard input code on line 2
===php_error >=8.4===
PHP Fatal error:  Only arrays and Traversables can be unpacked, int given in Standard input code on line 2
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
                  "Array": [
                    {
                      "key": null,
                      "kind": {
                        "Spread": {
                          "kind": {
                            "Parenthesized": {
                              "kind": {
                                "NullCoalesce": {
                                  "left": {
                                    "kind": "Null",
                                    "span": {
                                      "start": 16,
                                      "end": 20
                                    }
                                  },
                                  "right": {
                                    "kind": {
                                      "Int": 2
                                    },
                                    "span": {
                                      "start": 24,
                                      "end": 25
                                    }
                                  }
                                }
                              },
                              "span": {
                                "start": 16,
                                "end": 25
                              }
                            }
                          },
                          "span": {
                            "start": 15,
                            "end": 26
                          }
                        }
                      },
                      "span": {
                        "start": 12,
                        "end": 26
                      }
                    }
                  ]
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
