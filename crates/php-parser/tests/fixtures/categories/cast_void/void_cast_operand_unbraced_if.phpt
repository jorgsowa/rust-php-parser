===source===
<?php
if ($a) (void) f() . "x";
===php_error <=8.4===
PHP Parse error:  syntax error, unexpected identifier "f" in Standard input code on line 2
===ast >=8.5===
{
  "stmts": [
    {
      "kind": {
        "If": {
          "condition": {
            "kind": {
              "Variable": "a"
            },
            "span": {
              "start": 10,
              "end": 12
            }
          },
          "then_branch": {
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
                                        "start": 21,
                                        "end": 22
                                      }
                                    }
                                  },
                                  "span": {
                                    "start": 21,
                                    "end": 22
                                  }
                                },
                                "args": []
                              }
                            },
                            "span": {
                              "start": 21,
                              "end": 24
                            }
                          },
                          "op": "Concat",
                          "right": {
                            "kind": {
                              "String": "x"
                            },
                            "span": {
                              "start": 27,
                              "end": 30
                            }
                          }
                        }
                      },
                      "span": {
                        "start": 21,
                        "end": 30
                      }
                    }
                  ]
                },
                "span": {
                  "start": 14,
                  "end": 30
                }
              }
            },
            "span": {
              "start": 14,
              "end": 31
            }
          },
          "elseif_branches": [],
          "else_branch": null
        }
      },
      "span": {
        "start": 6,
        "end": 31
      }
    }
  ],
  "span": {
    "start": 0,
    "end": 31
  }
}
